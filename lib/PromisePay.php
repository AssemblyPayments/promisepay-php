<?php
namespace PromisePay;

use Httpful\Request;
use PromisePay\Exception;
use PromisePay\Log\Logger;

/*
    SDK Config file location setup.
    
    A recommended way of setting it up is thus:
    
    dirname(__DIR__) . DIRECTORY_SEPARATOR . 'SDK_Config.php'
*/

define(__NAMESPACE__ . '\SDK_CONFIG_LOCATION', '');

define(__NAMESPACE__ . '\SDK_CONFIG_LOCATION_LINE', (__LINE__ - 2));

/**
 * Class PromisePay
 *
 * @package PromisePay
 */
class PromisePay {
    
    /**
     * Constant 
     * @const int ENTITY_LIST_LIMIT
     */
    const ENTITY_LIST_LIMIT = 200;
    
    /**
     * Constructor
     * Makes sure Configuration class has been invoked by
     * testing for presence of API_LOGIN constant.
     */
    public function __construct() {
        if (!defined(__NAMESPACE__ . '\API_LOGIN')) {
            
            if (!empty(constant(__NAMESPACE__ . '\SDK_CONFIG_LOCATION')))
            {
                new Configuration(constant(__NAMESPACE__ . '\SDK_CONFIG_LOCATION'));
            }
            elseif (defined(__NAMESPACE__ . '\Tests\PHPUNIT_ENVIRONMENT'))
            {
                new Configuration(constant(__NAMESPACE__ . '\Tests\PHPUNIT_ENVIRONMENT'));
            }
            else
            {
                die("Fatal error: Looks like you forgot to specify your SDK Config file location. You can do that in file " . __FILE__ . ", at line " . constant(__NAMESPACE__ . '\SDK_CONFIG_LOCATION_LINE') . PHP_EOL);
            }
            
        }
    }
    
    /**
     * Static method invoker
     *
     * @param string $neededClassName
     * @param mixed $passableArgs
     * @return object
     */
    public static function __callStatic($neededClassName, $autoPassedArgs) {
        $neededClassName = __NAMESPACE__ . '\\' . $neededClassName . 'Repository';
        
        if (class_exists($neededClassName)) {
            return new $neededClassName;
        } else {
            throw new Exception\NotFound("Class $neededClassName not found");
        }
        
    }

    /**
     * Interface for performing requests to PromisePay endpoints
     *
     * @param string $method required One of the four supported requests methods (get, post, delete, patch)
     * @param string $entity required Endpoint name
     * @param string $payload optional URL encoded data query
     * @param string $mime optional Set specific MIME type. Supported list can be seen here: http://phphttpclient.com/docs/class-Httpful.Mime.html
     */
    public static function RestClient($method, $entity, $payload = null, $mime = null) {
        if (!is_null($payload)) {
            if (is_array($payload) || is_object($payload)) {
                $payload = http_build_query($payload);
            } // if the payload isn't array or object, leave it intact
        }
        
        $url = constant(__NAMESPACE__ . '\API_URL') . $entity . '?' . $payload;
        
        switch ($method) {
            case 'get':
                $response = Request::get($url)->authenticateWith(constant(__NAMESPACE__ . '\API_LOGIN'), constant(__NAMESPACE__ . '\API_PASSWORD'))->send();
                break;

            case 'post':
                $response = Request::post($url)->body($payload, $mime)->authenticateWith(constant(__NAMESPACE__ . '\API_LOGIN'), constant(__NAMESPACE__ . '\API_PASSWORD'))->send();
                break;

            case 'delete':
                $response = Request::delete($url)->authenticateWith(constant(__NAMESPACE__ . '\API_LOGIN'), constant(__NAMESPACE__ . '\API_PASSWORD'))->send();
                break;

            case 'patch':
                $response = Request::patch($url)->body($payload, $mime)->authenticateWith(constant(__NAMESPACE__ . '\API_LOGIN'), constant(__NAMESPACE__ . '\API_PASSWORD'))->send();
                break;
            
            default:
                throw new Exception\ApiUnsupportedRequestMethod("Unsupported request method $method.");
        }
        
        // check for errors
        $request_status = json_decode($response->raw_body);
        
        return $response;
    }
    
}

<?php
namespace PromisePay;

use Httpful\Request;
use PromisePay\Exception;
use PromisePay\Log\Logger;

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
            new Configuration;
        }
        
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            die("Fatal error: The minimum version of PHP needed for this package is 5.3.0. Exiting...");
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
        
        if (isset($request_status->errors)) {
            // check if API authorization was successful
            if (isset($request_status->errors->API_key)) {
                throw new Exception\Unauthorized("Exception thrown regarding API_key: " . serialize($request_status->errors));
            } else {
                throw new Exception\Unauthorized("Exception thrown regarding unauthorized data access: " . serialize($request_status->errors));
            }
        }
        
        return $response;
    }

    public static function checkIdNotNull($id) {
        if ($id == null) { // assumes unusable data (nulls, empty arrays, empty strings)
            Logger::logging('Fatal error: Id is empty');
            throw new Exception\Argument('id is empty');
        }
    }

    public static function paramsListCorrect($limit, $offset) {
        if (!is_int($limit) || !is_int($offset)) {
            Logger:logging('Fatal error: Limit and offset value should be integers!');
            throw new Exception\Argument('Limit and offset value should be integers!');
        }
        
        if ($limit < 0 || $offset < 0 ) {
            Logger::logging('Fatal error: limit and offset values should be nonnegative!');
            throw new Exception\Argument('Limit and offset values should be nonnegative!');
        }

        if ($limit > self::ENTITY_LIST_LIMIT) {
            Logger::logging('Fatal error: Max value for limit parameter!');
            throw new Exception\Argument('Max value for limit parameter');
        }
    }


}

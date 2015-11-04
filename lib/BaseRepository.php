<?php
namespace PromisePay;

use Httpful\Request;
use PromisePay\Exception;
use PromisePay\Log\Logger;

/**
 * Class BaseRepository
 *
 * @param bool $throwUnauthorizedException optional Will throw \Promisepay\Exception\Unauthorized upon detecting unauthorized access.
 * @package PromisePay
 */
class BaseRepository {
    
    /**
     * Constant 
     * @const int ENTITY_LIST_LIMIT
     */
    const ENTITY_LIST_LIMIT = 200;
    
    /**
     * Private property
     * @var bool $throwUnauthorizedException
     */
    private $throwUnauthorizedException;
    
    /**
     * Construct
     * Invokes Configuration class, which subsequently brings API configuration values to the namespace scope.
     */
    public function __construct($throwUnauthorizedException = false) {
        new Configuration;
        
        $this->throwUnauthorizedException = $throwUnauthorizedException;
    }

    /**
     * Interface for performing requests to PromisePay endpoints
     *
     * @param string $method required One of the four supported requests methods (get, post, delete, patch)
     * @param string $entity required Endpoint name
     * @param string $payload optional URL encoded data query
     * @param string $mime optional Set specific MIME type. Supported list can be seen here: http://phphttpclient.com/docs/class-Httpful.Mime.html
     */
    public function RestClient($method, $entity, $payload = null, $mime = null) {
        if (!is_null($payload)) {
            $payload = http_build_query($payload);
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
        
        if ($this->throwUnauthorizedException) {
            $request_status = json_decode($response->raw_body);
            
            // check for errors
            if (isset($request_status->errors)) {
                // check if API authorization was successful
                if (isset($request_status->errors->API_key)) {
                    throw new Exception\Unauthorized("Exception thrown regarding API_key: " . serialize($request_status->errors->API_key));
                } else {
                    throw new Exception\Unauthorized("Exception thrown regarding unauthorized data access: " . serialize($request_status->errors));
                }
            }
        }
        
        return $response;
    }

    public function checkIdNotNull($id) {
        if ($id == null) { // assumes unusable data (nulls, empty arrays, empty strings)
            Logger::logging('Fatal error: Id is empty');
            throw new Exception\Argument('id is empty');
        }
    }

    public function paramsListCorrect($limit, $offset) {
        if ($limit < 0 || $offset < 0 ) {
            Logger::logging('Fatal error:limit and offset values should be nonnegative!');
            throw new Exception\Argument('limit and offset values should be nonnegative!');
        }

        if ($limit > self::ENTITY_LIST_LIMIT) {
            Logger::logging('Fatal error:Max value for limit parameter!');
            throw new Exception\Argument('Max value for limit parameter');
        }
    }


}

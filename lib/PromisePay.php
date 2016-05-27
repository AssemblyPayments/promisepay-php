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
    protected static $jsonResponse;
    protected static $debugData;
    
    public static function getDecodedResponse($indexName = null) {
        if (!is_string($indexName) && $indexName !== null) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Argument for %s should be a string.',
                    __METHOD__
                )
            );
        }
        
        if ($indexName !== null) {
            return self::$jsonResponse[$indexName];
        } else {
            return self::$jsonResponse;
        }
    }
    
    public static function getDebugData() {
        return self::$debugData;
    }
    
    public static function getMeta() {
        $meta = self::getArrayValuesByKeyRecursive(
            'meta',
            self::$jsonResponse
        );
        
        if ($meta !== false) {
            return $meta;
        }
        
        return false;
    }
    
    public static function getLinks() {
        $links = self::getArrayValuesByKeyRecursive(
            'links',
            self::$jsonResponse
        );
        
        if ($links !== false) {
            return $links;
        }
        
        return false;
    }
    
    public static function getArrayValuesByKeyRecursive($needle, array $array) {
        if (!is_scalar($needle)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'First argument for %s should be a scalar value.',
                    __METHOD__
                )
            );
        }
        
        $iterator = new \RecursiveArrayIterator($array);
        
        $recursive = new \RecursiveIteratorIterator(
            $iterator,
            \RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach ($recursive as $key => $value) {
            if ($key === $needle) {
                return $value;
            }
        }
        
        return false;
    }
    
    /**
     * Constant 
     * @const int ENTITY_LIST_LIMIT
     */
    const ENTITY_LIST_LIMIT = 200;
    
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
        // Check whether critical constants are defined.
        if (!defined(__NAMESPACE__ . '\API_URL')) die("Fatal error: API_URL constant missing. Check if environment has been set.");
        if (!defined(__NAMESPACE__ . '\API_LOGIN')) die("Fatal error: API_LOGIN constant missing.");
        if (!defined(__NAMESPACE__ . '\API_PASSWORD')) die("Fatal error: API_PASSWORD constant missing.");
        
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
        
        self::$debugData = $response;
        
        // check for errors
        if ($response->hasErrors())
        {
            $errors = static::buildErrorMessage($response);
            
            switch ($response->code) {
                case 401:
                    throw new Exception\Unauthorized($errors);
                    break;
                case 404:
                    throw new Exception\NotFound($errors);
                default:
                    throw new Exception\Api($errors);
                    break;
            }
        }
        
        $data = json_decode($response, true);
        
        if ($data) {
            self::$jsonResponse = $data;
        } else {
            throw new Exception\MalformedResponse(
                'json_decode() failed decoding response.
                You can see raw response by using PromisePay::getRawResponse().'
            );
        }
        
        return $response;
    }
    
    private static function buildErrorMessage($response)
    {
        $jsonReponse = json_decode($response->raw_body);
        $message = '';
        
        if (isset($jsonReponse->message)) 
        {
            $message = $jsonReponse->message;
        }
        
        if (isset($jsonReponse->errors))
        {
            foreach($jsonReponse->errors as $attribute => $content)
            {
                if (is_array($content))
                {
                    $content = implode(" ", $content);
                }
                if (is_object($content))
                {
                    $content = json_encode($content);
                }
                $message .= " {$attribute}: {$content} ";
            }
        }
        
        return $message ? $response->code . " error: " . $message : NULL;
    }
    
}

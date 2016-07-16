<?php
namespace PromisePay;

/**
 * Class PromisePay
 *
 * @package PromisePay
 */
class PromisePay {
    protected static $jsonResponse;
    protected static $debugData;
    
    protected static $checksPassed;
    
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
            if (isset(self::$jsonResponse[$indexName])) {
                return self::$jsonResponse[$indexName];
            }
            
            return null;
        } else {
            return self::$jsonResponse;
        }
    }
    
    public static function getDebugData() {
        return self::$debugData;
    }
    
    public static function getMeta() {
        return self::getArrayValuesByKeyRecursive(
            'meta',
            self::$jsonResponse
        );
    }
    
    public static function getLinks() {
        return self::getArrayValuesByKeyRecursive(
            'links',
            self::$jsonResponse
        );
    }
    
    /**
     * Static method invoker.
     *
     * @param string $class
     * @param mixed $args
     * @throws Exception\NotFound
     * @return object
     */
    public static function __callStatic($class, $args) {
        $class = __NAMESPACE__ . '\\' . $class;
        
        if (class_exists($class)) {
            return new $class;
        } else {
            throw new Exception\NotFound("Repository $class not found");
        }
    }
    
    public static function checks() {
        if (!extension_loaded('curl')) {
            die(
                sprintf(
                    'curl extension is missing, and is required for %s package.',
                    __NAMESPACE__
                )
                . PHP_EOL
            );
        }
        
        self::$checksPassed = true;
    }

    /**
     * Method for performing requests to PromisePay endpoints.
     *
     * @param string $method One of the four supported requests methods (get, post, delete, patch)
     * @param string $entity Endpoint name
     * @param string $payload optional URL encoded data query
     * @param string $mime optional Set specific MIME type.
     */
    public static function RestClient($method, $entity, $payload = null, $mime = null) {
        if (!self::$checksPassed)
            self::checks();
        
        // Check whether critical constants are defined.
        if (!defined(__NAMESPACE__ . '\API_URL'))
            die('Fatal error: API_URL constant missing. Check if environment has been set.');
        
        if (!defined(__NAMESPACE__ . '\API_LOGIN'))
            die('Fatal error: API_LOGIN constant missing.');
        
        if (!defined(__NAMESPACE__ . '\API_PASSWORD'))
            die('Fatal error: API_PASSWORD constant missing.');
        
        if (!is_scalar($payload) && $payload !== null) {
            $payload = http_build_query($payload);
        }
        
        $url = constant(__NAMESPACE__ . '\API_URL') . $entity . '?' . $payload;
        
        switch ($method) {
            case 'get':
                $response = \Httpful\Request::get($url)
                ->authenticateWith(
                    constant(__NAMESPACE__ . '\API_LOGIN'),
                    constant(__NAMESPACE__ . '\API_PASSWORD')
                )->send();
                
                break;
            case 'post':
                $response = \Httpful\Request::post($url)
                ->body($payload, $mime)
                ->authenticateWith(
                    constant(__NAMESPACE__ . '\API_LOGIN'),
                    constant(__NAMESPACE__ . '\API_PASSWORD')
                )->send();
                
                break;
            case 'delete':
                $response = \Httpful\Request::delete($url)
                ->authenticateWith(
                    constant(__NAMESPACE__ . '\API_LOGIN'),
                    constant(__NAMESPACE__ . '\API_PASSWORD'))
                ->send();
                
                break;
            case 'patch':
                $response = \Httpful\Request::patch($url)
                ->body($payload, $mime)
                ->authenticateWith(
                    constant(__NAMESPACE__ . '\API_LOGIN'),
                    constant(__NAMESPACE__ . '\API_PASSWORD'))
                ->send();
                
                break;
            default:
                throw new Exception\ApiUnsupportedRequestMethod(
                    sprintf(
                        '%s is not a supported request method.',
                        $method
                    )
                );
        }
        
        self::$debugData = $response;
        
        // check for errors
        if ($response->hasErrors()) {
            $errors = static::buildErrorMessage($response);
            
            switch ($response->code) {
                case 401:
                    throw new Exception\Unauthorized($errors);
                    
                    break;
                case 404:
                    if (empty($errors)) {
                        $errors = "$url wasn't found.";
                    }
                    
                    throw new Exception\NotFound($errors);
                    
                    break;
                default:
                    if (empty($errors) && isset($response->raw_headers)) {
                        list($errors) = explode("\n", $response->raw_headers);
                    }
                    
                    throw new Exception\Api($errors);
            }
        }
        
        $data = json_decode($response, true);
        
        if ($data) {
            self::$jsonResponse = $data;
        }
        
        return $response;
    }
    
    protected static function buildErrorMessage($response) {
        $jsonResponse = json_decode($response->raw_body);
        
        $message = isset($jsonResponse->message) ? $jsonResponse->message : null;
        
        if (isset($jsonResponse->errors)) {
            foreach($jsonResponse->errors as $attribute => $content) {
                if (is_array($content)) {
                    $content = implode(" ", $content);
                }
                if (is_object($content)) {
                    $content = json_encode($content);
                }
                
                $message .= sprintf(
                    '%s: %s%s',
                    $attribute,
                    $content,
                    PHP_EOL
                );
            }
            
            return sprintf(
                '%sResponse Code: %d%sError Message: %s%s',
                PHP_EOL,
                isset($response->code) ? $response->code : 0,
                PHP_EOL,
                $message,
                PHP_EOL
            );
        }
        
        return null;
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
}
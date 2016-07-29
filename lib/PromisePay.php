<?php
namespace PromisePay;

/**
 * Class PromisePay
 *
 * @package PromisePay
 */
class PromisePay {
    /** @var array Pending requests; to be executed asynchronously */
    protected static $pendingRequests = array();
    
    protected static $lastUsedResponseIndex = array();
    public static $usedResponseIndexes = array();
    
    /** 
     @var bool Whether or not to retry requests on 503 or 504 HTTP responses;
     only synchronous requests are affected;
     togglers: enableRetries(), disableRetries()
     */
    protected static $retryOnServerTimeout = false;
    
    /** @var bool Debug state; togglers: enableDebug(), disableDebug() */
    protected static $debug = false;
    
    /** @var array JSON-decoded response; getter: getDecodedResponse() */
    protected static $jsonResponse;
    
    /** @var object Raw response data; getter: getDebugData() */
    protected static $debugData;
    
    /** @var bool Async requests state; togglers: beginAsync() and finishAsync() */
    protected static $sendAsync = false;
    
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
    
    /**
     * Method for performing requests to PromisePay endpoints.
     *
     * @param string $method One of the four supported requests methods (get, post, delete, patch)
     * @param string $entity Endpoint name
     * @param string $payload optional URL encoded data query
     * @param string $mime optional Set specific MIME type.
     */
    public static function RestClient($method, $entity, $payload = null, $mime = null) {
        Helpers\Functions::runtimeChecks();
        
        if (!is_scalar($payload) && $payload !== null) {
            $payload = http_build_query($payload);
        }
        
        $url = constant(__NAMESPACE__ . '\API_URL') . $entity . '?' . $payload;
        
        if (self::$sendAsync) {
            self::$pendingRequests[] = array(
                $method,
                $url
            );
            
            // set and return an empty array instead of null
            // to avoid breaking any BC
            
            self::$jsonResponse = array();
            
            return self::$jsonResponse;
        }
        
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
        
        if (self::isRetry() && ($response->http_code === 503 || $response->http_code === 504)) {
            if (self::$debug) {
                fwrite(
                    STDOUT,
                    sprintf(
                        "HTTP Code %d detected while retrying is enabled; retrying" . PHP_EOL,
                        $response->http_code
                    )
                );
            }
            
            return forward_static_call_array(
                array('PromisePay', 'RestClient'),
                func_get_args()
            );
        }
        
        // check for errors
        if ($response->hasErrors()) {
            $errors = Helpers\Functions::buildErrorMessage($response);
            
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
    
    public static function beginAsync() {
        self::$sendAsync = true;
        
        return new Helpers\AsyncClient;
    }
    
    public static function AsyncClient() {
        $args = func_get_args();
        
        if (empty($args)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "%s requires at least one argument.",
                    __METHOD__
                )
            );
        }
        
        $asyncClient = self::beginAsync();
        
        foreach ($args as $key => $arg) {
            if (!is_callable($arg)) {
                throw new \InvalidArgumentException(
                    sprintf(
                        "%d. argument for %s function is not a callable;
                        all arguments should be callables.",
                        $key + 1,
                        __METHOD__
                    )
                );
            }
            
            $arg();
        }
        
        self::finishAsync();
        
        $asyncResults = $asyncClient->Client(self::$pendingRequests);
        
        self::$pendingRequests = array();
        
        return $asyncResults;
    }
    
    public static function finishAsync() {
        self::$sendAsync = false;
    }
    
    public static function getAllResults($request, $limit = 200, $offset = 0, $async = false) {
        // can't use callable argument typehint as the 
        // minimal version of PHP we're supporting is 5.3,
        // and callable didn't get introduced until 5.4
        
        if (!is_callable($request)) {
            throw new \InvalidArgumentException(
                sprintf(
                    '%s requires its first argument to be
                    a callable, but %s was given instead.',
                    __METHOD__,
                    gettype($request)
                )
            );
        }
        
        if (!is_int($limit) || !is_int($offset)) {
            if (self::$debug) {
                throw new \InvalidArgumentException(
                    sprintf(
                        '%s requires its second and third argument
                        to be integers, but %s and %s, respectively,
                        were given instead.',
                        __METHOD__,
                        gettype($limit),
                        gettype($offset)
                    )
                );
            } else {
                $limit = 200;
                $offset = 0;
            }
        }
        
        $results = array();
        $total = null;
        
        do {
            if (self::$debug) {
                fwrite(
                    STDOUT,
                    sprintf(
                        "Progress: offset is %d, results count is %d" . PHP_EOL,
                        $offset,
                        $total
                    )
                );
            }
            
            $request($limit, $offset);
            
            $results = array_merge($results, 
                self::getDecodedResponse(
                    self::$lastUsedResponseIndex
                )
            );
            
            if ($total === null) {
                $meta = self::getMeta();
                
                $total = isset($meta['total']) ? $meta['total'] : 0;
            }
            
            if ($async) {
                self::beginAsync();
            }
            
            $offset += $limit;
        } while ($offset < $total);
        
        if ($async) {
            $asyncRequests = self::AsyncClient();
            $results = array_merge($results, $asyncRequests);
            
            self::finishAsync();
        }
        
        return $results;
    }
    
    public static function getAllResultsAsync($request, $limit = 200, $offset = 0) {
        return self::getAllResults($request, $limit, $offset, true);
    }
    
    public static function getDecodedResponse($index = null) {
        if (!is_string($index) && $index !== null) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Argument for %s should be a string.',
                    __METHOD__
                )
            );
        }
        
        self::$lastUsedResponseIndex = $index;
        
        if (!in_array($index, self::$usedResponseIndexes))
            self::$usedResponseIndexes[] = $index;
        
        if ($index === null)
            return self::$jsonResponse;
        
        if (isset(self::$jsonResponse[$index])) {
            return self::$jsonResponse[$index];
        } elseif (self::$sendAsync) {
            return array(); // not to break BC
        } else {
            return null;
        }
    }
    
    public static function getJson($index = null) {
        return self::getDecodedResponse($index);
    }
    
    public static function getMeta($json = null) {
        if ($json === null)
            $json = self::$jsonResponse;
        
        if (isset($json['meta']))
            return $json['meta'];
        
        $recursiveLookup = Helpers\Functions::arrayValueByKeyRecursive('meta', $json);
        
        return empty($recursiveLookup) ? array() : $recursiveLookup;
    }
    
    public static function getLinks($json = null) {
        if ($json === null)
            $json = self::$jsonResponse;
        
        if (isset($json['links']))
            return $json['links'];
        
        $recursiveLookup = Helpers\Functions::arrayValueByKeyRecursive('links', $json);
        
        return empty($recursiveLookup) ? array() : $recursiveLookup;
    }
    
    public static function getDebugData() {
        return self::$debugData;
    }
    
    public static function enableRetries() {
        self::$retryOnServerTimeout = true;
    }
    
    public static function disableRetries() {
        self::$retryOnServerTimeout = false;
    }
    
    public static function isRetry() {
        return self::$retryOnServerTimeout;
    }
    
    public static function enableDebug() {
        self::$debug = true;
    }
    
    public static function disableDebug() {
        self::$debug = false;
    }
    
    public static function isDebug() {
        return self::$debug;
    }
    
    public function __toString() {
        // disallow leaking of credentials
        // TODO IMPROVE
        return new stdClass;
    }
}
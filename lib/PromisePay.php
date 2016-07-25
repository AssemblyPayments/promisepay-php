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
    
    protected static $sendAsync = false;
    protected static $pendingRequests = array();
    
    protected static $debug = false;
    
    protected static $lastUsedIndexName;
    
    private static $asyncResponses = array();
    private static $asyncPendingRequestsHistoryCounts = array();
    private static $asyncIteratorCount = 0;
    
    public static function getLastUsedIndexName() {
        return self::$lastUsedIndexName;
    }
    
    public static function getDecodedResponse($indexName = null) {
        if (!is_string($indexName) && $indexName !== null) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Argument for %s should be a string.',
                    __METHOD__
                )
            );
        }
        
        self::$lastUsedIndexName = $indexName;
        
        if ($indexName !== null) {
            if (isset(self::$jsonResponse[$indexName])) {
                return self::$jsonResponse[$indexName];
            } elseif (self::$sendAsync) {
                return array(); // not to break BC
            } else {
                return null;
            }
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
    
    protected static function checks() {
        if (!extension_loaded('curl')) {
            die(
                sprintf(
                    'curl extension is missing, and is required for %s package.',
                    __NAMESPACE__
                )
                . PHP_EOL
            );
        }
        
        // Check whether critical constants are defined.
        if (!defined(__NAMESPACE__ . '\API_URL'))
            die('Fatal error: API_URL constant missing. Check if environment has been set.');
        
        if (!defined(__NAMESPACE__ . '\API_LOGIN'))
            die('Fatal error: API_LOGIN constant missing.');
        
        if (!defined(__NAMESPACE__ . '\API_PASSWORD'))
            die('Fatal error: API_PASSWORD constant missing.');
        
        self::$checksPassed = true;
    }
    
    public static function beginAsync() {
        self::$sendAsync = true;
    }
    
    public static function finishAsync() {
        self::$pendingRequests = self::$asyncResponses = self::$asyncPendingRequestsHistoryCounts = array();
        self::$asyncIteratorCount = 0;
        self::$sendAsync = false;
    }
    
    public static function getPendingRequests() {
        return self::$pendingRequests;
    }
    
    /**
     * Method for performing async requests against PromisePay endpoints.
     *
     * In case all requests don't get processed in the same batch
     * (because the server or network is over capacity), this method
     * will call itself recursively until all requests have been processed, unless:
     * 1) iterator count exceeds $iteratorMaximum param
     * 2) not a single new 2xx response is received in the last 2 batches
     *
     * @param array $requests A set of requests, in format of (http method, full uri)
     * @param int $iteratorMaximum Maximum amount of recursive method calls
     */
    public static function AsyncClient(array $requests = null, $iteratorMaximum = 1) {
        $multiHandle = curl_multi_init();
        
        $connections = array();
        
        if ($requests === null) {
            $requests = self::getPendingRequests();
        }
        
        foreach ($requests as $index => $requestParams) {
            list($method, $uri) = $requestParams;
            
            $connections[$index] = curl_init($uri);
            
            if (self::$debug) {
                fwrite(
                    STDOUT,
                    "#$index => $uri added." . PHP_EOL
                );
            }
            
            curl_setopt($connections[$index], CURLOPT_URL, $uri);
            curl_setopt($connections[$index], CURLOPT_HEADER, true);
            curl_setopt($connections[$index], CURLOPT_RETURNTRANSFER, true);
            curl_setopt($connections[$index], CURLOPT_USERAGENT, 'promisepay-php-sdk/1.0');
            
            curl_setopt(
                $connections[$index],
                CURLOPT_USERPWD,
                sprintf(
                    '%s:%s',
                    constant(__NAMESPACE__ . '\API_LOGIN'),
                    constant(__NAMESPACE__ . '\API_PASSWORD')
                )
            );
            
            curl_multi_add_handle($multiHandle, $connections[$index]);
        }
        
        $active = false;
        
        do {
            $multiProcess = curl_multi_exec($multiHandle, $active);
        } while ($multiProcess === CURLM_CALL_MULTI_PERFORM);
        
        while ($active && $multiProcess === CURLM_OK) {
            if (curl_multi_select($multiHandle) === -1) {
                // if there's a problem at the moment, delay execution
                // by 100 miliseconds, as suggested on
                // https://curl.haxx.se/libcurl/c/curl_multi_fdset.html
                
                if (self::$debug) {
                    fwrite(
                        STDOUT,
                        "Pausing for 100 miliseconds." . PHP_EOL
                    );
                }
                
                usleep(100000);
            }
            
            do {
                $multiProcess = curl_multi_exec($multiHandle, $active);
            } while ($multiProcess === CURLM_CALL_MULTI_PERFORM);
        }
        
        foreach($connections as $index => $connection) {
            $response = curl_multi_getcontent($connection);
            
            // we're gonna remove headers from $response
            $responseHeaders = curl_getinfo($connection);
            $responseBody = trim(substr($response, $responseHeaders['header_size']));
            
            if (self::$debug) {
                fwrite(
                    STDOUT,
                    sprintf("#$index content: %s" . PHP_EOL, $responseBody)
                );
                
                fwrite(
                    STDOUT,
                    "#$index headers: " . print_r($responseHeaders, true) . PHP_EOL
                );
            }
            
            if (substr($responseHeaders['http_code'], 0, 1) == '2') {
                // processed successfully, remove from queue
                foreach ($requests as $index => $requestParams) {
                    list($method, $url) = $requestParams;
                    
                    if ($url == $responseHeaders['url']) {
                        if (self::$debug) {
                            fwrite(
                                STDOUT,
                                "Unsetting $index from requests." . PHP_EOL
                            );
                        }
                        
                        unset($requests[$index]);
                    }
                }
                
                $jsonArray = json_decode($responseBody, true);
                
                if (is_array($jsonArray)) {
                    if (self::$lastUsedIndexName !== null)
                        $jsonArray = $jsonArray[self::$lastUsedIndexName];
                    
                    self::$asyncResponses = array_merge(self::$asyncResponses, $jsonArray);
                    
                } else {
                    if (self::$debug) {
                        fwrite(
                            STDOUT,
                            'An invalid response was received: ' . PHP_EOL . $responseBody . PHP_EOL
                        );
                    }
                }
                
            }
            
            curl_multi_remove_handle($multiHandle, $connection);
        }
        
        curl_multi_close($multiHandle);
        
        self::$asyncPendingRequestsHistoryCounts[] = count($requests);
        
        if (self::$debug) {
            fwrite(
                STDOUT,
                sprintf(
                    "asyncResponses contains %d members." . PHP_EOL,
                    count(self::$asyncResponses)
                )
            );
        }
        
        // if a single request hasn't succeeded in the past 2 request batches,
        // terminate and return result.
        foreach (self::$asyncPendingRequestsHistoryCounts as $index => $pendingRequestsCount) {
            if ($index === 0) continue;
            
            if (self::$asyncPendingRequestsHistoryCounts[$index - 1] == $pendingRequestsCount) {
                if (self::$debug) {
                    fwrite(
                        STDOUT,
                        'Server 5xx detected; returning what was obtained thus far.' . PHP_EOL
                    );
                }
                
                return self::$asyncResponses;
            }
        }
        
        self::$asyncIteratorCount++;
        
        if (empty($requests) || self::$asyncIteratorCount >= $iteratorMaximum) {
            return self::$asyncResponses;
        }
        
        if (self::$debug) {
            fwrite(STDOUT, PHP_EOL . '<<STARTING RECURSIVE CALL>>' . PHP_EOL);
            
            fwrite(
                STDOUT,
                'REMAINING REQUESTS: ' . print_r($requests, true) .
                PHP_EOL .
                'PROCESSED RESPONSES: ' . print_r(self::$asyncResponses, true)
            );
        }
        
        return self::AsyncClient($requests);
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
            
            return array();
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
    
    public static function getAllResults($request, $limit = 200, $offset = 0, $async = false) {
        // can't use callable argument typehint as the 
        // minimal version of PHP we're supporting is 5.3,
        // and callable didn't get introduced until 5.4
        
        if (!is_callable($request)) {
            throw new \InvalidArgumentException(
                sprintf(
                    '%s requires its first argument to be
                    a closure, but %s was given instead.',
                    __FUNCTION__,
                    gettype($request)
                )
            );
        }
        
        if (!is_int($limit) || !is_int($offset)) {
            if (self::isDebug()) {
                throw new \InvalidArgumentException(
                    sprintf(
                        '%s requires its second and third argument
                        to be integers, but %s and %s, respectively,
                        were given instead.',
                        __FUNCTION__,
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
            fwrite(
                STDOUT,
                sprintf(
                    "Progress: offset is %d, results count is %d" . PHP_EOL,
                    $offset,
                    $total
                )
            );
            
            $request($limit, $offset);
            
            $results = array_merge($results, 
                self::getDecodedResponse(
                    self::getLastUsedIndexName()
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
    
    public static function enableDebug() {
        self::$debug = true;
    }
    
    public static function disableDebug() {
        self::$debug = false;
    }
    
    public static function isDebug() {
        return self::$debug;
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
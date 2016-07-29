<?php
namespace PromisePay\Helpers;

use PromisePay\PromisePay;

class AsyncClient {
    
    protected $asyncResponses = array();
    protected $asyncPendingRequestsHistoryCounts = array();
    protected $asyncIteratorCount = 0;
    
    private $storageHandler;
    
    public function __construct() {
        $this->storageHandler = new AsyncStorageHandler;
    }
    
    /**
     * Method for performing async requests against PromisePay endpoints.
     *
     * In case all requests don't get processed in the same batch,
     * because the API server has a limit of requests it's willing
     * to fullfil in a certain amount of time, then this method
     * will call itself recursively until all requests have been processed, unless:
     * 1) iterator count exceeds $iteratorMaximum param
     * 2) not a single new 2xx response is received in the last 2 batches
     *
     * @param array $requests A set of requests, in format of (http method, full uri)
     * @param int $iteratorMaximum Maximum amount of recursive method calls
     */
    public function Client(
        array $requests,
        $iteratorMaximum = 1,
        $resultsNeeded = PHP_INT_MAX
    ) {
        $multiHandle = curl_multi_init();
        
        $connections = array();
        
        foreach ($requests as $index => $requestParams) {
            list($method, $uri) = $requestParams;
            
            $connections[$index] = curl_init($uri);
            
            if (PromisePay::isDebug()) {
                fwrite(
                    STDOUT,
                    "#$index => $uri added." . PHP_EOL
                );
            }
            
            curl_setopt($connections[$index], CURLOPT_URL, $uri);
            curl_setopt($connections[$index], CURLOPT_HEADER, true);
            curl_setopt($connections[$index], CURLOPT_RETURNTRANSFER, true);
            curl_setopt($connections[$index], CURLOPT_CUSTOMREQUEST, strtoupper($method));
            curl_setopt($connections[$index], CURLOPT_USERAGENT, 'promisepay-php-sdk/1.0');
            
            curl_setopt(
                $connections[$index],
                CURLOPT_USERPWD,
                sprintf(
                    '%s:%s',
                    constant(Functions::getBaseNamespace() . '\API_LOGIN'),
                    constant(Functions::getBaseNamespace() . '\API_PASSWORD')
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
                
                if (PromisePay::isDebug()) {
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
            
            // we're gonna separate headers and response body
            $responseHeaders = curl_getinfo($connection);
            $responseBody = trim(substr($response, $responseHeaders['header_size']));
            
            if (PromisePay::isDebug()) {
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
                        if (PromisePay::isDebug()) {
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
                    // SCENARIO #1
                    // Response JSON is self-contained under a master key
                    foreach (PromisePay::$usedResponseIndexes as $responseIndex) {
                        if (isset($jsonArray[$responseIndex])) {
                            $jsonArray = $jsonArray[$responseIndex];
                            
                            break;
                        } else {
                            unset($responseIndex);
                        }
                    }
                    
                    // SCENARIO #2
                    // Response JSON is NOT self-contained under a master key
                    if (!isset($responseIndex)) {
                        // for these scenarios, we'll store them under their endpoint name.
                        // for example, requestSessionToken() internally calls getDecodedResponse()
                        // without a key param.
                        $responseIndex = trim(
                            parse_url($responseHeaders['url'], PHP_URL_PATH),
                            '/'
                        );
                        
                        $slashLookup = strpos($responseIndex, '/');
                        
                        if ($slashLookup !== false)
                            $responseIndex = substr($responseIndex, 0, $slashLookup);
                    }
                    
                    $this->asyncResponses[$responseIndex][] = $jsonArray;
                    
                    $this->storageHandler->storeJson($jsonArray);
                    $this->storageHandler->storeMeta(PromisePay::getMeta($jsonArray));
                    $this->storageHandler->storeLinks(PromisePay::getLinks($jsonArray));
                    $this->storageHandler->storeDebug($responseHeaders);
                    
                    unset($responseIndex);
                } else {
                    if (PromisePay::isDebug()) {
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
        
        $this->asyncPendingRequestsHistoryCounts[] = count($requests);
        
        if (PromisePay::isDebug()) {
            fwrite(
                STDOUT,
                sprintf(
                    "asyncResponses contains %d members." . PHP_EOL,
                    count($this->asyncResponses)
                )
            );
        }
        
        // if a single request hasn't succeeded in the past 2 request batches,
        // terminate and return result.
        foreach ($this->asyncPendingRequestsHistoryCounts as $index => $pendingRequestsCount) {
            if ($index === 0) continue;
            
            if ($this->asyncPendingRequestsHistoryCounts[$index - 1] == $pendingRequestsCount) {
                if (PromisePay::isDebug()) {
                    fwrite(
                        STDOUT,
                        'Server 5xx detected; returning what was obtained thus far.' . PHP_EOL
                    );
                }
                
                return $this->storageHandler;
            }
        }
        
        $this->asyncIteratorCount++;
        
        if (empty($requests) || $this->asyncIteratorCount >= $iteratorMaximum) {
            return $this->storageHandler;
        }
        
        if (PromisePay::isDebug()) {
            fwrite(STDOUT, PHP_EOL . '<<STARTING RECURSIVE CALL>>' . PHP_EOL);
            
            fwrite(
                STDOUT,
                'REMAINING REQUESTS: ' . print_r($requests, true) .
                PHP_EOL .
                'PROCESSED RESPONSES: ' . print_r($this->asyncResponses, true)
            );
        }
        
        return $this->Client($requests);
    }
    
}
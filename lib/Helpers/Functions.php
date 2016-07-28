<?php
namespace PromisePay\Helpers;

class Functions {
    
    public static function getBaseNamespace() {
        $namespacePaths = explode('\\', __NAMESPACE__);
        
        return $namespacePaths[0];
    }
    
    /**
     * Performs runtime environment checks.
     *
     * @return void
     */
    public static function runtimeChecks() {
        static $checksPassed;
        
        if ($checksPassed === true)
            return;
        
        $packageNamespace = self::getBaseNamespace();
        
        if (!extension_loaded('curl')) {
            die(
                sprintf(
                    'curl extension is missing, and is required for %s package.',
                    $packageNamespace
                )
                . PHP_EOL
            );
        }
        
        if (version_compare(PHP_VERSION, '5.3.3', '<')) {
            die(
                sprintf(
                    "Fatal error: The minimum version of PHP 
                    needed for %s package is 5.3.3. Exiting.",
                    $packageNamespace
                )
            );
        }
        
        // Check whether critical constants are defined.
        if (!defined($packageNamespace . '\API_URL'))
            die('Fatal error: API_URL constant missing. Check if environment has been set.');
        
        if (!defined($packageNamespace . '\API_LOGIN'))
            die('Fatal error: API_LOGIN constant missing.');
        
        if (!defined($packageNamespace . '\API_PASSWORD'))
            die('Fatal error: API_PASSWORD constant missing.');
        
        $checksPassed = true;
    }
    
    /**
     * Composes an error message to be shown in case of Exceptions being thrown.
     *
     * @param string $response Exception's error message
     * @return string
     */
    public static function buildErrorMessage($response) {
        // TODO REFACTOR
        
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
    
    /**
     * Seeks a key within a simple or multidimensional array,
     * and returns its value. 
     * Returns null if invalid params are supplied, or false if
     * the key is not found.
     *
     * @param scalar $needle Key name being sought
     * @param array $array Input array
     *
     * @return string
     */
    public static function arrayValueByKeyRecursive($needle, array $array) {
        if (!is_scalar($needle)) {
            if (PromisePay::isDebug()) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'First argument for %s should be a scalar value.',
                        __METHOD__
                    )
                );
            } else {
                return null;
            }
        }
        
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveArrayIterator($array),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach ($iterator as $key => $value) {
            if ($key === $needle) {
                return $value;
            }
        }
        
        return false;
    }
    
    public static function waitForServerToBecomeResponsiveAgain() {
        // the 503 lockout is usually 120 seconds
        $start = microtime(true);
        
        while (true) {
            try {
                $getList = PromisePay::Transaction()->getList(
                    array(
                        'limit' => 1,
                        'offset' => 0,
                        'transaction_type' => 'refund'
                    )
                );
                
                break;
            } catch (\PromisePay\Exception\Api $e) {
                sleep(5);
            }
        }
        
        if (PromisePay::isDebug()) {
            fwrite(
                STDOUT,
                sprintf(
                    'Amount of time server was unresponsive: %f seconds' . PHP_EOL,
                    microtime(true) - $start
                )
            );
        }
    }
    
}
<?php
namespace PromisePay\Log;

/**
 * Class Logger
 * @package PromisePay\Log
 */
class Logger {

    /**
     * Enable or disable PromisePay logger.
     * @var bool
     */
    private static $enable = false;

    /**
     * @param $errorMessage
     */
    public static function logging($errorMessage){

        if ($errorMessage && self::$enable === true) {
            $path = dirname(__FILE__) . "/report/";
            $reportFilename = 'PromisePayLog-' . date("Ymd");
            
            if (is_writable($path . $reportFilename)) {
                file_put_contents($path . $reportFilename, $errorMessage . PHP_EOL, FILE_APPEND);
            } else {
                trigger_error("Log file is not writable.");
            }
        }
        
    }
}

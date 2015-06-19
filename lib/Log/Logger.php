<?php

namespace PromisePay\Log;

/**
 * Class Logger
 * @package PromisePay\Log
 */
class Logger{

    /**
     * Enable or disable PromisePay logger.
     * @var bool
     */
    private static $enable = false;

    /**
     * @param $errorMessage
     */
    public static function logging($errorMessage){

        if($errorMessage && self::$enable == true) {
            $path = dirname(__FILE__) . "/report/";
            $reportFilename = 'PromisePayLog-' . date("Ymd");
            file_put_contents($path . $reportFilename, $errorMessage);
        }

        return;
    }
}
<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

function waitForServerToBecomeResponsiveAgain() {
    $start = microtime(true);
    
    while (true) {
        try {
            $getList = PromisePay::Transaction()->getList(
                array(
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
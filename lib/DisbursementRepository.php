<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class DisbursementRepository {
    
    public static function get() {
        $response = PromisePay::RestClient('get', 'disbursements/');
        $jsonDecodedResponse = json_decode($response, true);
    }
    
}
<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class Address {
    
    public static function get($id) {
        $response = PromisePay::RestClient('get', 'addresses/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['addresses'];
    }
    
}

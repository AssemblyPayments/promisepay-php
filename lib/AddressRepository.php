<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class AddressRepository {
    
    public static function get($id) {
        PromisePay::checkIdNotNull($id);
        
        $response = PromisePay::RestClient('get', 'addresses/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['addresses'];
    }
    
}

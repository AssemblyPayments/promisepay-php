<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class FeeRepository {
    public static function getList($params) {
        $response = PromisePay::RestClient('get', 'fees/', $params);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['fees'];
    }
    
    public static function get($id) {
        $response = PromisePay::RestClient('get', 'fees/' . $id);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['fees'];
    }
    
    public static function create($params) {
        $response = PromisePay::RestClient('post', 'fees/', $params);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['fees'];
    }
}

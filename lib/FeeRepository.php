<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class FeeRepository {
    public static function create($params) {
        PromisePay::RestClient('post', 'fees/', $params);
        
        return PromisePay::getDecodedResponse('fees');
    }
    
    public static function getList($params) {
        PromisePay::RestClient('get', 'fees/', $params);
        
        return PromisePay::getDecodedResponse('fees');
    }
    
    public static function get($id) {
        $response = PromisePay::RestClient('get', 'fees/' . $id);
        
        return PromisePay::getDecodedResponse('fees');
    }
}
  
    
<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class Fee {
    public function create($params) {
        PromisePay::RestClient('post', 'fees/', $params);
        
        return PromisePay::getDecodedResponse('fees');
    }
    
    public function getList($params) {
        PromisePay::RestClient('get', 'fees/', $params);
        
        return PromisePay::getDecodedResponse('fees');
    }
    
    public function get($id) {
        PromisePay::RestClient('get', 'fees/' . $id);
        
        return PromisePay::getDecodedResponse('fees');
    }
}
  
    
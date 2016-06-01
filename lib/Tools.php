<?php
namespace PromisePay;

class Tools {
    
    public static function health() {
        PromisePay::RestClient('get', 'status');
        
        return PromisePay::getDecodedResponse('status');
    }
    
}

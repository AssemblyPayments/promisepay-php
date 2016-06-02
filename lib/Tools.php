<?php
namespace PromisePay;

class Tools {
    
    public static function getHealth() {
        PromisePay::RestClient('get', 'status');
        
        return PromisePay::getDecodedResponse('status');
    }
    
}

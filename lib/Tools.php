<?php
namespace PromisePay;

class Tools {    
    public function getHealth() {
        PromisePay::RestClient('get', 'status');
        
        return PromisePay::getDecodedResponse('status');
    }
}
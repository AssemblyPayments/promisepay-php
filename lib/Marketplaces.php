<?php
namespace PromisePay;

class Marketplaces {
    public function get() {
        PromisePay::RestClient('get', 'marketplace/');
        
        return PromisePay::getDecodedResponse('marketplaces');
    }
    
    public function show() {
        return $this->get();
    }
}

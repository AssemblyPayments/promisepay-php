<?php
namespace PromisePay;

class Address {
    
    public function get($id) {
        PromisePay::RestClient('get', 'addresses/' . $id);
        
        return PromisePay::getDecodedResponse('addresses');
    }
    
}

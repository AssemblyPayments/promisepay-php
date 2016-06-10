<?php
namespace PromisePay;

class Charges {
    public function create($params) {
        PromisePay::RestClient('post', 'charges', $params);
        
        return PromisePay::getDecodedResponse('charges');
    }
    
    public function getList($params = null) {
        PromisePay::RestClient('get', 'charges', $params);
        
        return PromisePay::getDecodedResponse('charges');
    }
    
    public function get($id) {
        PromisePay::RestClient('get', 'charges/' . $id);
        
        return PromisePay::getDecodedResponse('charges');
    }
    
    public function show($id) {
        return $this->get($id);
    }
}
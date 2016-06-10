<?php
namespace PromisePay;

class Charges {
    public function create($params) {
        PromisePay::RestClient('post', 'charges', $params);
        
        return PromisePay::getDecodedResponse('charges');
    }
}
<?php
namespace PromisePay;

class PaymentRestrictions {
    public function getList($params = array()) {
        PromisePay::RestClient('get', 'payment_restrictions/', $params);
        
        return PromisePay::getDecodedResponse('payment_restrictions');
    }

    public function get($id) {
        PromisePay::RestClient('get', 'payment_restrctions/' . $id);

        return PromisePay::getDecodedResponse('payment_restrictions');
    }
}
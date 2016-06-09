<?php
namespace PromisePay;

class Transaction {
    public function getList($params = null) {
        PromisePay::RestClient('get', 'transactions/', $params);
        
        return PromisePay::getDecodedResponse('transactions');
    }
    
    public function get($id) {
        PromisePay::RestClient('get', 'transactions/' . $id);
        
        return PromisePay::getDecodedResponse('transactions');
    }

    public function getUser($id) {
        PromisePay::RestClient('get', 'transactions/' . $id . '/users');
        
        return PromisePay::getDecodedResponse('users');
    }

    public function getFee($id) {
        PromisePay::RestClient('get', 'transactions/' . $id . '/fees');
        
        return PromisePay::getDecodedResponse('fees');
    }
}
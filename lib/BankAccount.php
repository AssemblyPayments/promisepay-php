<?php
namespace PromisePay;

class BankAccount {
    
    public function get($id) {
        PromisePay::RestClient('get', 'bank_accounts/' . $id);
        
        return PromisePay::getDecodedResponse('bank_accounts');
    }

    public function create($params) {
        PromisePay::RestClient('post', 'bank_accounts/', $params);
        
        return PromisePay::getDecodedResponse('bank_accounts');
    }

    public function delete($id) {
        PromisePay::RestClient('delete', 'bank_accounts/' . $id);
        
        return PromisePay::getDecodedResponse('bank_account');
    }
    
    public function redact($id) {
        return $this->delete($id);
    }

    public function getUser($id) {
        PromisePay::RestClient('get', 'bank_accounts/' . $id . '/users');
        
        return PromisePay::getDecodedResponse('users');
    }
    
    public function validateRoutingNumber($number) {
        PromisePay::RestClient(
            'get',
            'tools/routing_number',
            array('routing_number' => $number)
        );
        
        
        return PromisePay::getDecodedResponse('routing_number');
    }
}
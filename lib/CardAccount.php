<?php
namespace PromisePay;

class CardAccount {
    
    public function get($id) {
        PromisePay::RestClient('get', 'card_accounts/' . $id);
        
        return PromisePay::getDecodedResponse('card_accounts');
    }

    public function create($params) {
        PromisePay::RestClient('post', 'card_accounts?', $params);
        
        return PromisePay::getDecodedResponse('card_accounts');
    }

    public function delete($id) {
        PromisePay::RestClient('delete', 'card_accounts/' . $id);
        
        return PromisePay::getDecodedResponse('card_account');
    }
    
    public function redact($id) {
        return self::delete($id);
    }

    public function getUser($id) {
        PromisePay::RestClient('get', 'card_accounts/' . $id . '/users');
        
        return PromisePay::getDecodedResponse('users');
    }
}

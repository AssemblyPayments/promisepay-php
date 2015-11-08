<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class CardAccountRepository {
    
    public static function get($id) {
        PromisePay::checkIdNotNull($id);
        
        $response = PromisePay::RestClient('get', 'card_accounts/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['card_accounts'];
    }

    public static function create($params) {
        $response = PromisePay::RestClient('post', 'card_accounts?', $params);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['card_accounts'];
    }

    public static function delete($id) {
        PromisePay::checkIdNotNull($id);
        
        $response = PromisePay::RestClient('delete', 'card_accounts/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['card_account'];
    }

    public static function getUser($id) {
        PromisePay::checkIdNotNull($id);
        
        $response = PromisePay::RestClient('get', 'card_accounts/' . $id . '/users');
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['users'];
    }
}
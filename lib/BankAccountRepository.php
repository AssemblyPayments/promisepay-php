<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class BankAccountRepository {
    
    public static function get($id) {
        $response = PromisePay::RestClient('get', 'bank_accounts/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['bank_accounts'];
    }

    public static function create($params) {
        $response = PromisePay::RestClient('post', 'bank_accounts/', $params);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['bank_accounts'];
    }

    public static function delete($id) {
        $response = PromisePay::RestClient('delete', 'bank_accounts/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['bank_account'];
    }
    
    public static function redact($id) {
        return self::delete($id);
    }

    public static function getUser($id) {
        $response = PromisePay::RestClient('get', 'bank_accounts/' . $id . '/users');
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['users'];
    }
    
    public static function validateRoutingNumber($number) {
        $response = PromisePay::RestClient(
            'get',
            'tools/routing_number',
            array('routing_number' => $number)
        );
        
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['routing_number'];
    }
}
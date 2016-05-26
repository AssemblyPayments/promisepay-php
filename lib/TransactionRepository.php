<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;
use PromisePay\PromisePay;

class TransactionRepository {
    public static function getList($params = null) {
        $response = PromisePay::RestClient('get', 'transactions/', $params);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['transactions'];
    }

    public static function get($id) {
        $response = PromisePay::RestClient('get', 'transactions/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['transactions'];
    }

    public static function getUser($id) {
        $response = PromisePay::RestClient('get', 'transactions/' . $id . '/users');
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['users'];
    }

    public static function getFee($id) {
        $response = PromisePay::RestClient('get', 'transactions/' . $id . '/fees');
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['fees'];
    }
}
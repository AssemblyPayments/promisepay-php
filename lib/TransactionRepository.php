<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;
use PromisePay\PromisePay;

class TransactionRepository {
    public static function getList($limit = 10, $offset = 0)
    {
        $requestParams = array(
            'limit'  => $limit,
            'offset' => $offset
        );
        
        $response = PromisePay::RestClient('get', 'transactions/', $requestParams);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse;
    }

    public static function get($id)
    {
        $response = PromisePay::RestClient('get', 'transactions/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse;
    }

    public static function getUser($id)
    {
        $response = PromisePay::RestClient('get', 'transactions/' . $id . '/users');
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse;
    }

    public static function getFee($id)
    {
        $response = PromisePay::RestClient('get', 'transactions/' . $id . '/fees');
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse;
    }
}
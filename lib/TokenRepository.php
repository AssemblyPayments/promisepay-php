<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;
use PromisePay\PromisePay;

class TokenRepository
{
    public static function requestToken()
    {
        $response = PromisePay::RestClient('get', 'request_token/');
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse;
    }

    public static function requestSessionToken($params)
    {
        $response = PromisePay::RestClient('get', 'request_session_token/', $params);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse;
    }
}
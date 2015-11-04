<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class TokenRepository extends BaseRepository
{
    public function requestToken()
    {
        $response = $this->RestClient('get', 'request_token/');
        $jsonData = json_decode($response->raw_body, true)['request_token'];
        return $jsonData;
    }

    public function requestSessionToken($params)
    {
        $response = $this->RestClient('get', 'request_session_token/', $params);
        return json_decode($response->raw_body, true);
    }
}
<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class TokenRepository extends  ApiAbstract
{
    public function RequestToken()
    {
        $response = $this->RestClient('get','request_token/');
        $jsonData = json_decode($response->raw_body, true)['request_token'];
        return $jsonData;
    }

    public function RequestSessionToken()
    {

    }

    public function getWidget()
    {

    }

}
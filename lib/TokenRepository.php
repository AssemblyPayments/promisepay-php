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


    /**
     * Request Token Auths
     *
     * == Example $params ==
     *
     * Card Token :
     * [ 'token_type' => 'card', 'user_id' => $user_id ]
     *
     * Approve token :
     * [ 'token_type' => 4, 'email' => $marketplace_users_email, 'password' => $marketplace_users_password ]
     *
     * EUI token :
     * // Not available yet
     *
     * http://reference.promisepay.com/docs/generate-a-card-token
     *
     * @since 1.2 As per https://promisepay-api.readme.io/docs/generate-a-card-token
     * @param  array $params
     * @return array JSON decoded API response
     */
    public static function requestTokenAuths($params)
    {
        $response = PromisePay::RestClient('post', 'token_auths/', $params);
        $jsonDecodedResponse = json_decode($response->raw_body, true);

        return $jsonDecodedResponse;
    }
}

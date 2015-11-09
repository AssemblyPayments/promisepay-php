<?php
namespace PromisePay;

use PromisePay\PromisePay;
use PromisePay\Exception;
use PromisePay\Log;

class UserRepository
{

    public static function create($params)
    {
        $response = PromisePay::RestClient('post', 'users/', $params);
        $jsonDecodedResponse = json_decode($response->raw_body, true);

        return $jsonDecodedResponse['users'];
    }

    public static function get($id)
    {
        $response = PromisePay::RestClient('get', 'users/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);

        return $jsonDecodedResponse['users'];
    }

    public static function getList($params)
    {
        $response = PromisePay::RestClient('get', 'users/', $params);
        $jsonDecodedResponse = json_decode($response->raw_body, true);

        return $jsonDecodedResponse['users'];
    }

    public static function update($id, $params)
    {
        $response = PromisePay::RestClient('patch', 'users/' . $id . "/", $params);
        $jsonDecodedResponse = json_decode($response->raw_body, true);

        return $jsonDecodedResponse['users'];
    }

    public static function sendMobilePin($id)
    {
        $response = PromisePay::RestClient('post', '/users/' . $id . '/mobile_pin');
        return json_decode($response->raw_body, true);
    }

    public static function getListOfItems($id)
    {
        $response = PromisePay::RestClient('get', 'users/' . $id . '/items');
        $jsonDecodedResponse = json_decode($response->raw_body, true);

        return $jsonDecodedResponse['items'];
    }

    public static function getListOfBankAccounts($id)
    {
        $response = PromisePay::RestClient('get', 'users/' . $id . '/bank_accounts');
        $jsonDecodedResponse = json_decode($response->raw_body, true);

        return $jsonDecodedResponse['bank_accounts'];
    }

    public static function getListOfCardAccounts($id)
    {
        $response = PromisePay::RestClient('get', 'users/' . $id . '/card_accounts');
        $jsonDecodedResponse = json_decode($response->raw_body, true);

        return $jsonDecodedResponse['card_accounts'];
    }

    public static function getListOfPayPalAccounts($id)
    {
        $response = PromisePay::RestClient('get', 'users/' . $id . '/paypal_accounts');
        $jsonDecodedResponse = json_decode($response->raw_body, true);

        return $jsonDecodedResponse['paypal_accounts'];
    }

    public static function setDisbursementAccount($id, $params)
    {
        $response = PromisePay::RestClient('post', 'users/' . $id . '/disbursement_account', $params);
        return json_decode($response->raw_body, true);
    }

}

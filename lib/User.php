<?php
namespace PromisePay;

use PromisePay\PromisePay;
use PromisePay\Exception;
use PromisePay\Log;

class User {
    
    public static function create($params) {
        PromisePay::RestClient('post', 'users/', $params);

        return PromisePay::getDecodedResponse('users');
    }

    public static function get($id) {
        PromisePay::RestClient('get', 'users/' . $id);

        return PromisePay::getDecodedResponse('users');
    }

    public static function getList($params = null) {
        PromisePay::RestClient('get', 'users/', $params);

        return PromisePay::getDecodedResponse('users');
    }

    public static function update($id, $params) {
        PromisePay::RestClient('patch', 'users/' . $id . "/", $params);

        return PromisePay::getDecodedResponse('users');
    }

    public static function sendMobilePin($id) {
        PromisePay::RestClient('post', '/users/' . $id . '/mobile_pin');
        
        return PromisePay::getDecodedResponse();
    }

    public static function getListOfItems($id) {
        PromisePay::RestClient('get', 'users/' . $id . '/items');

        return PromisePay::getDecodedResponse('items');
    }

    public static function getListOfBankAccounts($id) {
        PromisePay::RestClient('get', 'users/' . $id . '/bank_accounts');

        return PromisePay::getDecodedResponse('bank_accounts');
    }

    public static function getListOfCardAccounts($id) {
        PromisePay::RestClient('get', 'users/' . $id . '/card_accounts');

        return PromisePay::getDecodedResponse('card_accounts');
    }

    public static function getListOfPayPalAccounts($id) {
        PromisePay::RestClient('get', 'users/' . $id . '/paypal_accounts');

        return PromisePay::getDecodedResponse('paypal_accounts');
    }
    
    public static function getListOfWalletAccounts($id) {
        PromisePay::RestClient('get', 'users/' . $id . '/wallet_accounts');
        
        return PromisePay::getDecodedResponse('wallet_accounts');
    }

    public static function setDisbursementAccount($id, $params) {
        PromisePay::RestClient('post', 'users/' . $id . '/disbursement_account', $params);
        
        return PromisePay::getDecodedResponse();
    }

}

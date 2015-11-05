<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class BankAccountRepository extends BaseRepository {
    public static function getBankAccountById($id) {
        $response = parent::RestClient('get', 'bank_accounts/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['bank_accounts'];
    }

    public static function createBankAccount($params) {
        $response = parent::RestClient('post', 'bank_accounts/', $params);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['bank_accounts'];
    }

    public static function deleteBankAccount($id) {
        $response = parent::RestClient('delete', 'bank_accounts/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['bank_account'];
    }

    public static function getUserForBankAccount($id) {
        $response = parent::RestClient('get','bank_accounts/' . $id . '/users');
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['users'];
    }
}
<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class CardAccountRepository extends BaseRepository {
    public static function getCardAccountById($id) {
        $response = parent::RestClient('get', 'card_accounts/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['card_accounts'];
    }

    public static function createCardAccount($params) {
        $response = parent::RestClient('post', 'card_accounts?', $params);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['card_accounts'];
    }

    public static function deleteCardAccount($id) {
        $response = parent::RestClient('delete', 'card_accounts/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['card_account'];
    }

    public static function getUserForCardAccount($id) {
        $response = parent::RestClient('get', 'users/' . $id . '/bank_accounts');
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['card_accounts'];
    }
}
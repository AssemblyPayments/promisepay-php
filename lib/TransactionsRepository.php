<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class TransactionsRepository {
    
    public static function get() {
        $response = PromisePay::RestClient('get', 'transactions/');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['transactions'];
    }
    
    public static function getById($id) {
        $response = PromisePay::RestClient('get', 'transactions/' . $id);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['transactions'];
    }
    
    public static function getUsers($id) {
        $response = PromisePay::RestClient('get', 'transactions/' . $id . '/users');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['users'];
    }
    
    public static function getFees($id) {
        $response = PromisePay::RestClient('get', 'transactions/' . $id . '/fees');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['fees'];
    }
    
    public static function getDisbursements($id) {
        $response = PromisePay::RestClient('get', 'transactions/' . $id . '/disbursements');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['disbursements'];
    }
    
    public static function getWalletAccounts($id) {
        $response = PromisePay::RestClient('get', 'transactions/' . $id . '/wallet_accounts');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['wallet_accounts'];
    }
    
    public static function getBankAccounts($id) {
        $response = PromisePay::RestClient('get', 'transactions/' . $id . '/bank_accounts');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['bank_accounts'];
    }
    
    public static function getCardAccounts($id) {
        $response = PromisePay::RestClient('get', 'transactions/' . $id . '/card_accounts');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['card_accounts'];
    }
    
    public static function getPayPalAccounts($id) {
        $response = PromisePay::RestClient('get', 'transactions/' . $id . '/paypal_accounts');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['paypal_accounts'];
    }
    
}
<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class DisbursementRepository {
    
    public static function get() {
        $response = PromisePay::RestClient('get', 'disbursements/');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['disbursements'];
    }
    
    public static function getById($id) {
        $response = PromisePay::RestClient('get', 'disbursements/' . $id);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['disbursements'];
    }
    
    public static function getTransactions($id) {
        $response = PromisePay::RestClient('get', 'disbursements/' . $id . '/transactions');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['transactions'];
    }
    
    public static function getWalletAccounts($id) {
        $response = PromisePay::RestClient('get', 'disbursements/' . $id . '/wallet_accounts');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['wallet_accounts'];
    }
    
    public static function getBankAccounts($id) {
        $response = PromisePay::RestClient('get', 'disbursements/' . $id . '/bank_accounts');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['bank_accounts'];
    }
    
    public static function getPayPalAccounts($id) {
        $response = PromisePay::RestClient('get', 'disbursements/' . $id . '/paypal_accounts');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['paypal_accounts'];
    }
    
}
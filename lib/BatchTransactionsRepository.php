<?php
namespace PromisePay;

class BatchTransactionsRepository {
    
    public static function listTransactions($filters = array()) {
        PromisePay::RestClient('get', 'batch_transactions/', $filters);
        
        return PromisePay::getDecodedResponse();
    }
    
    public static function showTransaction($id) {
    }
    
}

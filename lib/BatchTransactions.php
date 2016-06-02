<?php
namespace PromisePay;

class BatchTransactions {
    
    public static function listTransactions($filters = array()) {
        PromisePay::RestClient('get', 'batch_transactions/', $filters);
        
        return PromisePay::getDecodedResponse('batch_transactions');
    }
    
    public static function showTransaction($id) {
        PromisePay::RestClient('get', 'batch_transactions/' . $id);
        
        return PromisePay::getDecodedResponse('batch_transactions');
    }
    
}

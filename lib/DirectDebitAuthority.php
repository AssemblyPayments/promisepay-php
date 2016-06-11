<?php
namespace PromisePay;

class DirectDebitAuthority {
    
    public function create($params) {
        PromisePay::RestClient('post', 'direct_debit_authorities/', $params);
        
        return PromisePay::getDecodedResponse('direct_debit_authorities');
    }
    
    public function getList($params) {
        PromisePay::RestClient('get', 'direct_debit_authorities', $params);
        
        return PromisePay::getDecodedResponse('direct_debit_authorities');
    }
    
    public function get($id) {
        PromisePay::RestClient('get', 'direct_debit_authorities/' . $id);
        
        return PromisePay::getDecodedResponse('direct_debit_authorities');
    }
    
    public function show($id) {
        return $this->get($id);
    }
    
    public function delete($id) {
        // DELETE direct_debit_authorities doesn't 
        // return JSON on success, but NULL
        PromisePay::RestClient('delete', 'direct_debit_authorities/' . $id);
        
        $result = PromisePay::getDebugData();
        
        if ($result->code == 200) {
            return true;
        } else {
            return false;
        }
    }
    
}

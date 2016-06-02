<?php
namespace PromisePay;

class DirectDebitAuthority extends PromisePay {
    
    public function create($params) {
        $this->RestClient('post', 'direct_debit_authorities/', $params);
        
        return $this->getDecodedResponse('direct_debit_authorities');
    }
    
    public function getList($params) {
        $this->RestClient('get', 'direct_debit_authorities', $params);
        
        return $this->getDecodedResponse('direct_debit_authorities');
    }
    
}

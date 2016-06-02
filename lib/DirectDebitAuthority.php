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
    
    public function get($id) {
        $this->RestClient('get', 'direct_debit_authorities/' . $id);
        
        return $this->getDecodedResponse('direct_debit_authorities');
    }
    
    public function show($id) {
        return $this->get($id);
    }
    
    public function delete($id) {
        // DELETE direct_debit_authorities doesn't 
        // return JSON on success, but NULL
        $this->RestClient('delete', 'direct_debit_authorities/' . $id);
        
        $result = $this->getDebugData();
        
        if ($result->code == 200) {
            return true;
        } else {
            return false;
        }
    }
    
}

<?php
namespace PromisePay;

class Item extends PromisePay {
    
    public function getList($params = null) {
        $this->RestClient('get', 'items/', $params);
        
        return $this->getDecodedResponse('items');
    }

    public function get($id) {
        $this->RestClient('get', 'items/' . $id);
        
        return $this->getDecodedResponse('items');
    }

    public function create($params) {
        $this->RestClient('post', 'items/', $params);
        
        return $this->getDecodedResponse('items');
    }

    public function delete($id) {
        $this->RestClient('delete', 'items/' . $id);
        
        return $this->getDecodedResponse('items');
    }

    public function update($id, $params) {
        $this->RestClient('patch', 'items/' . $id . '/', $params);
        
        return $this->getDecodedResponse('items');
    }

    public function makePayment($id, $params) {
        $this->RestClient('patch', 'items/' . $id . '/make_payment', $params);
        
        return $this->getDecodedResponse('items');
    }

    public function getListOfTransactions($id) {
        $this->RestClient('get', 'items/' . $id . '/transactions');
        
        return $this->getDecodedResponse('transactions');
    }

    public function getStatus($id) {
        $this->RestClient('get', 'items/' . $id . '/status');
        
        return $this->getDecodedResponse('items');
    }

    public function getListOfFees($id) {
        $this->RestClient('get', 'items/' . $id . '/fees');
        
        return $this->getDecodedResponse('fees');
    }

    public function getBuyer($id) {
        $this->RestClient('get', 'items/' . $id . '/buyers');
        
        return $this->getDecodedResponse('users');
    }

    public function getSeller($id) {
        $this->RestClient('get', 'items/' . $id . '/sellers');
        
        return $this->getDecodedResponse('users');
    }

    public function getWireDetails($id) {
        $this->RestClient('get', 'items/' . $id . '/wire_details');
        
        return $this->getDecodedResponse('items');
    }

    public function getBPayDetails($id) {
        $this->RestClient('get', 'items/' . $id . '/bpay_details');
        
        return $this->getDecodedResponse('items');
    }

    public function requestPayment($id) {
        $this->RestClient('patch', 'items/' . $id . '/request_payment');
        
        return $this->getDecodedResponse('items');
    }

    public function releasePayment($id, $params = array()) {
        $this->RestClient('patch', 'items/' . $id . '/release_payment', $params);
        
        return $this->getDecodedResponse('items');
    }
    
    public function requestRelease($id, $params = array()) {
        $this->RestClient('patch', 'items/' . $id . '/request_release', $params);
        
        return $this->getDecodedResponse('items');
    }

    public function cancelItem($id) {
        $this->RestClient('patch', 'items/' . $id . '/cancel');
        
        return $this->getDecodedResponse('items');
    }

    public function acknowledgeWire($id) {
        $this->RestClient('patch', 'items/' . $id . '/acknowledge_wire');
        
        return $this->getDecodedResponse('items');
    }

    public function acknowledgePayPal($id) {
        $this->RestClient('patch', 'items/' . $id . '/acknowledge_paypal');
        
        return $this->getDecodedResponse('items');
    }

    public function revertWire($id) {
        $this->RestClient('patch', 'items/' . $id . '/revert_wire');
        
        return $this->getDecodedResponse('items');
    }

    public function requestRefund($id, $params = array()) {
        $this->RestClient('patch', 'items/' . $id . '/request_refund', $params);
        
        return $this->getDecodedResponse('items');
    }

    public function refund($id, $params = array()) {
        $this->RestClient('patch', 'items/' . $id . '/refund', $params);
        
        return $this->getDecodedResponse('items');
    }
    
    public function declineRefund($id) {
        $this->RestClient('patch', 'items/' . $id . '/decline_refund');
        
        return $this->getDecodedResponse('items');
    }
    
    public function raiseDispute($itemId, $userId) {
        $params = array(
            'user_id' => $userId
        );
        
        $this->RestClient('patch', 'items/' . $itemId . '/raise_dispute', $params);
        
        return $this->getDecodedResponse('items');
    }
    
    public function requestDisputeResolution($itemId) {
        $this->RestClient('patch', 'items/' . $itemId . '/request_resolve_dispute');
        
        return $this->getDecodedResponse('items');
    }
    
    public function resolveDispute($itemId) {
        $this->RestClient('patch', 'items/' . $itemId . '/resolve_dispute');
        
        return $this->getDecodedResponse('items');
    }
    
    public function escalateDispute($itemId) {
        $this->RestClient('patch', 'items/' . $itemId . '/escalate_dispute');
        
        return $this->getDecodedResponse('items');
    }
    
    public function sendTaxInvoice($itemId) {
        $this->restClient('patch', 'items/' . $itemId . '/send_tax_invoice');
        
        return $this->getDecodedResponse('items');
    }
    
    public function requestTaxInvoice($itemId) {
        $this->restClient('patch', 'items/' . $itemId . '/request_tax_invoice');
        
        return $this->getDecodedResponse('items');
    }
    
}

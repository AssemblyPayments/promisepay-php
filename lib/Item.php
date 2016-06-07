<?php
namespace PromisePay;

class Item {    
    public function getList($params = null) {
        PromisePay::RestClient('get', 'items/', $params);
        
        return PromisePay::getDecodedResponse('items');
    }

    public function get($id) {
        PromisePay::RestClient('get', 'items/' . $id);
        
        return PromisePay::getDecodedResponse('items');
    }

    public function create($params) {
        PromisePay::RestClient('post', 'items/', $params);
        
        return PromisePay::getDecodedResponse('items');
    }

    public function delete($id) {
        PromisePay::RestClient('delete', 'items/' . $id);
        
        return PromisePay::getDecodedResponse('items');
    }

    public function update($id, $params) {
        PromisePay::RestClient('patch', 'items/' . $id . '/', $params);
        
        return PromisePay::getDecodedResponse('items');
    }

    public function makePayment($id, $params) {
        PromisePay::RestClient('patch', 'items/' . $id . '/make_payment', $params);
        
        return PromisePay::getDecodedResponse('items');
    }

    public function getListOfTransactions($id) {
        PromisePay::RestClient('get', 'items/' . $id . '/transactions');
        
        return PromisePay::getDecodedResponse('transactions');
    }

    public function getStatus($id) {
        PromisePay::RestClient('get', 'items/' . $id . '/status');
        
        return PromisePay::getDecodedResponse('items');
    }

    public function getListOfFees($id) {
        PromisePay::RestClient('get', 'items/' . $id . '/fees');
        
        return PromisePay::getDecodedResponse('fees');
    }

    public function getBuyer($id) {
        PromisePay::RestClient('get', 'items/' . $id . '/buyers');
        
        return PromisePay::getDecodedResponse('users');
    }

    public function getSeller($id) {
        PromisePay::RestClient('get', 'items/' . $id . '/sellers');
        
        return PromisePay::getDecodedResponse('users');
    }

    public function getWireDetails($id) {
        PromisePay::RestClient('get', 'items/' . $id . '/wire_details');
        
        return PromisePay::getDecodedResponse('items');
    }

    public function getBPayDetails($id) {
        PromisePay::RestClient('get', 'items/' . $id . '/bpay_details');
        
        return PromisePay::getDecodedResponse('items');
    }

    public function requestPayment($id) {
        PromisePay::RestClient('patch', 'items/' . $id . '/request_payment');
        
        return PromisePay::getDecodedResponse('items');
    }

    public function releasePayment($id, $params = array()) {
        PromisePay::RestClient('patch', 'items/' . $id . '/release_payment', $params);
        
        return PromisePay::getDecodedResponse('items');
    }
    
    public function requestRelease($id, $params = array()) {
        PromisePay::RestClient('patch', 'items/' . $id . '/request_release', $params);
        
        return PromisePay::getDecodedResponse('items');
    }

    public function cancelItem($id) {
        PromisePay::RestClient('patch', 'items/' . $id . '/cancel');
        
        return PromisePay::getDecodedResponse('items');
    }

    public function acknowledgeWire($id) {
        PromisePay::RestClient('patch', 'items/' . $id . '/acknowledge_wire');
        
        return PromisePay::getDecodedResponse('items');
    }

    public function acknowledgePayPal($id) {
        PromisePay::RestClient('patch', 'items/' . $id . '/acknowledge_paypal');
        
        return PromisePay::getDecodedResponse('items');
    }

    public function revertWire($id) {
        PromisePay::RestClient('patch', 'items/' . $id . '/revert_wire');
        
        return PromisePay::getDecodedResponse('items');
    }

    public function requestRefund($id, $params = array()) {
        PromisePay::RestClient('patch', 'items/' . $id . '/request_refund', $params);
        
        return PromisePay::getDecodedResponse('items');
    }

    public function refund($id, $params = array()) {
        PromisePay::RestClient('patch', 'items/' . $id . '/refund', $params);
        
        return PromisePay::getDecodedResponse('items');
    }
    
    public function declineRefund($id) {
        PromisePay::RestClient('patch', 'items/' . $id . '/decline_refund');
        
        return PromisePay::getDecodedResponse('items');
    }
    
    public function raiseDispute($itemId, $userId) {
        $params = array(
            'user_id' => $userId
        );
        
        PromisePay::RestClient('patch', 'items/' . $itemId . '/raise_dispute', $params);
        
        return PromisePay::getDecodedResponse('items');
    }
    
    public function requestDisputeResolution($itemId) {
        PromisePay::RestClient('patch', 'items/' . $itemId . '/request_resolve_dispute');
        
        return PromisePay::getDecodedResponse('items');
    }
    
    public function resolveDispute($itemId) {
        PromisePay::RestClient('patch', 'items/' . $itemId . '/resolve_dispute');
        
        return PromisePay::getDecodedResponse('items');
    }
    
    public function escalateDispute($itemId) {
        PromisePay::RestClient('patch', 'items/' . $itemId . '/escalate_dispute');
        
        return PromisePay::getDecodedResponse('items');
    }
    
    public function sendTaxInvoice($itemId) {
        PromisePay::RestClient('patch', 'items/' . $itemId . '/send_tax_invoice');
        
        return PromisePay::getDecodedResponse('items');
    }
    
    public function requestTaxInvoice($itemId) {
        PromisePay::RestClient('patch', 'items/' . $itemId . '/request_tax_invoice');
        
        return PromisePay::getDecodedResponse('items');
    }
}
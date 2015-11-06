<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class ItemRepository extends PromisePay {
    
    public static function getListOfItems($limit = 10, $offset = 0)
    {
        PromisePay::paramsListCorrect($limit, $offset);
        
        $requestQuery = array(
            'limit'  => $limit,
            'offset' => $offset
        );
        
        $response = parent::RestClient('get', 'items/', $requestQuery);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['items'];
    }

    public static function getItemById($id)
    {
        $response = parent::RestClient('get', 'items/' . $id);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['items'];
    }

    public static function createItem($params)
    {
        $response = parent::RestClient('post', 'items/', $params);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['items'];
    }

    public static function deleteItem($id)
    {
        $response = parent::RestClient('delete', 'items/' . $id);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['items'];
    }

    public static function updateItem($id, $params)
    {
        $response = parent::RestClient('patch', 'items/' . $id . '/', $params);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['items'];
    }
    
    public static function makePayment($id, $params)
    {
        $response = parent::RestClient('patch', 'items/' . $id . '/make_payment', $params);
        return json_decode($response->raw_body, true);
    }

    public static function getListOfTransactionsForItem($id)
    {
        $response = parent::RestClient('get', 'items/' . $id . '/transactions');
        return json_decode($response->raw_body, true);
    }

    public static function getItemStatus($id)
    {
        $response = parent::RestClient('get', 'items/' . $id . '/status');
        return json_decode($response->raw_body, true);
    }

    public static function getListFeesForItems($id)
    {
        $response = parent::RestClient('get', 'items/' . $id . '/fees');
        return json_decode($response->raw_body, true);
    }

    public static function getBuyerOfItem($id)
    {
        $response = parent::RestClient('get', 'items/' . $id . '/buyers');
        return json_decode($response->raw_body, true);
    }

    public static function getSellerForItem($id)
    {
        $response = parent::RestClient('get', 'items/' . $id . '/sellers');
        return json_decode($response->raw_body, true);
    }

    public static function getWireDetailsForItem($id)
    {
        $response = parent::RestClient('get', 'items/' . $id . '/wire_details');
        return json_decode($response->raw_body, true);
    }

    public static function getBPayDetailsForItem($id)
    {
        $response = parent::RestClient('get', 'items/' . $id . '/bpay_details');
        return json_decode($response->raw_body, true);
    }

    public static function requestPayment($id)
    {
        $response = parent::RestClient('patch', 'items/' . $id . '/request_payment');
        return json_decode($response->raw_body, true);
    }

    public static function releasePayment($id, $params)
    {
        $response = parent::RestClient('patch', 'items/' . $id . '/release_payment', $params);
        return json_decode($response->raw_body, true);
    }


    public static function requestRelease($id, $params)
    {
        $response = parent::RestClient('patch', 'items/' . $id . '/request_release', $params);
        return json_decode($response->raw_body, true);
    }

    public static function cancelItem($id)
    {
        $response = parent::RestClient('patch', 'items/' . $id . '/cancel');
        return json_decode($response->raw_body, true);
    }

    public static function acknowledgeWire($id)
    {
        $response = parent::RestClient('patch', 'items/' . $id . '/acknowledge_wire');
        return json_decode($response->raw_body, true);
    }

    public static function acknowledgePayPal($id)
    {
        $response = parent::RestClient('patch', 'items/' . $id . '/acknowledge_paypal');
        return json_decode($response->raw_body, true);
    }

    public static function revertWire($id)
    {
        $response = parent::RestClient('patch', 'items/' . $id . '/revert_wire');
        return json_decode($response->raw_body, true);
    }

    public static function requestRefund($id, $params)
    {
        $response = parent::RestClient('patch', 'items/' . $id . '/request_refund', $params);
        return json_decode($response->raw_body, true);
    }

    public static function refund($id, $params)
    {
        $response = parent::RestClient('patch', 'items/' . $id . '/refund', $params);
        return json_decode($response->raw_body, true);
    }
}

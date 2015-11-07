<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class ItemRepository {
    
    public static function getList($limit = 10, $offset = 0)
    {
        PromisePay::paramsListCorrect($limit, $offset);
        
        $requestQuery = array(
            'limit'  => $limit,
            'offset' => $offset
        );
        
        $response = PromisePay::RestClient('get', 'items/', $requestQuery);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['items'];
    }

    public static function get($id)
    {
        $response = PromisePay::RestClient('get', 'items/' . $id);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['items'];
    }

    public static function create($params)
    {
        $response = PromisePay::RestClient('post', 'items/', $params);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['items'];
    }

    public static function delete($id)
    {
        $response = PromisePay::RestClient('delete', 'items/' . $id);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['items'];
    }

    public static function update($id, $params)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/', $params);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['items'];
    }
    
    public static function makePayment($id, $params)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/make_payment', $params);
        return json_decode($response->raw_body, true);
    }

    public static function getListOfTransactions($id)
    {
        $response = PromisePay::RestClient('get', 'items/' . $id . '/transactions');
        return json_decode($response->raw_body, true);
    }

    public static function getStatus($id)
    {
        $response = PromisePay::RestClient('get', 'items/' . $id . '/status');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['items'];
    }

    public static function getListOfFees($id)
    {
        $response = PromisePay::RestClient('get', 'items/' . $id . '/fees');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['fees'];
    }

    public static function getBuyer($id)
    {
        $response = PromisePay::RestClient('get', 'items/' . $id . '/buyers');
        return json_decode($response->raw_body, true);
    }

    public static function getSeller($id)
    {
        $response = PromisePay::RestClient('get', 'items/' . $id . '/sellers');
        return json_decode($response->raw_body, true);
    }

    public static function getWireDetails($id)
    {
        $response = PromisePay::RestClient('get', 'items/' . $id . '/wire_details');
        return json_decode($response->raw_body, true);
    }

    public static function getBPayDetails($id)
    {
        $response = PromisePay::RestClient('get', 'items/' . $id . '/bpay_details');
        return json_decode($response->raw_body, true);
    }

    public static function requestPayment($id)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/request_payment');
        return json_decode($response->raw_body, true);
    }

    public static function releasePayment($id, $params)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/release_payment', $params);
        return json_decode($response->raw_body, true);
    }


    public static function requestRelease($id, $params)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/request_release', $params);
        return json_decode($response->raw_body, true);
    }

    public static function cancelItem($id)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/cancel');
        return json_decode($response->raw_body, true);
    }

    public static function acknowledgeWire($id)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/acknowledge_wire');
        return json_decode($response->raw_body, true);
    }

    public static function acknowledgePayPal($id)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/acknowledge_paypal');
        return json_decode($response->raw_body, true);
    }

    public static function revertWire($id)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/revert_wire');
        return json_decode($response->raw_body, true);
    }

    public static function requestRefund($id, $params)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/request_refund', $params);
        return json_decode($response->raw_body, true);
    }

    public static function refund($id, $params)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/refund', $params);
        return json_decode($response->raw_body, true);
    }
}

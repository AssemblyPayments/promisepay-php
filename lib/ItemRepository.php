<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class ItemRepository
{

    public static function getList($params = null)
    {
        $response = PromisePay::RestClient('get', 'items/', $params);
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
        $jsonDecodedResponse = json_decode($response, true);

        return $jsonDecodedResponse['items'];
    }

    public static function getListOfTransactions($id)
    {
        $response = PromisePay::RestClient('get', 'items/' . $id . '/transactions');
        $jsonDecodedResponse = json_decode($response, true);

        return $jsonDecodedResponse['transactions'];
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
        $jsonDecodedResponse = json_decode($response, true);

        return $jsonDecodedResponse['users'];
    }

    public static function getSeller($id)
    {
        $response = PromisePay::RestClient('get', 'items/' . $id . '/sellers');
        $jsonDecodedResponse = json_decode($response, true);

        return $jsonDecodedResponse['users'];
    }

    public static function getWireDetails($id)
    {
        $response = PromisePay::RestClient('get', 'items/' . $id . '/wire_details');
        $jsonDecodedResponse = json_decode($response, true);

        return $jsonDecodedResponse['items'];
    }

    public static function getBPayDetails($id)
    {
        $response = PromisePay::RestClient('get', 'items/' . $id . '/bpay_details');
        $jsonDecodedResponse = json_decode($response, true);

        return $jsonDecodedResponse['items'];
    }

    public static function requestPayment($id)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/request_payment');
        $jsonDecodedResponse = json_decode($response, true);

        return $jsonDecodedResponse['items'];
    }

    public static function releasePayment($id, $params)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/release_payment', $params);
        $jsonDecodedResponse = json_decode($response, true);

        return $jsonDecodedResponse['items'];
    }

    public static function requestRelease($id, $params)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/request_release', $params);
        $jsonDecodedResponse = json_decode($response, true);

        return $jsonDecodedResponse['items'];
    }

    public static function cancelItem($id)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/cancel');
        $jsonDecodedResponse = json_decode($response, true);

        return $jsonDecodedResponse['items'];
    }

    public static function acknowledgeWire($id)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/acknowledge_wire');
        $jsonDecodedResponse = json_decode($response, true);

        return $jsonDecodedResponse['items'];
    }

    public static function acknowledgePayPal($id)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/acknowledge_paypal');
        $jsonDecodedResponse = json_decode($response, true);

        return $jsonDecodedResponse['items'];
    }

    public static function revertWire($id)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/revert_wire');
        $jsonDecodedResponse = json_decode($response, true);

        return $jsonDecodedResponse['items'];
    }

    public static function requestRefund($id, $params)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/request_refund', $params);
        $jsonDecodedResponse = json_decode($response, true);

        return $jsonDecodedResponse['items'];
    }

    public static function refund($id, $params)
    {
        $response = PromisePay::RestClient('patch', 'items/' . $id . '/refund', $params);
        $jsonDecodedResponse = json_decode($response, true);

        return $jsonDecodedResponse['items'];
    }
}

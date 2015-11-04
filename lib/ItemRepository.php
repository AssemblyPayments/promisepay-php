<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class ItemRepository extends BaseRepository
{
    public function getListOfItems($params)
    {
        $response = $this->RestClient('get', 'items/', $params);
        return json_decode($response->raw_body, true);
    }

    public function getItemById($id)
    {
        $response = $this->RestClient('get', 'items/' . $id);
        return json_decode($response->raw_body, true);
    }

    public function createItem($params)
    {
        $response = $this->RestClient('post', 'items/', $params);
        return json_decode($response->raw_body, true);
    }

    public function deleteItem($id)
    {
        $response = $this->RestClient('delete', 'items/' . $id);
        return json_decode($response->raw_body, true);
    }

    public function updateItem($id, $params)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/', $params);
        return json_decode($response->raw_body, true);
    }

    public function getListOfTransactionsForItem($id)
    {
        $response = $this->RestClient('get', 'items/' . $id . '/transactions');
        return json_decode($response->raw_body, true);
    }

    public function getItemStatus($id)
    {
        $response = $this->RestClient('get', 'items/' . $id . '/status');
        return json_decode($response->raw_body, true);
    }

    public function getListFeesForItems($id)
    {
        $response = $this->RestClient('get', 'items/' . $id . '/fees');
        return json_decode($response->raw_body, true);
    }

    public function getBuyerOfItem($id)
    {
        $response = $this->RestClient('get', 'items/' . $id . '/buyers');
        return json_decode($response->raw_body, true);
    }

    public function getSellerForItem($id)
    {
        $response = $this->RestClient('get', 'items/' . $id . '/sellers');
        return json_decode($response->raw_body, true);
    }

    public function getWireDetailsForItem($id)
    {
        $response = $this->RestClient('get', 'items/' . $id . '/wire_details');
        return json_decode($response->raw_body, true);
    }

    public function getBPayDetailsForItem($id)
    {
        $response = $this->RestClient('get', 'items/' . $id . '/bpay_details');
        return json_decode($response->raw_body, true);
    }

    public function makePayment($id, $params)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/make_payment', $params);
        return json_decode($response->raw_body, true);
    }

    public function requestPayment($id)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/request_payment');
        return json_decode($response->raw_body, true);
    }

    public function releasePayment($id, $params)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/release_payment', $params);
        return json_decode($response->raw_body, true);
    }


    public function requestRelease($id, $params)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/request_release', $params);
        return json_decode($response->raw_body, true);
    }

    public function cancelItem($id)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/cancel');
        return json_decode($response->raw_body, true);
    }

    public function acknowledgeWire($id)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/acknowledge_wire');
        return json_decode($response->raw_body, true);
    }

    public function acknowledgePayPal($id)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/acknowledge_paypal');
        return json_decode($response->raw_body, true);
    }

    public function revertWire($id)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/revert_wire');
        return json_decode($response->raw_body, true);
    }

    public function requestRefund($id, $params)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/request_refund', $params);
        return json_decode($response->raw_body, true);
    }

    public function refund($id, $params)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/refund', $params);
        return json_decode($response->raw_body, true);
    }
}

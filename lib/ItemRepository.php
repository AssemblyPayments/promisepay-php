<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class ItemRepository extends BaseRepository
{
    public function getListOfItems($params)
    {
        $response = $this->RestClient('get', 'items/', $this->generate_payload($params));
        return $this->generate_response($response);
    }

    public function getItemById($id)
    {
        $response = $this->RestClient('get', 'items/' . $id);
        return $this->generate_response($response);
    }

    public function createItem($params)
    {
        $response = $this->RestClient('post', 'items/', $this->generate_payload($params));
        return $this->generate_response($response);
    }

    public function deleteItem($id)
    {
        $response = $this->RestClient('delete', 'items/' . $id);
        return $this->generate_response($response);
    }

    public function updateItem($id, $params)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/', $this->generate_payload($params));
        return $this->generate_response($response);
    }

    public function getListOfTransactionsForItem($id)
    {
        $response = $this->RestClient('get', 'items/' . $id . '/transactions');
        return $this->generate_response($response);
    }

    public function getItemStatus($id)
    {
        $response = $this->RestClient('get', 'items/' . $id . '/status');
        return $this->generate_response($response);
    }

    public function getListFeesForItems($id)
    {
        $response = $this->RestClient('get', 'items/' . $id . '/fees');
        return $this->generate_response($response);
    }

    public function getBuyerOfItem($id)
    {
        $response = $this->RestClient('get', 'items/' . $id . '/buyers');
        return $this->generate_response($response);
    }

    public function getSellerForItem($id)
    {
        $response = $this->RestClient('get', 'items/' . $id . '/sellers');
        return $this->generate_response($response);
    }

    public function getWireDetailsForItem($id)
    {
        $response = $this->RestClient('get', 'items/' . $id . '/wire_details');
        return $this->generate_response($response);
    }

    public function getBPayDetailsForItem($id)
    {
        $response = $this->RestClient('get', 'items/' . $id . '/bpay_details');
        return $this->generate_response($response);
    }

    public function makePayment($id, $params)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/make_payment', $this->generate_payload($params));
        return $this->generate_response($response);
    }

    public function requestPayment($id)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/request_payment');
        return $this->generate_response($response);
    }

    public function releasePayment($id, $params)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/release_payment', $this->generate_payload($params));
        return $this->generate_response($response);
    }


    public function requestRelease($id, $params)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/request_release', $this->generate_payload($params));
        return $this->generate_response($response);
    }

    public function cancelItem($id)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/cancel');
        return $this->generate_response($response);
    }

    public function acknowledgeWire($id)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/acknowledge_wire');
        return $this->generate_response($response);
    }

    public function acknowledgePayPal($id)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/acknowledge_paypal');
        return $this->generate_response($response);
    }

    public function revertWire($id)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/revert_wire');
        return $this->generate_response($response);
    }

    public function requestRefund($id, $params)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/request_refund', $this->generate_payload($params));
        return $this->generate_response($response);
    }

    public function refund($id, $params)
    {
        $response = $this->RestClient('patch', 'items/' . $id . '/refund', $this->generate_payload($params));
        return $this->generate_response($response);
    }
}

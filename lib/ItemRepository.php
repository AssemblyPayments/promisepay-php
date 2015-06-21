<?php
namespace PromisePay;

use PromisePay\DataObjects\BPayDetails;
use PromisePay\DataObjects\ItemStatus;
use PromisePay\DataObjects\WireDetails;
use PromisePay\Exception;
use PromisePay\Log;

use PromisePay\DataObjects\Item;
use PromisePay\DataObjects\User;

class ItemRepository extends ApiAbstract
{
    public function getListOfItems($limit = 20, $offset = 0)
    {
        $this->paramsListCorrect($limit,$offset);
        $response = $this->RestClient('get', 'items?limit=' . $limit . '&offset=' . $offset, '', '');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("items", $jsonRaw))
        {
            $jsonData = $jsonRaw['items'];
            $allItems = array();
            foreach($jsonData as $oneItem )
            {
                $item = new Item($oneItem);
                array_push($allItems, $item);
            }
            return $allItems;
        }
        return null;
    }

    public function getItemById($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'items/' . $id);
        $jsonData = json_decode($response->raw_body, true)['items'];
        $item = new Item($jsonData);
        return $item;
    }

    public function createItem($item)
    {
        $payload = '';
        $preparePayload = array(
            "id"            => $item->getId(),
            "name"          => $item->getName(),
            "amount"        => $item->getAmount(),
            "payment_type"  => $item->getPaymentType(),
            "buyer_id"      => $item->getBuyerId(),
            "seller_id"     => $item->getSellerId(),
            "fee_ids"       => $item->getFeeIds(),
            "description"   => $item->getDescription()
        );
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }

        $response = $this->RestClient('post', 'items/', $payload, '');

        if($response->body->errors)
        {
            $errors = new Errors(get_object_vars($response->body->errors));
            return $errors;
        }
        else
        {
            $jsonData = json_decode($response->raw_body, true)['items'];
            $item = new Item($jsonData);
            return $item;
        }
    }

    public function deleteItem($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('delete', 'items/' . $id);
    }

    public function updateItem($item)
    {
        $payload = '';
        $preparePayload = array(
            "name"          => $item->getName(),
            "amount"        => $item->getAmount(),
            "buyer_id"      => $item->getBuyerId(),
            "seller_id"     => $item->getSellerId(),
            "fee_ids"       => $item->getFeeIds(),
            "description"   => $item->getDescription()
        );
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $payload = substr($payload,0,-1);
        $response = $this->RestClient('patch', 'items/' . $item->getId(), $payload, '');

        if($response->body->errors)
        {
            $errors = new Errors(get_object_vars($response->body->errors));
            return $errors;
        }
        else
        {
            $jsonData = json_decode($response->raw_body, true)['items'];
            $editedItem = new Item($jsonData);
            return $editedItem;
        }
    }

    public function getListOfTransactionsForItem($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'items/' . $id . '/transactions');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("transactions", $jsonRaw))
        {
            $jsonData = $jsonRaw["transactions"];
            $allTransactions = array();
            foreach ($jsonData as $oneTransaction) {
                $transaction = new Transaction($oneTransaction);
                array_push($allTransactions, $transaction);
            }
            return $allTransactions;
        }
        return array();
    }

    public function getItemStatus($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'items/' . $id . '/status');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("items", $jsonRaw))
        {
            $jsonData = $jsonRaw["items"];
            $itemStatus = new ItemStatus($jsonData);
            return $itemStatus;
        }
        return null;
    }

    public function getListFeesForItems($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'items/' . $id . '/fees');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("fees", $jsonRaw))
        {
            $jsonData = $jsonRaw["fees"];
            $allFees = array();
            foreach ($jsonData as $oneFee) {
                $fee = new Fee($oneFee);
                array_push($allFees, $fee);
            }
            return $allFees;
        }
        return array();
    }

    public function getBuyerOfItem($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'items/' . $id . '/buyers');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("users", $jsonRaw))
        {
            $jsonData = $jsonRaw["users"];
            $user = new User($jsonData);
            return $user;
        }
        return null;
    }

    public function getSellerForItem($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'items/' . $id . '/sellers');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("users", $jsonRaw))
        {
            $jsonData = $jsonRaw["users"];
            $user = new User($jsonData);
            return $user;
        }
        return null;
    }

    public function getWireDetailsForIem($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'items/' . $id . '/wire_details');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("items", $jsonRaw))
        {
            $jsonData = $jsonRaw["items"];
            $wireDetails = new WireDetails($jsonData);
            return $wireDetails;
        }
        return null;
    }

    public function getBPayDetailsForItem($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'items/' . $id . '/bpay_details');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("items", $jsonRaw))
        {
            $jsonData = $jsonRaw["items"];
            $bpayDetails = new BPayDetails($jsonData);
            return $bpayDetails;
        }
        return null;
    }

    public function makePayment()
    {

    }

    public function requestPayment()
    {

    }

    public function releasePayment()
    {

    }

    public function requestRelease()
    {

    }

    public function cancelItem()
    {

    }

    public function acknowledgeWire()
    {

    }

    public function acknowledgePayPal()
    {

    }

    public function revertWire()
    {

    }

    public function requestRefund()
    {

    }

    public function Refund()
    {

    }
}

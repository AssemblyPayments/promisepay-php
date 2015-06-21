<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

use PromisePay\DataObjects\Item;

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
        //return json_decode($response->raw_body, true)['items'];
    }

    public function updateItem($id)
    {

    }

    public function getListOfTransactionsForItem($id)
    {

    }

    public function getItemStatus($id)
    {

    }

    public function getListFeesForItems($id)
    {

    }

    public function getBuyerOfItem()
    {

    }

    public function getSellerForItem()
    {

    }

    public function getWireDetailsForIem()
    {

    }

    public function getBPayDetailsForItem()
    {

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

<?php
namespace PromisePay;

use PromisePay\DataObjects\BPayDetails;
use PromisePay\DataObjects\Fee;
use PromisePay\DataObjects\ItemStatus;
use PromisePay\DataObjects\Transaction;
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

    public function createItem(Item $item)
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
        $jsonData = json_decode($response->raw_body, true);
        if(array_key_exists("errors", $jsonData))
        {
            $errors = new Errors($jsonData);
            return $errors;
        }
        else
        {
            $jsonData = $jsonData['items'];
            $item = new Item($jsonData);
            return $item;
        }
    }

    public function deleteItem($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('delete', 'items/' . $id);
        if ($response->code){
            return false;
        }
        else
        {
            return true;
        }
    }

    public function updateItem(Item $item, $user = null, $operation = null, $account = null, $releaseAmount = null)
    {
        $payload = '';
        $preparePayload = array(
           'id'=>$item->getId(),
           'user'=>$user,
          // 'operation'=>$operation,
           'amount'=>$item->getAmount(),
           'name'=>$item->getName(),
           'account'=>$account,
           'release_amount'=>$releaseAmount,
           'description'=>$item->getDescription(),
           'buyer_id'=>$item->getBuyerId(),
           'seller_id'=>$item->getSellerId(),
        );
        array_shift($preparePayload);
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }

        $response = $this->RestClient('patch', 'items/'.$item->getId().'?'.$payload);
//        return $response;
        $jsonData = json_decode($response->raw_body, true);
        if(array_key_exists("errors", $jsonData))
        {
            $errors = new Errors($jsonData);
            return $errors;
        }
        else
        {
            $jsonData = $jsonData['items'];
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

    public function makePayment($itemId, $accountId, $userId)
    {
        $this->checkIdNotNull($itemId);
        $this->checkIdNotNull($accountId);
        $this->checkIdNotNull($userId);
        $payload = '';
        $preparePayload = array(
            "account_id"          => $accountId,
            "user_id"        => $userId
        );
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $payload = substr($payload,0,-1);

        $response = $this->RestClient('patch', 'items/' . $itemId . '/make_payment',$payload);
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("items", $jsonRaw))
        {
            $jsonData = $jsonRaw["items"];
            $itemStatus = new Item($jsonData);
            return $itemStatus;
        }
        return null;
    }

    public function requestPayment($itemId, $sellerId)
    {
        $this->checkIdNotNull($itemId);
        $this->checkIdNotNull($sellerId);
        $payload = '';
        $preparePayload = array(
            "user_id"        => $sellerId
        );
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $payload = substr($payload,0,-1);

        $response = $this->RestClient('patch', 'items/' . $itemId . '/request_payment', $payload);
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("items", $jsonRaw))
        {
            $jsonData = $jsonRaw["items"];
            $itemStatus = new Item($jsonData);
            return $itemStatus;
        }
        return null;
    }

    public function releasePayment($itemId, $buyerId, $releaseAmount)
    {
        $this->checkIdNotNull($itemId);
        $this->checkIdNotNull($buyerId);
        $this->checkIdNotNull($releaseAmount);

        $payload = '';
        $preparePayload = array(
            "user_id"        => $buyerId,
            "release_amount" => $releaseAmount
        );

        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $payload = substr($payload,0,-1);

        $response = $this->RestClient('patch', 'items/' . $itemId . '/release_payment', $payload);
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("items", $jsonRaw))
        {
            $jsonData = $jsonRaw["items"];
            $itemStatus = new Item($jsonData);
            return $itemStatus;
        }
        return null;
    }

    public function requestRelease($itemId, $sellerId, $releaseAmount)
    {
        $this->checkIdNotNull($itemId);
        $this->checkIdNotNull($sellerId);
        $this->checkIdNotNull($releaseAmount);

        $payload = '';
        $preparePayload = array(
            "user_id"        => $sellerId,
            "release_amount" => $releaseAmount
        );

        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $payload = substr($payload,0,-1);

        $response = $this->RestClient('patch', 'items/' . $itemId . '/request_release', $payload);
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("items", $jsonRaw))
        {
            $jsonData = $jsonRaw["items"];
            $itemStatus = new Item($jsonData);
            return $itemStatus;
        }
        return null;
    }

    public function cancelItem($itemId)
    {
        $this->checkIdNotNull($itemId);
        $response = $this->RestClient('patch', 'items/' . $itemId . '/cancel');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("items", $jsonRaw))
        {
            $jsonData = $jsonRaw["items"];
            $itemStatus = new Item($jsonData);
            return $itemStatus;
        }
        return null;
    }

    public function acknowledgeWire($itemId, $buyerId)
    {
        $this->checkIdNotNull($itemId);
        $this->checkIdNotNull($buyerId);

        $payload = '';
        $preparePayload = array(
            "user_id"        => $buyerId,
        );

        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $payload = substr($payload,0,-1);

        $response = $this->RestClient('patch', 'items/' . $itemId . '/acknowledge_wire', $payload);
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("items", $jsonRaw))
        {
            $jsonData = $jsonRaw["items"];
            $itemStatus = new Item($jsonData);
            return $itemStatus;
        }
        return null;
    }

    public function acknowledgePayPal($itemId, $buyerId)
    {
        $this->checkIdNotNull($itemId);
        $this->checkIdNotNull($buyerId);

        $payload = '';
        $preparePayload = array(
            "user_id"        => $buyerId,
        );

        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $payload = substr($payload,0,-1);

        $response = $this->RestClient('patch', 'items/' . $itemId . '/acknowledge_paypal', $payload);
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("items", $jsonRaw))
        {
            $jsonData = $jsonRaw["items"];
            $itemStatus = new Item($jsonData);
            return $itemStatus;
        }
        return null;
    }

    public function revertWire($itemId, $buyerId)
    {
        $this->checkIdNotNull($itemId);
        $this->checkIdNotNull($buyerId);

        $payload = '';
        $preparePayload = array(
            "user_id"        => $buyerId,
        );

        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $payload = substr($payload,0,-1);

        $response = $this->RestClient('patch', 'items/' . $itemId . '/revert_wire', $payload);
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("items", $jsonRaw))
        {
            $jsonData = $jsonRaw["items"];
            $itemStatus = new Item($jsonData);
            return $itemStatus;
        }
        return null;
    }

    public function requestRefund( $itemId,  $buyerId,  $refundAmount,  $refundMessage)
    {
        $this->checkIdNotNull($itemId);
        $this->checkIdNotNull($buyerId);
        $this->checkIdNotNull($refundAmount);
        $this->checkIdNotNull($refundMessage);

        $payload = '';
        $preparePayload = array(
            "user_id"        => $buyerId,
            "refund_amount"  => $refundAmount,
            "refund_message" => $refundMessage
        );

        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $payload = substr($payload,0,-1);

        $response = $this->RestClient('patch', 'items/' . $itemId . '/request_refund', $payload);
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("items", $jsonRaw))
        {
            $jsonData = $jsonRaw["items"];
            $itemStatus = new Item($jsonData);
            return $itemStatus;
        }
        return null;
    }

    public function refund( $itemId,  $sellerId,  $refundAmount,  $refundMessage)
    {
        $this->checkIdNotNull($itemId);
        $this->checkIdNotNull($sellerId);
        $this->checkIdNotNull($refundAmount);
        $this->checkIdNotNull($refundMessage);

        $payload = '';
        $preparePayload = array(
            "user_id"        => $sellerId,
            "refund_amount"  => $refundAmount,
            "refund_message" => $refundMessage
        );

        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $payload = substr($payload,0,-1);

        $response = $this->RestClient('patch', 'items/' . $itemId . '/refund', $payload);
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("items", $jsonRaw))
        {
            $jsonData = $jsonRaw["items"];
            $itemStatus = new Item($jsonData);
            return $itemStatus;
        }
        return null;
    }
}

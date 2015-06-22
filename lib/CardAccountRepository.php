<?php
namespace PromisePay;

use PromisePay\DataObjects\Card;
use PromisePay\DataObjects\User;
use PromisePay\Exception;
use PromisePay\Log;

class CardAccountRepository extends ApiAbstract
{
    public function getCardAccountById($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'card_accounts/'.$id);
        $jsonData = json_decode($response->raw_body, true)['card_accounts'];
        $accounts = new Card($jsonData);
        return $accounts;
    }

    public function createCardAccount(Card $card)
    {

        $payload = '';

        $preparePayload = array(
                "id" =>$card->getId(),
                "full_name"=>$card->getFullName(),
                "number"=>$card->getNumber(),
                "expiry_month"=>$card->getExpMonth(),
                "expiry_year"=>$card->getExpYear(),
                "cvv"=>$card->getCVV(),
                "user_id"=>$card->getType(),

        );
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $response = $this->RestClient('post', 'card_accounts/', $payload);
        return $response;
    }

    public function deleteCardAccount($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('delete', 'card_accounts/'.$id);
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("errors", $jsonRaw)){
            return false;
        }
        else
        {
            return true;
        }
    }

    public function getUserForCardAccount($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get','users/'.$id.'/bank_accounts');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("users", $jsonRaw))
        {
            $jsonData = $jsonRaw["users"];
            $bankAccount = new User($jsonData);
            return $bankAccount;
        }
        return null;
    }
}
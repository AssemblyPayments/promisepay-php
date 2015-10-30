<?php
namespace PromisePay;

use PromisePay\DataObjects\Card;
use PromisePay\DataObjects\CardAccount;
use PromisePay\DataObjects\User;
use PromisePay\Exception;
use PromisePay\Log;

class CardAccountRepository extends BaseRepository
{
    public function getCardAccountById($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'card_accounts/'.$id);
        $jsonData = json_decode($response->raw_body, true);
		
		if (array_key_exists('card_accounts', $jsonData)) {
	        $accounts = new CardAccount($jsonData['card_accounts']);
	        return $accounts;
		} else {
			return null;
		}
    }

    public function createCardAccount(CardAccount $card)
    {
        $payload = '';
        $preparePayload = array(
                "user_id" =>$card->getUserId(),
                "full_name"=>$card->getCard()->getFullName(),
                "number"=>$card->getCard()->getNumber(),
                "expiry_month"=>$card->getCard()->getExpMonth(),
                "expiry_year"=>$card->getCard()->getExpYear(),
                "cvv"=>$card->getCard()->getCVV()
        );
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }

        $response = $this->RestClient('post', 'card_accounts?', $payload);
        $jsonData = json_decode($response->raw_body, true);
        return new CardAccount($jsonData['card_accounts']);
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
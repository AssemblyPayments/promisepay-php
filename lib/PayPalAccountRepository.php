<?php
namespace PromisePay;

use PromisePay\DataObjects\PayPal;
use PromisePay\DataObjects\PayPalAccount;
use PromisePay\DataObjects\User;
use PromisePay\Exception;
use PromisePay\Log;

class PayPalAccountRepository extends ApiAbstract
{
    public function getPayPalAccountById($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'paypal_accounts/'.$id);
        $jsonData = json_decode($response->raw_body, true)['paypal_accounts'];
        $accounts = new PayPalAccount($jsonData);
        return $accounts;
    }

    public function createPayPalAccount(PayPalAccount $paypal)
    {
        $payload = '';

        $preparePayload = array(
            "user_id" =>$paypal->getUserId(),
            "paypal_email"=>$paypal->getPayPal()->getPayPalAccountEmail(),

        );
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $response = $this->RestClient('post', 'paypal_accounts/', $payload);

        $jsonData = json_decode($response->raw_body, true)['paypal_accounts'];
        return new PayPalAccount($jsonData);
    }

    public function deletePayPalAccount($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('delete', 'paypal_accounts/'.$id);
        return $response;
    }

    public function getUserForPayPalAccount($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get','/paypal_accounts/'.$id.'/users');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("users", $jsonRaw))
        {
            $jsonData = $jsonRaw["users"];
            $users = new User($jsonData);
            return $users;
        }
        return null;
    }

}
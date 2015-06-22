<?php
namespace PromisePay;

use PromisePay\DataObjects\PayPal;
use PromisePay\Exception;
use PromisePay\Log;

class PayPalAccountRepository extends ApiAbstract
{
    public function getPayPalAccountById($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'paypal_accounts/'.$id);
        $jsonData = json_decode($response->raw_body, true)['card_accounts'];
        $accounts = new PayPal($jsonData);
        return $accounts;
    }

    public function createPayPalAccount(PayPal $paypal, $id)
    {
        $this->checkIdNotNull($id);
        $payload = '';

        $preparePayload = array(
            "id" =>$id,
            "paypal_email"=>$paypal->getPayPalAccountEmail(),

        );
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $response = $this->RestClient('post', 'paypal_accounts/', $payload);
        return $response;
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
        $response = $this->RestClient('get','users/'.$id.'/paypal_accounts');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("paypal_accounts", $jsonRaw))
        {
            $jsonData = $jsonRaw["paypal_accounts"];
            $bankAccount = new PayPal($jsonData);
            return $bankAccount;
        }
        return null;
    }

}
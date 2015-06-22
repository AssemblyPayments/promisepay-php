<?php
namespace PromisePay;

use PromisePay\DataObjects\Bank;
use PromisePay\DataObjects\BankAccount;
use PromisePay\Exception;
use PromisePay\Log;

class BankAccountRepository extends ApiAbstract
{
    public function getBankAccountById($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'bank_accounts/'.$id);
        $jsonData = json_decode($response->raw_body, true)['bank_accounts'];
        $accounts = new Bank($jsonData);
        return $accounts;
    }

    public function createBankAccount(Bank $bank, $id)
    {
        $this->checkIdNotNull($id);
        $payload = '';

        $preparePayload = array(
            "user_id" =>$id,
            "bank_name"=>$bank->getBankName(),
            "account_name"=>$bank->getAccountName(),
            "routing_number"=>$bank->getRoutingNumber(),
            "account_number"=>$bank->getAccountNumber(),
            "account_type"=>$bank->getAccountType(),
            "holder_type"=>$bank->getHolderType(),
            "bank_country"=>$bank->getCountry(),
        );
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $response = $this->RestClient('post', 'bank_accounts/'.$id, $payload);
        return $response;
    }

    public function deleteBankAccount($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('delete', 'bank_accounts/'.$id);
    }

    public function getUserForBankAccount($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get','users/'.$id.'/bank_accounts');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("items", $jsonRaw))
        {
            $jsonData = $jsonRaw["bank_accounts"];
            $bankAccount = new Bank($jsonData);
            return $bankAccount;
        }
        return null;
    }
}
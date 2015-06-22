<?php
namespace PromisePay;

use PromisePay\DataObjects\Bank;
use PromisePay\DataObjects\BankAccount;
use PromisePay\DataObjects\User;
use PromisePay\Exception;
use PromisePay\Log;

class BankAccountRepository extends ApiAbstract
{
    public function getBankAccountById($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'bank_accounts/'.$id);
        $jsonData = json_decode($response->raw_body, true)['bank_accounts'];
        $bankAccounts = new Bank($jsonData);
        return $bankAccounts;
    }

    public function createBankAccount(Bank $bank)
    {

        $payload = '';

        $preparePayload = array(
            "user_id" =>$bank->getId(),
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
        $response = $this->RestClient('post', 'bank_accounts/', $payload);
        return $response;
    }

    public function deleteBankAccount($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('delete', 'bank_accounts/'.$id);
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("errors", $jsonRaw)){
            return false;
        }
        else
        {
            return true;
        }
    }

    public function getUserForBankAccount($id)
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
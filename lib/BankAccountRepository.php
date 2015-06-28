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
        $bankAccounts = new BankAccount($jsonData);
        return $bankAccounts;
    }

    public function createBankAccount(BankAccount $bankAccount)
    {

        $payload = '';
        $preparePayload = array(
            "user_id" =>$bankAccount->getUserId(),
            "bank_name"=>$bankAccount->getBank()->getBankName(),
            "account_name"=>$bankAccount->getBank()->getAccountName(),
            "routing_number"=>$bankAccount->getBank()->getRoutingNumber(),
            "account_number"=>$bankAccount->getBank()->getAccountNumber(),
            "account_type"=>$bankAccount->getBank()->getAccountType(),
            "holder_type"=>$bankAccount->getBank()->getHolderType(),
            "bank_country"=>$bankAccount->getBank()->getCountry(),
        );
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $payload = substr($payload, 0, -1);
        $response = $this->RestClient('post', 'bank_accounts/', $payload);
        $jsonData = json_decode($response->raw_body, true);

        return new BankAccount($jsonData);

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
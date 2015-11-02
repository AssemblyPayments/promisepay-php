<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class BankAccountRepository extends BaseRepository
{
    public function getBankAccountById($id)
    {
        $response = $this->RestClient('get', 'bank_accounts/'.$id);
        return $this->generate_response($response);
    }

    public function createBankAccount($params)
    {
        $response = $this->RestClient('post', 'bank_accounts/', $this->generate_payload($params));
        return $this->generate_response($response);
    }

    public function deleteBankAccount($id)
    {
        $response = $this->RestClient('delete', 'bank_accounts/'.$id);
        return $this->generate_response($response);
    }

    public function getUserForBankAccount($id)
    {
        $response = $this->RestClient('get','bank_accounts/'.$id.'/users');
        return $this->generate_response($response);
    }
}
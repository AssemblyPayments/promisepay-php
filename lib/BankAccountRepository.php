<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class BankAccountRepository extends BaseRepository
{
    public function getBankAccountById($id)
    {
        $response = $this->RestClient('get', 'bank_accounts/'.$id);
        return json_decode($response->raw_body, true);
    }

    public function createBankAccount($params)
    {
        $response = $this->RestClient('post', 'bank_accounts/', $params);
        return json_decode($response->raw_body, true);
    }

    public function deleteBankAccount($id)
    {
        $response = $this->RestClient('delete', 'bank_accounts/'.$id);
        return json_decode($response->raw_body, true);
    }

    public function getUserForBankAccount($id)
    {
        $response = $this->RestClient('get','bank_accounts/'.$id.'/users');
        return json_decode($response->raw_body, true);
    }
}
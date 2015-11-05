<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class TransactionRepository extends PromisePay
{
    public function getListOfTransactions($params)
    {
        $response = $this->RestClient('get', 'transactions/', $params);
        return json_decode($response->raw_body, true);
    }

    public function getTransaction($id)
    {

        $response = $this->RestClient('get', 'transactions/' . $id);
        return json_decode($response->raw_body, true);
    }

    public function getUserForTransaction($id)
    {
        $response = $this->RestClient('get', 'transactions/' . $id . '/users');
        return json_decode($response->raw_body, true);
    }

    public function getFeeForTransaction($id)
    {
        $response = $this->RestClient('get', 'transactions/' . $id . '/fees');
        return json_decode($response->raw_body, true);
    }
}
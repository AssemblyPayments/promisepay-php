<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class TransactionRepository extends BaseRepository
{
    public function getListOfTransactions($params)
    {
        $response = $this->RestClient('get', 'transactions/', $this->generate_payload($params));
        return $this->generate_response($response);
    }

    public function getTransaction($id)
    {

        $response = $this->RestClient('get', 'transactions/' . $id);
        return $this->generate_response($response);
    }

    public function getUserForTransaction($id)
    {
        $response = $this->RestClient('get', 'transactions/' . $id . '/users');
        return $this->generate_response($response);
    }

    public function getFeeForTransaction($id)
    {
        $response = $this->RestClient('get', 'transactions/' . $id . '/fees');
        return $this->generate_response($response);
    }
}
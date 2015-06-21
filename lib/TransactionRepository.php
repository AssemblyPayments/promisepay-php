<?php
namespace PromisePay;

use PromisePay\DataObjects\Errors;
use PromisePay\DataObjects\Transaction;
use PromisePay\Exception;
use PromisePay\Log;

class TransactionRepository extends ApiAbstract
{
    public function getListOfTransactions($limit = 20, $offset = 0)
    {
        $this->paramsListCorrect($limit,$offset);
        $response = $this->RestClient('get', 'transactions?limit=' . $limit . '&offset=' . $offset, '', '');

        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("transactions", $jsonRaw))
        {
            $jsonData = $jsonRaw["transactions"];
            $allTransactions = array();
            foreach ($jsonData as $oneTransaction) {
                $transaction = new Transaction($oneTransaction);
                array_push($allTransactions, $transaction);
            }
            return $allTransactions;
        }
        else
        {
            return array();
        }

    }

    public function getTransaction($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'transactions/' . $id);
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("transactions", $jsonRaw))
        {
            $jsonData = $jsonRaw['transactions'];
            $transaction = new Transaction($jsonData);
            return $transaction;
        }
        else
        {
            return null;
        }
    }

    public function getUserForTransaction($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'transactions/' . $id . '/users');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("users", $jsonRaw))
        {
            $jsonData = $jsonRaw['users'];
            $user = new User($jsonData);
            return $user;
        }
        else
        {
            return null;
        }
    }

    public function getFeeForTransaction($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'transactions/' . $id . '/fees');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("fees", $jsonRaw))
        {
            $jsonData = $jsonRaw['fees'];
            $fee = new Fee($jsonData);
            return $fee;
        }
        else
        {
            return null;
        }
    }
}
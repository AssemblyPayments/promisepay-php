<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class CardAccountRepository extends BaseRepository
{
    public function getCardAccountById($id)
    {
        $response = $this->RestClient('get', 'card_accounts/' . $id);
        return json_decode($response->raw_body, true);
    }

    public function createCardAccount($params)
    {
        $response = $this->RestClient('post', 'card_accounts?', $params);
        return json_decode($response->raw_body, true);
    }

    public function deleteCardAccount($id)
    {
        $response = $this->RestClient('delete', 'card_accounts/' . $id);
        return json_decode($response->raw_body, true);
    }

    public function getUserForCardAccount($id)
    {
        $response = $this->RestClient('get', 'users/' . $id . '/bank_accounts');
        return json_decode($response->raw_body, true);
    }
}
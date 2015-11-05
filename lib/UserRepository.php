<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class UserRepository extends PromisePay
{
    public function getListOfUsers($params)
    {
        $response = $this->RestClient('get', 'users/', $params);
        return json_decode($response->raw_body, true);
    }

    public function getUserById($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'users/' . $id);
        return json_decode($response->raw_body, true);
    }

    public function createUser($params)
    {
        $response = $this->RestClient('post', 'users/', $params);
        return json_decode($response->raw_body, true);
    }

    public function deleteUser($id)
    {
        $response = $this->RestClient('delete', 'users/' . $id);
        return json_decode($response->raw_body, true);
    }

    public function sendMobilePin($id)
    {
        $response = $this->RestClient('post', '/users/' . $id . '/mobile_pin');
        return json_decode($response->raw_body, true);
    }

    public function getListOfItemsForUser($id)
    {
        $response = $this->RestClient('get', 'users/' . $id . '/items');
        return json_decode($response->raw_body, true);
    }

    public function getListOfCardAccountsForUser($id)
    {
        $response = $this->RestClient('get', 'users/' . $id . '/card_accounts');
        return json_decode($response->raw_body, true);
    }

    public function getListOfPayPalAccountsForUser($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'users/' . $id . '/paypal_accounts');
        return json_decode($response->raw_body, true);
    }

    public function getListOfBankAccountsForUser($id)
    {
        $response = $this->RestClient('get', 'users/' . $id . '/bank_accounts');
        return json_decode($response->raw_body, true);
    }

    public function setDisbursementAccount($id, $params)
    {
        $response = $this->RestClient('post', 'users/' . $id . '/disbursement_account', $params);
        return json_decode($response->raw_body, true);
    }

    public function updateUser($id, $params)
    {
        $response = $this->RestClient('patch', 'users/' . $id . "/", $params);
        return json_decode($response->raw_body, true);
    }
}

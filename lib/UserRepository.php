<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class UserRepository extends BaseRepository
{
    public function getListOfUsers($params)
    {
        $response = $this->RestClient('get', 'users/', $params);
        return $this->generate_response($response);
    }

    public function getUserById($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'users/' . $id);
        return $this->generate_response($response);
    }

    public function createUser($params)
    {
        $response = $this->RestClient('post', 'users/', $this->generate_payload($params));
        return $this->generate_response($response);
    }

    public function deleteUser($id)
    {
        $response = $this->RestClient('delete', 'users/' . $id);
        return $this->generate_response($response);
    }

    public function sendMobilePin($id)
    {
        $response = $this->RestClient('post', '/users/' . $id . '/mobile_pin');
        return $this->generate_response($response);
    }

    public function getListOfItemsForUser($id)
    {
        $response = $this->RestClient('get', 'users/' . $id . '/items');
        return $this->generate_response($response);
    }

    public function getListOfCardAccountsForUser($id)
    {
        $response = $this->RestClient('get', 'users/' . $id . '/card_accounts');
        return $this->generate_response($response);
    }

    public function getListOfPayPalAccountsForUser($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'users/' . $id . '/paypal_accounts');
        return $this->generate_response($response);
    }

    public function getListOfBankAccountsForUser($id)
    {
        $response = $this->RestClient('get', 'users/' . $id . '/bank_accounts');
        return $this->generate_response($response);
    }

    public function setDisbursementAccount($id, $params)
    {
        $response = $this->RestClient('post', 'users/' . $id . '/disbursement_account', $this->generate_payload($params));
        return $this->generate_response($response);
    }

    public function updateUser($id, $params)
    {
        $response = $this->RestClient('patch', 'users/' . $id . "/", $this->generate_payload($params));
        return $this->generate_response($response);
    }
}

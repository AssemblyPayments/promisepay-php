<?php
namespace PromisePay;

use Httpful\Request;
use PromisePay\Exception;
use PromisePay\Log;
include_once 'Configuration.php';

class User extends ApiAbstract
{
    public function getListOfUsers()
    {
        $url = BaseUrl() + '/users';
        $response = Request::get($url);
        return $response->body->users;
    }

    public function getUserById()
    {

    }

    public function createUser()
    {

    }

    public function deleteUser()
    {

    }

    public function sendMobilePin()
    {

    }

    public function getListOfItemsForUsers()
    {

    }

    public function getListOfPayPalAccountsForUser()
    {

    }

    public function getListOfBankAccountsForUser()
    {

    }

    public function getDisbursementAccount()
    {

    }

    public function updateUser()
    {

    }

    public function validateUser()
    {

    }

    public function isCorrectEmail()
    {

    }

    public function isCorrectCountryCode()
    {

    }

}
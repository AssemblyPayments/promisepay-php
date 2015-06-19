<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log\Logger;

class ApiAbstract
{
    public $baseUrl;
    public $login;
    public $passWord;

    const ENTITY_LIST_LIMIT = 200;

    public $credentials;

    private function _getCredentials()
    {
        $this->credentials = new Configuration();
        return $this->$credentials;
    }

    public function BaseUrl()
    {


        if($this->_getCredentials()->getApiUrl() == null)
        {
            Logger::logging('Fatal error: Api Url is empty');
            throw new Exception\Misconfiguration('Api Url is empty');
        }

        $this->baseUrl = $this->_getCredentials()->getApiUrl();
        return $this->baseUrl;
    }

    public function Login()
    {
        if($this->_getCredentials()->getUserLogin() == null)
        {
            Logger::logging('Fatal error: Api login is empty');
            throw new Exception\Misconfiguration('Api login is empty');
        }

        $this->login = $this->_getCredentials()->getUserLogin();
        return $this->login;

    }

    public function Password()
    {
        if($this->_getCredentials()->getUserPassword() == null)
        {
            Logger::logging('Fatal error: Api password is empty');
            throw new Exception\Misconfiguration('Api password is empty');
        }

        $this->passWord = $this->credentials->getUserLogin();
        return $this->passWord;
    }

    public function RestClient()
    {

    }

    public function SendRequest()
    {

    }


    public function checkIdNotNull($id)
    {
        if($id == null)
        {
            Logger::logging('Fatal error: Id is empty');
            throw new Exception\Argument('id is empty');
        }
    }

    public function paramsListCorrect($limit, $offset)
    {
        if ($limit < 0 || $offset < 0 )
        {
            Logger::logging('Fatal error:limit and offset values should be nonnegative!');
            throw new Exception\Argument('limit and offset values should be nonnegative!');
        }

        if ($limit > self::ENTITY_LIST_LIMIT)
        {
            Logger::logging('Fatal error:Max value for limit parameter!');
            throw new Exception\Argument('Max value for limit parameter');
        }
    }


}

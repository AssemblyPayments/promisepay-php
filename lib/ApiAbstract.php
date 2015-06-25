<?php

namespace PromisePay;

use PromisePay;
use Httpful\Request;
use PromisePay\Exception;
use PromisePay\Log\Logger;

class ApiAbstract
{
    public $baseUrl;
    public $login;
    public $passWord;

    const ENTITY_LIST_LIMIT = 200;

    public function _construct()
    {

    }

    public function BaseUrl()
    {
        $config = new Configuration;

        if($config->getApiUrl() == null)
        {
            Logger::logging('Fatal error: Api Url is empty');
            throw new Exception\Misconfiguration('Api Url is empty');
        }

        $this->baseUrl = $config->getApiUrl();
        return $this->baseUrl;
    }

    public function Login()
    {
        $config = new Configuration;
        if($config->getUserLogin() == null)
        {
            Logger::logging('Fatal error: Api login is empty');
            throw new Exception\Misconfiguration('Api login is empty');
        }

        $this->login = $config->getUserLogin();
        return $this->login;

    }

    public function Password()
    {
        $config = new Configuration;
        if($config->getUserPassword() == null)
        {
            Logger::logging('Fatal error: Api password is empty');
            throw new Exception\Misconfiguration('Api password is empty');
        }

        $this->passWord = $config->getUserPassword();
        return $this->passWord;
    }

    public function RestClient($method, $entity, $payload = null, $mime = null)
    {
        $username = $this->Login();
        $password = $this->Password();

        $url = $this->BaseUrl().$entity;

        switch ($method) {
            case 'get':
                $response = Request::get($url)->authenticateWith($username, $password)->send();
                return $response;
                break;

            case 'post':
                $response = Request::post($url)->body($payload, $mime)->authenticateWith($username,$password)->send();
                return $response;
                break;

            case 'delete':
                $response = Request::delete($url)->authenticateWith($username, $password)->send();
                return $response;
                break;

            case 'patch':
                $response = Request::patch($url)->body($payload, $mime)->authenticateWith($username, $password)->send();
                return $response;
                break;
        }
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

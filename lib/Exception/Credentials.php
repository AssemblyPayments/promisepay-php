<?php
namespace PromisePay\Exception;

/**
 * Class Credentials
 * @package PromisePay\Exception
 */
class Credentials extends Base
{
    public function __construct($message = null, $code = 0) 
    {
        parent::__construct($message, $code);
    }
}
<?php
namespace PromisePay\Exception;

/**
 * Class Unathorized
 * @package PromisePay\Exception
 */
class Unauthorized extends Base
{
    public function __construct($message = null, $code = 0) 
    {
        parent::__construct($message, $code);
    }
}
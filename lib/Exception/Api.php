<?php
namespace PromisePay\Exception;

/**
 * Class Api
 * @package PromisePay\Exception
 */
class Api extends Base
{
    public function __construct($message = null, $code = 0) 
    {
        parent::__construct($message, $code);
    }
}
<?php
namespace PromisePay\Exception;

/**
 * Class NotFound
 * @package PromisePay\Exception
 */
class NotFound extends Base
{
    public function __construct($message = null, $code = 0) 
    {
        parent::__construct($message, $code);
    }
}
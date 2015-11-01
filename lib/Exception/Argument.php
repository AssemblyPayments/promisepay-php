<?php
namespace PromisePay\Exception;

/**
 * Class Argument
 * @package PromisePay\Exception
 */
class Argument extends Base
{
    public function __construct($message = null, $code = 0) 
    {
        parent::__construct($message, $code);
    }
}

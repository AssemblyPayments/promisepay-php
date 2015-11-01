<?php
namespace PromisePay\Exception;

/**
 * Class Misconfiguration
 * @package PromisePay\Exception
 */
class Misconfiguration extends Base{
    public function __construct($message = null, $code = 0) 
    {
        parent::__construct($message, $code);
    }
}
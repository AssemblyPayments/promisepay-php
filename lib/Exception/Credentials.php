<?php
namespace PromisePay\Exception;

use Exception;

/**
 * Class Credentials
 * @package PromisePay\Exception
 */
class Credentials extends Exception
{
	public function __construct($message = null, $code = 0) 
	{
		parent::__construct($message, $code);
	}
}
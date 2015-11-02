<?php
namespace PromisePay\Exception;

/**
 * Class Credentials
 * @package PromisePay\Exception
 */
class Credentials extends Base {
    /**
     * Default Constructor
     *
     * @param string|null $message
     * @param int $code
     */
    public function __construct($message = null, $code = 0) {
        parent::__construct($message, $code);
    }
}
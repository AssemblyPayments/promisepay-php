<?php
namespace PromisePay\Exception;

/**
 * Class Misconfiguration
 * @package PromisePay\Exception
 */
class Misconfiguration extends Base {
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

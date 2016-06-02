<?php
namespace PromisePay\Exception;

/**
 * Class MalformedResponse
 * @package PromisePay\Exception
 */
class MalformedResponse extends Base {
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

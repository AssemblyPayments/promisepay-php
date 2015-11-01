<?php
namespace PromisePay\Exception;
use Exception;

/**
 * Class Base
 * @package PromisePay\Exception
 */
abstract class Base extends Exception {
    /**
     * Default Constructor
     *
     * @param string $message
     * @param null $httpStatus
     * @param null $httpBody
     * @param null $jsonBody
     */
    public function __construct(
        $message,
        $httpStatus = null,
        $httpBody = null,
        $jsonBody = null
    ) {
        parent::__construct($message);
        $this->httpStatus = $httpStatus;
        $this->httpBody = $httpBody;
        $this->jsonBody = $jsonBody;
    }

    /**
     * Returns HTTP status code.
     *
     * @return null
     */
    public function getHttpStatus()
    {
        return $this->httpStatus;
    }

    /**
     * Returns HTTP body.
     *
     * @return null
     */
    public function getHttpBody()
    {
        return $this->httpBody;
    }

    /**
     * Returns JSON body.
     *
     * @return null
     */
    public function getJsonBody()
    {
        return $this->jsonBody;
    }

}
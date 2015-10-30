<?php
namespace PromisePay\DataObjects;
/**
 * Class Errors
 * @package PromisePay\DataObjects
 */
class Errors extends Object
{
    /**
     * @var
     */
    private $_errors;

    public function __construct($errors = array())
    {
        $this->_errors = $errors;
    }
    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     * @param mixed $errors
     */
    public function setErrors($errors)
    {
        $this->_errors = $errors;
    }
}
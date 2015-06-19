<?php
namespace PromisePay\DataObjects;
/**
 * Class Errors
 * @package PromisePay\DataObjects
 */
class Errors
{
    /**
     * @var
     */
    public $_errors;

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
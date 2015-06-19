<?php
namespace PromisePay\DataObjects;
/**
 * Class DetailsContainer
 * @package PromisePay\DataObjects
 */
class DetailsContainer
{
    /**
     * @var
     */
    public $_id;
    /**
     * @var
     */
    public $_BPayDetails;
    /**
     * @var
     */
    public $_wireDetails;

    /**
     * @return mixed
     */
    public function getBPayDetails()
    {
        return $this->_BPayDetails;
    }

    /**
     * @param mixed $BPayDetails
     */
    public function setBPayDetails($BPayDetails)
    {
        $this->_BPayDetails = $BPayDetails;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getWireDetails()
    {
        return $this->_wireDetails;
    }

    /**
     * @param mixed $wireDetails
     */
    public function setWireDetails($wireDetails)
    {
        $this->_wireDetails = $wireDetails;
    }

}
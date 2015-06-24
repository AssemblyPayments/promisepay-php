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
    private $_id;
    /**
     * @var
     */
    private $_BPayDetails;
    /**
     * @var
     */
    private $_wireDetails;

    public function __construct($jsonData)
    {
        if(count($jsonData)) {
            $this->_id = array_key_exists('id', $jsonData) ? $jsonData['id'] : '';
            $this->_id = array_key_exists('bpay_details', $jsonData) ? $jsonData['bpay_details'] : '';
            $this->_id = array_key_exists('wire_details', $jsonData) ? $jsonData['wire_details'] : '';
        }
    }
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
<?php
namespace PromisePay\DataObjects;
/**
 * Class Object
 * @package PromisePay\DataObjects
 */
abstract class Object
{
    private $_id;
    /**
     * @var
     */
    private $_links;
    /**
     * @var
     */
    private $_createdAt;
    /**
     * @var
     */
    private $_updatedAt;

    public function __construct($jsonData = array())
    {
        if (count($jsonData)>0)
        {
            $this->_id = $jsonData['id'];
            $this->_createdAt = $jsonData['created_at'];
            $this->_updatedAt = $jsonData['updated_at'];
            $this->_links = $jsonData['links'];
        }
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->_createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->_createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getLinks()
    {
        return $this->_links;
    }

    /**
     * @param mixed $links
     */
    public function setLinks($links)
    {
        $this->_links = $links;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->_updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->_updatedAt = $updatedAt;
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

}
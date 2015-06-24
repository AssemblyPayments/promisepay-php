<?php
namespace PromisePay\DataObjects;
/**
 * Class CardAccount
 * @package PromisePay\DataObjects
 */
class CardAccount extends AccountAbstract
{
    /**
     * @var
     */
    private $_card;

    public function __construct($jsonData= array())
    {
        parent::__construct($jsonData);
    }

    /**
     * @return mixed
     */
    public function getCard()
    {
        return $this->_card;
    }

    /**
     * @param mixed $card
     */
    public function setCard($card)
    {
        $this->_card = $card;
    }


}
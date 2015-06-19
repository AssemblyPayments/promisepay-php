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
    public $_card;

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
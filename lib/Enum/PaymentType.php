<?php
namespace PromisePay\Enum;
/**
 * Class EnumPaymentType
 * @package PromisePay\Enum
 */
class EnumPaymentType
{
    /**
     * @var int
     */
    public $Escrow = 1;

    /**
     * @var int
     */
    public $Express = 2;

    /**
     * @var int
     */
    public $EscrowPartialRelease = 3;

    /**
     * @var int
     */
    public $Approve = 4;
}
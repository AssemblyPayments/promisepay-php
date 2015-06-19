<?php
namespace PromisePay\Enum;
/**
 * Class FeeType
 * @package PromisePay\Enum
 */
class FeeType
{
    /**
     * @var int
     */
    public $Fixed = 1;

    /**
     * @var int
     */
    public $Percenage = 2;

    /**
     * @var int
     */
    public $PercentageWithCap = 3;

    /**
     * @var int
     */
    public $PercentageWithMin = 4;
}
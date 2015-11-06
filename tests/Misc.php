<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class Misc extends \PHPUnit_Framework_TestCase {
    
    public function setUp() {
        PromisePay::BankAccountRepository::getBankAccountById('asdasdasd');
    }
    
}
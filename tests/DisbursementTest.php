<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class FeeTest extends \PHPUnit_Framework_TestCase {
    
    public function setUp() {
    }
    
    public function testGetDisbursements() {
        $get = PromisePay::Disbursement()->get();
        
        fwrite(STDERR, print_r($get, true));
    }
}

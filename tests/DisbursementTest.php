<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class DisbursementTest extends \PHPUnit_Framework_TestCase {
    
    public function setUp() {
    }
    
    public function testGet() {
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
        
        $get = PromisePay::Disbursement()->get();
        
        fwrite(STDERR, print_r($get, true));
    }
}

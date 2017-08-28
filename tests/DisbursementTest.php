<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class DisbursementTest extends \PHPUnit_Framework_TestCase {
    
    public function testGet() {
        $disbursements = PromisePay::Disbursement()->get();

        foreach ($disbursements as $disbursement) {
            $this->assertArrayHasKey('id', $disbursement);
        }
    }
    
}

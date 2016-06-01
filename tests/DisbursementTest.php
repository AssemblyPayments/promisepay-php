<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class DisbursementTest extends \PHPUnit_Framework_TestCase {
    
    protected $userId;
    
    public function setUp() {
        $this->userId = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
    }
    
    public function testGet() {
        $this->markTestSkipped();
        /*
        $get = PromisePay::Disbursement()->get();
        
        fwrite(STDERR, print_r($get, true));
        */
    }
    
    public function testGetById() {
        $this->markTestSkipped();
        /*
        $disbursement = PromisePay::Disbursement()->get($this->userId);
        
        fwrite(STDERR, print_r($disbursement, true));
        */
    }
}

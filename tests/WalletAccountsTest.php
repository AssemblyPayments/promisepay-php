<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class WalletAccountsTest extends \PHPUnit_Framework_TestCase {
    
    protected $userId;
    
    public function setUp() {
        $this->userId = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
    }
    
    public function testGetById() {
        $this->markTestIncomplete();
        return;
        
        $get = PromisePay::WalletAccounts()->get($this->userId);
        
        fwrite(STDERR, print_r($get, true));
    }
}
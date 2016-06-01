<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class BatchTransactionsTest extends \PHPUnit_Framework_TestCase {
    
    protected $itemTest;
    
    public function setUp() {
        require_once __DIR__ . '/ItemTest.php';
        
        $this->itemTest = new ItemTest;
        $this->itemTest->setUp();
    }
    
    public function testListTransactions() {
        $payment = $this->itemTest->makePayment();
        
        $transactions = PromisePay::BatchTransactions()->listTransactions();
        
        $this->markTestIncomplete();
    }
    
    public function testShowTransactions() {
        $this->markTestIncomplete();
    }
    
}

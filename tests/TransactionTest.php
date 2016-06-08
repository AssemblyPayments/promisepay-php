<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class TransactionTest extends \PHPUnit_Framework_TestCase {
    
    protected $transactionId;
    
    public function setUp() {
        $this->transactionId = 'b916bd3e-973e-4274-9b10-1ef1db2b855c';
    }
    
    public function testListTransactions() {
        $getList = PromisePay::Transaction()->getList();
        
        $this->assertTrue(is_array($getList));
        
        foreach ($getList as $transaction) {
            $this->assertNotNull($transaction['id']);
        }
    }
    
    public function testGetById() {
        $getTransaction = PromisePay::Transaction()->get($this->transactionId);
        
        $this->assertTrue(is_array($getTransaction));
        $this->assertEquals($this->transactionId, $getTransaction['id']);
    }
    
    public function testGetUserRelatedToTransaction() {
        $getUser = PromisePay::Transaction()->getUser($this->transactionId);
        
        $this->assertTrue(is_array($getUser));
    }
    
    protected function makePaymentWithFees() {
        require_once __DIR__ . '/ItemTest.php';
        
        $itemTest = new ItemTest;
        
        $itemTest->setUp();
        
        $itemTest->itemData['payment_type'] = 4;
        
        return $itemTest->makePayment();
    }
    
    public function testGetFees() {
        extract($this->makePaymentWithFees());
        
        $itemTransactions = PromisePay::Item()->getListOfTransactions(
            $item['id']
        );
        
        $feeTransactionId = null;
        
        foreach ($itemTransactions as $transaction) {
            if ($transaction['type'] != 'fee') continue;
            
            $feeTransactionId = $transaction['id'];
            
            break;
        }
        
        $getFee = PromisePay::Transaction()->getFee($feeTransactionId);
        
        $this->assertTrue(is_array($getFee));
        $this->assertEquals($getFee['fee_list']['amount'], $fee['amount']);
        $this->assertEquals($getFee['fee_list']['name'], $fee['name']);
    }
    
}
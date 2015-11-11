<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class TransactionTest extends \PHPUnit_Framework_TestCase {
    
    protected $transactionId;
    
    public function setUp() {
        $this->transactionId = 'b916bd3e-973e-4274-9b10-1ef1db2b855c';
    }
    
    public function testGetListOfTransactions() {
        $getList = PromisePay::Transaction()->getList();
        
        $this->assertTrue(is_array($getList));
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
    
    public function testGetFee() {
        $getFee = PromisePay::Transaction()->getFee($this->transactionId);
        
        $this->assertTrue(is_array($getFee));
    }
    
}
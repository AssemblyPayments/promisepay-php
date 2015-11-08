<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class TransactionTest extends \PHPUnit_Framework_TestCase {
    
    public function setUp() {
        
    }
    
    public function testGetListOfTransactions() {
        $getList = PromisePay::Transaction()->getList();
        
        //var_dump($getList);
    }
    
    public function testGetById() {
        //$getTransaction = PromisePay::Transaction()->get('64e163b2-69db-40eb-9df4-94c1ce8abb71');
        
        /*
        var_dump($getTransaction);
        
        Exception thrown regarding unauthorized data access: O:8:"stdClass":1:{s:14:"not_authorized";a:1:{i:0;s:21:"to access that record";}}
        */
    }
    
    public function testGetUser() {
        // which ID to use?
    }
    
    public function testGetFee() {
        // which ID to use?
    }
    
}
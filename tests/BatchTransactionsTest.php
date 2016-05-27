<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class BatchTransactionsTest extends \PHPUnit_Framework_TestCase {
    
    public function testListTransactions() {
        $transactions = PromisePay::BatchTransactions()->listTransactions();
        
        var_dump($transactions);
    }
    
}

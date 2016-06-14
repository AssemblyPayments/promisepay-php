<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class BatchTransactions extends \PHPUnit_Framework_TestCase {
    
    private static $transaction;
    
    public function testListTransactions() {
        $batches = PromisePay::BatchTransactions()->listTransactions();
        
        $this->assertNotNull($batches);
        $this->assertTrue(is_array($batches));
    }
    
    public function testListTransactionsWithLimitFilter() {
        $batches = PromisePay::BatchTransactions()->listTransactions(
            array
            (
                'limit' => 5
            )
        );
        
        $this->assertNotNull($batches);
        $this->assertTrue(is_array($batches));
        $this->assertEquals(count($batches), 5);
        
        self::$transaction = $batches[0];
    }
    
    public function testListTransactionsIterateAllResults() {
        $limit = 200;
        $offset = 0;
        
        $batchIds = $meta = null;
        
        do {
            $batches = PromisePay::BatchTransactions()->listTransactions(
                array
                (
                    'limit' => $limit,
                    'offset' => $offset
                )
            );
            
            if ($meta === null) {
                $meta = PromisePay::getMeta();
            }
            
            foreach ($batches as $batch) {
                $batchIds[] = $batch['id'];
            }
            
            $offset += $limit;
        } while ($meta['total'] > $offset);
        
        $this->assertNotNull($batches);
        $this->assertNotNull($meta);
        
        $this->assertTrue(is_array($batches));
        $this->assertTrue(is_array($meta));
        $this->assertTrue(is_numeric($meta['total']));
        
        $this->assertEquals(
            $meta['total'],
            count(array_unique($batchIds))
        );
    }
    
    public function testShowTransaction() {
        $batch = PromisePay::BatchTransactions()->showTransaction(
            self::$transaction['id']
        );
        
        $this->assertNotNull($batch);
        $this->assertTrue(is_array($batch));
        $this->assertEquals($batch['id'], self::$transaction['id']);
    }
    
    private function readmeExamples() {
        // List Batch Transactions
        $batches = PromisePay::BatchTransactions()->listTransactions();
        
        // Show Batch Transaction
        $batch = PromisePay::BatchTransactions()->showTransaction(
            'BATCH_TRANSACTION_ID'
        );
    }
    
}
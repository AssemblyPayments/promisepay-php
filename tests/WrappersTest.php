<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class WrappersTest extends \PHPUnit_Framework_TestCase {
    
    protected $feesListFn, $batchTransactionsFunction;
    
    protected function setUp() {
        $this->feesListFn = function($limit, $offset) {
            return PromisePay::Fee()->getList(
                array(
                    'limit' => $limit,
                    'offset' => $offset
                )
            );
        };
        
        $this->batchTransactionsFunction = function($limit, $offset) {
            PromisePay::BatchTransactions()->listTransactions(
                array(
                    'limit' => $limit,
                    'offset' => $offset
                )
            );
        };
    }
    
    /**
     * @group wrapper-sync-fees
     */
    public function testGetAllResultsForFeesSynchronous() {
        $feesList = PromisePay::getAllResults($this->feesListFn);
        
        $this->assertFeeData($feesList);
    }
    
    protected function assertFeeData(array $feesList) {
        foreach ($feesList as $fee) {
            $this->assertNotNull($fee['id']);
            $this->assertArrayHasKey('fee_type_id', $fee);
            $this->assertArrayHasKey('amount', $fee);
            $this->assertArrayHasKey('cap', $fee);
            $this->assertArrayHasKey('min', $fee);
            $this->assertArrayHasKey('max', $fee);
            $this->assertArrayHasKey('to', $fee);
        }
    }
    
    /**
     * @group wrapper-sync-batch-transactions
     */
    public function testGetAllResultsForBatchedTransactionsSynchronous() {
        $batchedTransactionsList = PromisePay::getAllResults($this->batchTransactionsFunction);
        
        $this->assertBatchedTransactionsData($batchedTransactionsList);
    }
    
    /**
     * @group wrapper-async-batch-transactions
     */
    public function testGetAllResultsForBatchedTransactionsAsynchronous() {
        $batchedTransactionsList = PromisePay::getAllResultsAsync($this->batchTransactionsFunction);
        
        $this->assertBatchedTransactionsData($batchedTransactionsList);
    }
    
    protected function assertBatchedTransactionsData(array $batchedTransactionsList) {
        foreach ($batchedTransactionsList as $batchedTransaction) {
            $this->assertNotNull($batchedTransaction['id']);
            $this->assertArrayHasKey('batch_id', $batchedTransaction);
            $this->assertArrayHasKey('user_id', $batchedTransaction);
            $this->assertArrayHasKey('account_id', $batchedTransaction);
            $this->assertArrayHasKey('account_type', $batchedTransaction);
            $this->assertArrayHasKey('amount', $batchedTransaction);
            $this->assertArrayHasKey('currency', $batchedTransaction);
            $this->assertArrayHasKey('debit_credit', $batchedTransaction);
            $this->assertArrayHasKey('description', $batchedTransaction);
            
            $this->assertTrue(
                $batchedTransaction['debit_credit'] == 'credit'
                ||
                $batchedTransaction['debit_credit'] == 'debit'
            );
            
            $this->assertTrue(
                $batchedTransaction['state'] == 'successful'
                ||
                $batchedTransaction['state'] == 'batched'
            );
        }
        
        // TODO for 2.3.2
        //$this->assertEquals(count($batchedTransactionsList), PromisePay::$allResultsCount);
    }
    
    private function readmeExamples() {
        $batchedTransactionsList = PromisePay::getAllResults(function($limit, $offset) {
            PromisePay::BatchTransactions()->listTransactions(
                array(
                    'limit' => $limit,
                    'offset' => $offset
                )
            );
        });
        
        $batchedTransactionsList = PromisePay::getAllResultsAsync(function($limit, $offset) {
            PromisePay::BatchTransactions()->listTransactions(
                array(
                    'limit' => $limit,
                    'offset' => $offset
                )
            );
        });
    }
    
}
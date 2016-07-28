<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class WrappersTest extends \PHPUnit_Framework_TestCase {
    
    protected $userId = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
    
    protected $cardTokenData = array(
        'token_type' => 'card',
        'user_id' => null
    );
    
    protected $transactionId = 'b916bd3e-973e-4274-9b10-1ef1db2b855c';
    
    protected function setUp() {
        $this->cardTokenData['user_id'] = $this->userId;
    }
    
    public function testGetAllResultsForFees() {
        $feesList = PromisePay::getAllResults(function($limit, $offset) {
            return PromisePay::Fee()->getList(
                array(
                    'limit' => $limit,
                    'offset' => $offset
                )
            );
        });
        
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
     * @group async
     */
    public function testAsyncRequests() {
        // card tokens
        $cardTokenData = $this->cardTokenData;
        
        $cardToken = function() use ($cardTokenData) {
            PromisePay::Token()->generateCardToken($cardTokenData);
        };
        
        $cardTokenAgain = clone $cardToken;
        
        // transactions
        $transactionId = $this->transactionId;
        
        $transaction = function() use ($transactionId) {
            PromisePay::Transaction()->get($transactionId);
        };
        
        $transactionAgain = clone $transaction;
        
        // user related to transaction
        $transactionUser = function() use ($transactionId) {
            PromisePay::Transaction()->getUser($transactionId);
        };
        
        PromisePay::AsyncClient(
            $cardToken,
            $cardTokenAgain
        )->done($res1);
        
        var_dump($res1);
    }
    
    public function testGetAllResultsForItems() {
        
    }
    
}
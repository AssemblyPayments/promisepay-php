<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class AsyncTest extends \PHPUnit_Framework_TestCase {
    
    protected $userId = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
    
    protected $cardTokenData = array(
        'token_type' => 'card',
        'user_id' => null
    );
    
    protected $transactionId = 'b916bd3e-973e-4274-9b10-1ef1db2b855c';
    
    protected function setUp() {
        $this->cardTokenData['user_id'] = $this->userId;
    }
    
    public function testAsyncRequests() {
        $cardTokenData = $this->cardTokenData;
        $transactionId = $this->transactionId;
        
        PromisePay::AsyncClient(
            function() use ($cardTokenData) {
                PromisePay::Token()->generateCardToken($cardTokenData);
            },
            function() use ($transactionId) {
                PromisePay::Transaction()->get($transactionId);
            },
            function() use ($transactionId) {
                PromisePay::Transaction()->getUser($transactionId);
            },
            function() {
                PromisePay::BatchTransactions()->listTransactions(
                    array(
                        'limit' => 5
                    )
                );
            }
        )->done(
            $cardToken,
            $transaction,
            $transactionUser,
            $batchTransactions
        );
        
        // card token tests - Array Style
        $this->assertEquals($cardToken['token_type'], $cardTokenData['token_type']);
        $this->assertEquals($cardToken['user_id'], $this->userId);
        
        // card token tests - OOP Style
        $this->assertEquals($cardToken->getJson('token_type'), $cardTokenData['token_type']);
        $this->assertEquals($cardToken->getJson('user_id'), $this->userId);
        
        // transaction tests - Array Style
        $this->assertEquals($transaction['id'], $transactionId);
        
        // transaction tests - OOP Style
        $this->assertTrue(is_array($transaction->getJson()));
        $this->assertEquals($transaction->getJson('id'), $transactionId);
        
        // transaction user tests
        $this->assertTrue(is_array($transactionUser->getJson()));
        
        // list batched transactions tests - Array Style
        $this->assertNotNull($batchTransactions[0]);
        $this->assertTrue(is_array($batchTransactions[0]));
        
        // list batched transactions tests - OOP Style
        $this->assertNotNull($batchTransactions->getJson());
        $this->assertTrue(is_array($batchTransactions->getJson()));
        $this->assertEquals(count($batchTransactions->getJson()), 5);
        
        // iterate over batch transactions
        foreach($batchTransactions as $batchTransaction) {
            $this->assertNotNull($batchTransaction['id']);
        }
    }
    
    /**
     @group errors-handling
     */
    public function testAsyncRequestsWithErrors() {
        PromisePay::AsyncClient(
            function () {
                // try a fetch a fee using ID that doesn't exist
                PromisePay::Fee()->get(GUID());
            }
        )->done($response);
    }
    
}
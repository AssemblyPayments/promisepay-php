<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class AsyncTest extends \PHPUnit_Framework_TestCase {
    
    protected $addressId = '07ed45e5-bb9d-459f-bb7b-a02ecb38f443';
    protected $buyerId = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
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
    
    public function testAsyncRequestsAlternateSyntax() {
        $this->markTestSkipped();
        
        $transactionsList = function() {
            return PromisePay::Transaction()->getList(
                array(
                    'limit' => 2,
                    'transaction_type' => 'refund'
                )
            );
        };
        
        $addressId = $this->addressId;
        
        $address = function() use ($addressId) {
            return PromisePay::Address()->get($addressId);
        };
        
        $buyerId = $this->buyerId;
        
        $walletAccounts = function() use ($buyerId) {
            return PromisePay::User()->getListOfWalletAccounts($buyerId);
        };
        
        $results = PromisePay::asyncRequests(
            $transactionsList,
            $address,
            $walletAccounts
        );
        
        // transactions tests
        $this->assertNotNull($results['transactions']);
        $this->assertTrue(is_array($results['transactions']));
        $this->assertNotNull($results['transactions'][0]['id']);
        $this->assertEquals($results['transactions'][0]['type'], 'refund');
        
        // address tests
        $this->assertNotNull($results['addresses']);
        $this->assertTrue(is_array($results['addresses']));
        $this->assertEquals($results['addresses']['id'], $addressId);
        
        // wallet accounts tests
        $this->assertNotNull($results['wallet_accounts']);
        $this->assertTrue(is_array($results['wallet_accounts']));
        $this->assertContains($buyerId, $results['wallet_accounts']['links']['self']);
    }
    
}
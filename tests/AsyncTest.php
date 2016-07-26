<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class AsyncTest extends \PHPUnit_Framework_TestCase {
    
    protected $addressId = '07ed45e5-bb9d-459f-bb7b-a02ecb38f443';
    
    protected $buyerId = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
    
    public function testAsyncRequests() {
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
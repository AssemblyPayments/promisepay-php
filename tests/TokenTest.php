<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class TokenTest extends \PHPUnit_Framework_TestCase {
    
    protected $tokenData, $userId;
    
    public function setUp() {
        $this->userId = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
        
        $this->sessionTokenData = array(
            'current_user'           => 'seller',
            'item_name'              => 'Test Item',
            'amount'                 => '2500',
            'seller_lastname'        => 'Seller',
            'seller_firstname'       => 'Sally',
            'buyer_lastname'         => 'Buyer',
            'buyer_firstname'        => 'Bobby',
            'buyer_country'          => 'AUS',
            'seller_country'         => 'USA',
            'seller_email'           => 'sally.seller@promisepay.com',
            'buyer_email'            => 'bobby.buyer@promisepay.com',
            'fee_ids'                => '',
            'payment_type_id'        => '2'
        );
    }
    
    public function testGenerateCardToken() {
        $tokenType = 'card';
        
        $cardToken = PromisePay::Token()->generateCardToken(
            array
            (
                'token_type' => $tokenType,
                'user_id' => $this->userId
            )
        );
        
        $this->assertEquals($cardToken['token_type'], $tokenType);
        $this->assertEquals($cardToken['user_id'], $this->userId);
    }
    
    /**
     * @group failing
     */
    public function testRequestSessionToken() {
        $requestSessionToken = PromisePay::Token()->requestSessionToken(
            $this->sessionTokenData
        );
        
        $this->assertNotNull($requestSessionToken['token_type']);
        $this->assertNotNull($requestSessionToken['token']);
        $this->assertNotNull($requestSessionToken['item']);
        $this->assertNotNull($requestSessionToken['buyer']);
        $this->assertNotNull($requestSessionToken['seller']);
    }
    
    private function readmeExamples() {
        $cardToken = PromisePay::Token()->generateCardToken(
            array
            (
                'token_type' => 'card',
                'user_id' => 'USER_ID'
            )
        );
    }
    
}
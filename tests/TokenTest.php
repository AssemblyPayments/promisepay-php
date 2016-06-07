<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class TokenTest extends \PHPUnit_Framework_TestCase {
    
    protected $tokenData, $userId;
    
    public function setUp() {
        $this->userId = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
        
        $this->tokenData = array(
            'current_user_id'    => $this->userId,
            'item_name'          => 'bear',
            'amount'             => '$100',
            'external_item_id'   => 'b3b4d024-a6de-4b04-9f8d-6545eef3b28f',
            'payment_type_id'    => 'fdf58725-96bd-4bf8-b5e6-9b61be20662e',
            'fee_ids'            => '',
            'seller_email'       => 'ccc@ddd.com',
            'seller_firstname'   => 'test seller 1name',
            'seller_lastname'    => 'test seller lname',
            'seller_country'     => 'AUS',
            'external_seller_id' => 'ec9bf096-c505-4bef-87f6-18822b9dbf2c',
            'buyer_email'        => 'cccaaaa@ddd.com',
            'buyer_firstname'    => 'b fname',
            'buyer_lastname'     => 'b lname',
            'buyer_country'      => 'AUS',
            'external_buyer_id'  => 'fdf58725-96bd-4bf8-b5e6-9b61be20662e',
        );
    }
    
    public function testGenerateCardToken() {
        $tokenType = 'card';
        
        $params = array(
            'token_type' => $tokenType,
            'user_id' => $this->userId
        );
        
        $cardToken = PromisePay::Token()->generateCardToken($params);
        
        $this->assertEquals($cardToken['token_type'], $tokenType);
        $this->assertEquals($cardToken['user_id'], $this->userId);
    }
    
    /**
     * @expectedException \PromisePay\Exception\Unauthorized
     */
    public function testRequestToken() {
        PromisePay::Token()->requestToken();
    }
    
    /**
     * @group failing
     */
    public function testRequestSessionToken() {
        $this->markTestSkipped();
        $requestSessionToken = PromisePay::Token()->requestSessionToken($this->tokenData);
    }
    
}
<?php
namespace PromisePay;
use PromisePay\DataObjects\Token;

class TokenTest extends \PHPUnit_Framework_TestCase {
	
	public function setUp() {
		require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'init.php');
	}
	
    public function testRequestSessionToken() {
        $data = array(
            'current_user_id'    => 'ec9bf096-c505-4bef-87f6-18822b9dbf2c',
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
        
        $token = new Token($data);
        $repo = new TokenRepository();
        
		$this->assertTrue(is_array($repo->requestSessionToken($token)));
    }

    public function testGetWidget() {
        $repo = new TokenRepository();
		$getWidget = $repo->getWidget('aaa-bbb-cc');
		
        $this->assertTrue($getWidget instanceof Widget || $getWidget === null);
    }
	
}
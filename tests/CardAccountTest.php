<?php
namespace PromisePay;

use PromisePay\DataObjects\CardAccount;

class CardAccountTest extends \PHPUnit_Framework_TestCase {
	
	public function setUp() {
		require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'init.php');
	}
	
    public function testCreateCardAccountTest() {
       $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
	   
       $info = array(
           'user_id' => $userid,
           'card'    => array(
               'full_name'    => 'Bobby Buyer',
               'number'       => '4111111111111111',
               "expiry_month" => '06',
               "expiry_year"  => '2020',
               "cvv"          => '123'
               )
           );
	   
       $cardRepo = new CardAccountRepository();
       $cardAccount = new CardAccount($info);
       $createdAccount = $cardRepo->createCardAccount($cardAccount);
       
       $this->assertNotNull($createdAccount->getCreatedAt());
       $this->assertNotNull($createdAccount->getId());
    }

    public function testGetCardAccountById() {
       $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
	   
       $info = array(
           'user_id' => $userid,
           'card'    => array(
               'full_name'    => 'Bobby Buyer',
               'number'       => '4111111111111111',
               "expiry_month" => '06',
               "expiry_year"  => '2020',
               "cvv"          => '123'
               )
           );
       
       $cardRepo = new CardAccountRepository();
       $cardAccount = new CardAccount($info);
       $createdAccount = $cardRepo->createCardAccount($cardAccount);
       
       $this->assertNotNull($createdAccount->getCreatedAt());
       $this->assertNotNull($createdAccount->getId());

       $info = array(
           'id' => $createdAccount->getId()
       );

       $cardAccount = new CardAccount($info);
       $fetchedCardAccount = $cardRepo->getCardAccountById($cardAccount->getId());

       $this->assertNotNull($fetchedCardAccount->getCreatedAt());
    }

    public function testDeleteCardAccount() {
       $cardAccount = new CardAccountRepository();
       $this->assertNotNull($cardAccount->deleteCardAccount('ec9bf096-c505-4bef-87f6-18822b9dbf2c'));
       
	   $cardAccountResult = $cardAccount->getCardAccountById('ec9bf096-c505-4bef-87f6-18822b9dbf2c');
	   
	   if (!(is_null($cardAccountResult) xor $cardAccountResult instanceof CardAccounts)) {
		   $this->fail("Returned value must either be an instance of CardAccounts, or null, but it was: " . gettype($cardAccountResult));
	   }
    }

}
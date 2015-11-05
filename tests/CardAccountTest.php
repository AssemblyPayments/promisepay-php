<?php
namespace PromisePay\Tests;
use Promisepay\PromisePay;

class CardAccountTest extends \PHPUnit_Framework_TestCase {
    
    protected $userId, $bankAccountInfo;
    
    public function setUp() {
        $this->userId = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
        
        $this->cardAccountInfo = array(
           'user_id' => $this->userId,
           'full_name'    => 'Bobby Buyer',
           'number'       => '4111111111111111',
           "expiry_month" => '06',
           "expiry_year"  => '2020',
           "cvv"          => '123'
        );
    }
    
    public function testCreateCardAccountTest() {
       $createAccount = PromisePay::createCardAccount($this->cardAccountInfo);
       
       $this->assertNotNull($createAccount['created_at']);
       $this->assertNotNull($createAccount['id']);
    }

    public function testGetCardAccountById() {
       $createAccount = PromisePay::createCardAccount($this->cardAccountInfo);
       
       $this->assertNotNull($createAccount['created_at']);
       $this->assertNotNull($createAccount['id']);
       
       $fetchCardAccount = PromisePay::getCardAccountById($createAccount['id']);

       $this->assertNotNull($fetchCardAccount['created_at']);
    }

    public function testDeleteCardAccount() {
       $createAccount = PromisePay::createCardAccount($this->cardAccountInfo);
       
       $this->assertNotNull($createAccount['id']);
       
       $cardAccountId = $createAccount['id'];
       $deleteCardAccount = PromisePay::deleteCardAccount($cardAccountId);
       
       $this->assertEquals($deleteCardAccount, 'Successfully redacted');
    }

}
<?php
namespace PromisePay\Tests;
use Promisepay\PromisePay;

class CardAccountTest extends \PHPUnit_Framework_TestCase {
    
    protected $userId, $bankAccountInfo;
    
    public function setUp() {
        $this->userId = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
        
        $this->cardAccountInfo = array(
           'user_id'      => $this->userId,
           'full_name'    => 'Bobby Buyer',
           'number'       => '4111111111111111',
           "expiry_month" => '06',
           "expiry_year"  => '2020',
           "cvv"          => '123'
        );
    }
    
    public function testCreateCardAccountTest() {
       $createAccount = PromisePay::CardAccount()->create($this->cardAccountInfo);
       
       $this->assertNotNull($createAccount['created_at']);
       $this->assertNotNull($createAccount['id']);
    }

    public function testGetCardAccountById() {
       $createAccount = PromisePay::CardAccount()->create($this->cardAccountInfo);
       
       $this->assertNotNull($createAccount['created_at']);
       $this->assertNotNull($createAccount['id']);
       
       $fetchCardAccount = PromisePay::CardAccount()->get($createAccount['id']);

       $this->assertNotNull($fetchCardAccount['created_at']);
    }

    public function testDeleteCardAccount() {
       $createAccount = PromisePay::CardAccount()->create($this->cardAccountInfo);
       
       $this->assertNotNull($createAccount['id']);
       
       $cardAccountId = $createAccount['id'];
       $deleteCardAccount = PromisePay::CardAccount()->delete($cardAccountId);
       
       $this->assertEquals($deleteCardAccount, 'Successfully redacted');
    }
    
    public function testListBankAccountsForUser() {
        $createAccount = PromisePay::CardAccount()->create($this->cardAccountInfo);
        
        $getList = PromisePay::CardAccount()->getUser($this->userId);
        
        var_dump($getList);
    }

}
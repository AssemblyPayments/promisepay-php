<?php
namespace PromisePay\Tests;
use Promisepay\PromisePay;

class CardAccountTest extends \PHPUnit_Framework_TestCase {
    
    protected $GUID, $userId, $cardAccountData, $userData;
    
    public function setUp() {
        $this->GUID = GUID();
        $this->userId = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
        
        $this->cardAccountData = array(
           'user_id'      => $this->userId,
           'full_name'    => 'Bobby Buyer',
           'number'       => '4111111111111111',
           "expiry_month" => '06',
           "expiry_year"  => '2020',
           "cvv"          => '123'
        );
        
        $this->userData = array(
            'id'            => $this->GUID,
            'first_name'    => 'Bobby',
            'last_name'     => 'Buyer',
            'email'         => $this->GUID . '@google.com',
            'mobile'        => $this->GUID . '00012',
            'address_line1' => 'a_line1',
            'address_line2' => 'a_line2',
            'state'         => 'state',
            'city'          => 'city',
            'zip'           => '90210',
            'country'       => 'AUS'
        );
    }
    
    public function testCreateCardAccountTest() {
       $createAccount = PromisePay::CardAccount()->create($this->cardAccountData);
       
       $this->assertNotNull($createAccount['created_at']);
       $this->assertNotNull($createAccount['id']);
    }
    
    public function testGetCardAccountById() {
       $createAccount = PromisePay::CardAccount()->create($this->cardAccountData);
       
       $this->assertNotNull($createAccount['created_at']);
       $this->assertNotNull($createAccount['id']);
       
       $fetchCardAccount = PromisePay::CardAccount()->get($createAccount['id']);

       $this->assertNotNull($fetchCardAccount['created_at']);
    }
    
    public function testDeleteCardAccount() {
       $createAccount = PromisePay::CardAccount()->create($this->cardAccountData);
       
       $this->assertNotNull($createAccount['id']);
       
       $cardAccountId = $createAccount['id'];
       $deleteCardAccount = PromisePay::CardAccount()->delete($cardAccountId);
       
       $this->assertEquals($deleteCardAccount, 'Successfully redacted');
    }
    
    public function testListCardAccountsForUser() {
        // First, create the user
        $createUser = PromisePay::User()->create($this->userData);
        
        // Update the cardAccountData
        $this->cardAccountData['user_id'] = $createUser['id'];
        
        // Create the Card Account
        $createAccount = PromisePay::CardAccount()->create($this->cardAccountData);
        
        $getList = PromisePay::CardAccount()->getUser($createAccount['id']);
        
        $this->assertEquals($this->cardAccountData['full_name'], $getList['full_name']);
    }
    
    public function testGetTransactions() {
        $createAccount = PromisePay::CardAccount()->create($this->cardAccountData);
        
        $accountId = $createAccount['id'];
        
        $getTransactions = PromisePay::CardAccount()->getTransactions($accountId);
        
        /*
        There was 1 error:

        1) PromisePay\Tests\CardAccountTest::testGetTransactions
        PromisePay\Exception\NotFound:
        
        /var/www/promisepay-php/lib/PromisePay.php:92
        /var/www/promisepay-php/lib/CardAccountRepository.php:38
        /var/www/promisepay-php/tests/CardAccountTest.php:86
        */
        
        fwrite(STDERR, print_r($getTransactions, true));
    }

}

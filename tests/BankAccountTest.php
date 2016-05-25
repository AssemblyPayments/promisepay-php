<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class BankAccountTest extends \PHPUnit_Framework_TestCase {
    
    protected $userId, $bankAccountData;
    
    public function setUp() {
        $this->userId = '5830def0-ffe8-11e5-86aa-5e5517507c66';
        
        $this->bankAccountData = array(
            "user_id"         => $this->userId,
            "bank_name"       => 'Bank of Australia',
            "account_name"    => 'Samuel Seller',
            "routing_number"  => '123123',
            "account_number"  => '12341234',
            "account_type"    => 'checking',
            "holder_type"     => 'personal',
            "country"         => 'AUS',
            "payout_currency" => 'AUD'
        );
    }
    
    public function testCreateBankAccount() {
        $createBankAccount = PromisePay::BankAccount()->create($this->bankAccountData);
        
        $this->assertEquals($this->bankAccountData['account_name'], $createBankAccount['bank']['account_name']);
        $this->assertNotNull($createBankAccount['created_at']);
        $this->assertNotNull($createBankAccount['updated_at']);
    }

    public function testGetBankAccount() {
        $createBankAccount = PromisePay::BankAccount()->create($this->bankAccountData);
        $createBankAccountId = $createBankAccount['id'];
        
        $this->assertNotNull($createBankAccountId);
        
        $bankAccountLookup = PromisePay::BankAccount()->get($createBankAccountId);
        
        $this->assertEquals($createBankAccountId, $bankAccountLookup['id']);
    }

    public function testGetUserForBankAccount() {
        $createBankAccount = PromisePay::BankAccount()->create($this->bankAccountData);
        $getUser = PromisePay::BankAccount()->getUser($createBankAccount['id']);
        
        $this->assertEquals($this->userId, $getUser['id']);
    }

    public function testDeleteBankAccount() {
        $createBankAccount = PromisePay::BankAccount()->create($this->bankAccountData);
        $bankAccountId = $createBankAccount['id'];
        
        $deleteBankAccount = PromisePay::BankAccount()->delete($bankAccountId);
        
        $this->assertEquals($deleteBankAccount, 'Successfully redacted');
    }
    
    public function testGetTransactions() {
        $createBankAccount = PromisePay::BankAccount()->create($this->bankAccountData);
        $bankAccountId = $createBankAccount['id'];
        
        $this->markTestSkipped();
        return;
        
        /*
        There was 1 error:

        1) PromisePay\Tests\BankAccountTest::testGetTransactions
        PromisePay\Exception\NotFound:
        
        /var/www/promisepay-php/lib/PromisePay.php:92
        /var/www/promisepay-php/lib/BankAccountRepository.php:38
        /var/www/promisepay-php/tests/BankAccountTest.php:64
        */
        
        $getTransactions = PromisePay::BankAccount()->getTransactions($bankAccountId);
        
        fwrite(STDERR, print_r($getTransactions, true));
    }
    
}
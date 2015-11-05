<?php
namespace PromisePay\Tests;
use PromisePay\BankAccountRepository;

class BankAccountTest extends \PHPUnit_Framework_TestCase {
    
    protected $userId, $bankAccountInfo;
    
    public function setUp() {
        $this->userId = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
        $this->bankAccountInfo = array(
            "user_id"        => $this->userId,
            "active"         => 'true',
            "bank_name"      => 'bank for test',
            "account_name"   => 'test acc',
            "routing_number" => '12344455512',
            "account_number" => '123334242134',
            "account_type"   => 'savings',
            "holder_type"    => 'personal',
            "country"        => 'USA',
        );
    }
    
    public function testCreateBankAccount() {
        $createdBankAccount = BankAccountRepository::createBankAccount($this->bankAccountInfo);
        
        $this->assertEquals($this->bankAccountInfo['account_name'], $createdBankAccount['bank']['account_name']);
        $this->assertNotNull($createdBankAccount['created_at']);
        $this->assertNotNull($createdBankAccount['updated_at']);
    }

    public function testGetBankAccount() {
        $createdBankAccount = BankAccountRepository::createBankAccount($this->bankAccountInfo);
        $createdBankAccountId = $createdBankAccount['id'];
        
        $bankAccountLookup = BankAccountRepository::getBankAccountById($createdBankAccountId);
        
        $this->assertEquals($createdBankAccountId, $bankAccountLookup['id']);
    }

    public function testGetUserForBankAccount() {
        $bankAccountCreated = BankAccountRepository::createBankAccount($this->bankAccountInfo);
        $gotUser = BankAccountRepository::getUserForBankAccount($bankAccountCreated['id']);
        
        $this->assertEquals($this->userId, $gotUser['id']);
    }

    public function testDeleteBankAccount() {
        $createBankAccount = BankAccountRepository::createBankAccount($this->bankAccountInfo);
        $bankAccountId = $createBankAccount['id'];
        
        $deleteBankAccount = BankAccountRepository::deleteBankAccount($bankAccountId);
        
        $this->assertEquals($deleteBankAccount, 'Successfully redacted');
    }
    
}
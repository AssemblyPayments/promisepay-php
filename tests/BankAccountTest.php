<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

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
        $createdBankAccount = PromisePay::createBankAccount($this->bankAccountInfo);
        
        $this->assertEquals($this->bankAccountInfo['account_name'], $createdBankAccount['bank']['account_name']);
        $this->assertNotNull($createdBankAccount['created_at']);
        $this->assertNotNull($createdBankAccount['updated_at']);
    }

    public function testGetBankAccount() {
        $createdBankAccount = PromisePay::createBankAccount($this->bankAccountInfo);
        $createdBankAccountId = $createdBankAccount['id'];
        
        $bankAccountLookup = PromisePay::getBankAccountById($createdBankAccountId);
        
        $this->assertEquals($createdBankAccountId, $bankAccountLookup['id']);
    }

    public function testGetUserForBankAccount() {
        $bankAccountCreated = PromisePay::createBankAccount($this->bankAccountInfo);
        $gotUser = PromisePay::getUserForBankAccount($bankAccountCreated['id']);
        
        $this->assertEquals($this->userId, $gotUser['id']);
    }

    public function testDeleteBankAccount() {
        $createBankAccount = PromisePay::createBankAccount($this->bankAccountInfo);
        $bankAccountId = $createBankAccount['id'];
        
        $deleteBankAccount = PromisePay::deleteBankAccount($bankAccountId);
        
        $this->assertEquals($deleteBankAccount, 'Successfully redacted');
    }
    
}
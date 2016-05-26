<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class BankAccountTest extends \PHPUnit_Framework_TestCase {
    
    protected $userId, $bankAccountData;
    
    public function setUp() {
        $this->userId = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
        
        $this->bankAccountData = array(
            "user_id"        => $this->userId,
            "active"         => 'true',
            "bank_name"      => 'bank for test',
            "account_name"   => 'test acc',
            "routing_number" => '122235821',
            "account_number" => '123334242134',
            "account_type"   => 'savings',
            "holder_type"    => 'personal',
            "country"        => 'USA',
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
    
    public function testRedactBankAccount() {
        $createBankAccount = PromisePay::BankAccount()->create($this->bankAccountData);
        $bankAccountId = $createBankAccount['id'];
        
        $deleteBankAccount = PromisePay::BankAccount()->redact($bankAccountId);
        
        $this->assertEquals($deleteBankAccount, 'Successfully redacted');
    }
    
    public function testValidateRoutingNumber() {
        $validateRoutingNumber = PromisePay::BankAccount()->validateRoutingNumber(
            $this->bankAccountData['routing_number']
        );
    }
}
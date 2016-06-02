<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class DirectDebitAuthorityTest extends \PHPUnit_Framework_TestCase {
    
    protected $userId;
    protected $bankAccountData;
    protected $directDebitAuthorityData;
    
    protected function setUp() {
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
        
        $this->directDebitAuthorityData = array(
            'account_id' => null,
            'amount'     => 100
        );
    }
    
    protected function createBankAccount() {
        $bankAccount = PromisePay::BankAccount()->create(
            $this->bankAccountData
        );
        
        $this->assertEquals(
            $this->bankAccountData['account_name'],
            $bankAccount['bank']['account_name']
        );
        
        $this->assertNotNull($bankAccount['created_at']);
        $this->assertNotNull($bankAccount['updated_at']);
        
        return $bankAccount;
    }
    
    protected function createDirectDebitAuthority() {
        $createDirectDebitAuthority = PromisePay::DirectDebitAuthority()->create(
            $this->directDebitAuthorityData
        );
        
        $this->assertNotNull($createDirectDebitAuthority);
        $this->assertTrue(is_array($createDirectDebitAuthority));
        
        $this->assertEquals(
            $createDirectDebitAuthority['amount'],
            $this->directDebitAuthorityData['amount']
        );
        
        return $createDirectDebitAuthority;
    }
    
    public function testCreate() {
        $bankAccount = $this->createBankAccount();
        
        $this->directDebitAuthorityData['account_id'] = $bankAccount['id'];
        
        $this->createDirectDebitAuthority();
    }
    
    public function testList() {
        $bankAccount = $this->createBankAccount();
        
        $this->directDebitAuthorityData['account_id'] = $bankAccount['id'];
        
        // create a few direct debit authorities
        $amountToCreate = rand(2, 4);
        
        for ($i = 0; $i < $amountToCreate; $i++) {
            $directDebitAuthorities[] = $this->createDirectDebitAuthority();
        }
        
        $getList = PromisePay::DirectDebitAuthority()->getList(
            array
            (
                'account_id' => $bankAccount['id']
            )
        );
        
        $this->assertTrue(is_array($getList));
        $this->assertEquals(count($getList), $amountToCreate);
        
        foreach ($getList as $index => $directDebitAuthority) {
            $this->assertEquals(
                $directDebitAuthorities[$index]['id'],
                $directDebitAuthority['id']
            );
        }
    }
    
    public function testShow() {
        $bankAccount = $this->createBankAccount();
        
        $this->directDebitAuthorityData['account_id'] = $bankAccount['id'];
        
        $createDirectDebitAuthority = $this->createDirectDebitAuthority();
        
        $directDebitAuthority = PromisePay::DirectDebitAuthority()->show(
            $createDirectDebitAuthority['id']
        );
        
        $this->assertEquals(
            $createDirectDebitAuthority['id'],
            $directDebitAuthority['id']
        );
        
        $this->assertEquals(
            $createDirectDebitAuthority['amount'],
            $directDebitAuthority['amount']
        );
    }
    
    /**
     * @expectedException PromisePay\Exception\Api
     */
    public function testDeleteNonExistingAuthority() {
        PromisePay::DirectDebitAuthority()->delete(GUID());
    }
    
    public function testDelete() {
        $bankAccount = $this->createBankAccount();
        
        $this->directDebitAuthorityData['account_id'] = $bankAccount['id'];
        
        $createDirectDebitAuthority = $this->createDirectDebitAuthority();
        
        $directDebitAuthority = PromisePay::DirectDebitAuthority()->show(
            $createDirectDebitAuthority['id']
        );
        
        $this->assertEquals(
            $createDirectDebitAuthority['id'],
            $directDebitAuthority['id']
        );
        
        $deleteDirectDebitAuthority = PromisePay::DirectDebitAuthority()->delete(
            $directDebitAuthority['id']
        );
        
        $this->assertTrue($deleteDirectDebitAuthority);
    }
    
    protected function examples() {
        // CREATE
        $directDebitAuthority = PromisePay::DirectDebitAuthority()->create(
            array
            (
                'account_id' => 'ACCOUNT_ID',
                'amount'     => 100
            )
        );
        
        // GET LIST
        $getList = PromisePay::DirectDebitAuthority()->getList(
            array
            (
                'account_id' => 'BANK_ACCOUNT_ID'
            )
        );
        
        // SHOW 
        $directDebitAuthority = PromisePay::DirectDebitAuthority()->show(
            'DIRECT_DEBIT_AUTHORITY_ID'
        );
        
        // DELETE
        $deleteDirectDebitAuthority = PromisePay::DirectDebitAuthority()->delete(
            'DIRECT_DEBIT_AUTHORITY_ID'
        );
    }
    
}

<?php
namespace PromisePay;

use PromisePay\DataObjects\BankAccount;
use PromisePay\DataObjects\Bank;

class BankAccountTest extends \PHPUnit_Framework_TestCase {
	
	public function setUp() {
		require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'init.php');
	}
	
    public function testCreateBankAccountSuccessfully() {
        $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
		
        $info = array(
            "user_id" => $userid,
            "active"  => 'true',
            "bank"    => array(
                "bank_name"      => 'bank for test',
                "account_name"   => 'test acc',
				"routing_number" => '12344455512',
				"account_number" => '123334242134',
				"account_type"   => 'savings',
				"holder_type"    => 'personal',
				"country"        => 'USA'
                )
            );
		
        $bankAccount = new BankAccount($info);
        $create = new BankAccountRepository();
		
        $createdBankAccount = $create->createBankAccount($bankAccount);
        $this->assertEquals($bankAccount->getBank()->getAccountName(), $createdBankAccount->getBank()->getAccountName());
		
        $this->assertNotNull($createdBankAccount->getCreatedAt());
        $this->assertNotNull($createdBankAccount->getUpdatedAt());
    }

    public function testGetBankAccountSuccessfully() {
        $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c'; //user id created before
		
        $info = array(
            "user_id" => $userid,
            "active"  => 'true',
            "bank"    => array(
                "bank_name"      => 'bank for test',
                "account_name"   => 'test acc',
                "routing_number" => '12344455512',
                "account_number" => '123334242134',
                "account_type"   => 'savings',
                "holder_type"    => 'personal',
                "country"        => 'USA'
				)
			);
		
        $bankAccount = new BankAccount($info);
        $create = new BankAccountRepository();
		
        $bankAccountCreated = $create->createBankAccount($bankAccount);
        $founded = $create->getBankAccountById($bankAccountCreated->getId());
		
        $this->assertEquals($bankAccountCreated->getId(), $founded->getId());
    }

    public function testGetUserForBankAccountSuccessfully() {
        $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c'; //user id created before
		
        $info = array(
            "user_id" => $userid,
            "active"  => 'true',
            "bank"    => array(
                "bank_name"      => 'bank for test',
                "account_name"   => 'test acc',
                "routing_number" => '12344455512',
                "account_number" => '123334242134',
                "account_type"   => 'savings',
                "holder_type"    => 'personal',
                "country"        => 'USA'
				)
			);
		
        $bankAccount = new BankAccount($info);
        $bankRepo = new BankAccountRepository();
		
        $bankAccountCreated = $bankRepo->createBankAccount($bankAccount);
        $gotUser = $bankRepo->getUserForBankAccount($bankAccountCreated->getId());
		
        $this->assertEquals($userid, $gotUser->getId());
    }

    public function testDeleteBankAccountSuccessfully() {
        $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c'; //user id created before
		
        $info = array(
            "user_id" => $userid,
            "active"  => 'true',
            "bank"    => array(
                "bank_name"      => 'bank for test',
                "account_name"   => 'test acc',
                "routing_number" => '12344455512',
                "account_number" => '123334242134',
                "account_type"   => 'savings',
                "holder_type"    => 'personal',
                "country"        => 'USA'
				)
			);
		
        $bankAccount = new BankAccount($info);
        $create = new BankAccountRepository();
		
        $createdBA = $create->createBankAccount($bankAccount);
        $id = $createdBA->getId();

        $this->assertTrue($create->deleteBankAccount($id));
    }
	
}
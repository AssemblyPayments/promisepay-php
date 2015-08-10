<?php
/**
 * Created by PhpStorm.
 * User: Web_den
 * Date: 11.06.2015
 * Time: 17:44
 */

namespace PromisePay;

use PromisePay\DataObjects\BankAccount;
use PromisePay\DataObjects\Bank;

include_once __DIR__ . '/../init.php';
include_once 'GUID.php';

class BankAccountTest extends \PHPUnit_Framework_TestCase
{

    public function testCreateBankAccountSuccessfully()
    {
        $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
        $info = array(
            "user_id" => $userid,
            "active"=> 'true',
            "bank" => array(
                    "bank_name"=>'bank for test',
                    "account_name"=>'test acc',
                    "routing_number"=>'12344455512',
                    "account_number"=>'123334242134',
                    "account_type"=>'savings',
                    "holder_type"=>'personal',
                    "country"=>'AUS',
                    ));
        $bankAccount = new BankAccount($info);
        $create = new BankAccountRepository();
        $createBank = $create->createBankAccount($bankAccount);

        $this->assertEquals($bankAccount->getBank()->getAccountName(), $createBank->getBank()->getAccountName());

        $this->assertNotNull($createBank->getCreatedAt());
        $this->assertNotNull($createBank->getUpdatedAt());
    }

    public function testGetBankAccountSuccessfully()
    {
        $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';//user id created before
        $info = array(
            "user_id" => $userid,
            "active"=> 'true',
            "bank" => array(
                "bank_name"=>'bank for test',
                "account_name"=>'test acc',
                "routing_number"=>'12344455512',
                "account_number"=>'123334242134',
                "account_type"=>'savings',
                "holder_type"=>'personal',
                "country"=>'AUS',
            ));
        $bankAccount = new BankAccount($info);
        $create = new BankAccountRepository();
        $bankAccountCreated = $create->createBankAccount($bankAccount);
        $founded = $create->getBankAccountById($bankAccountCreated->getId());
        $this->assertEquals($bankAccountCreated->getId(), $founded->getId());
    }

    public function testGetUserForBankAccountSuccessfully()
    {
        $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';//user id created before
        $info = array(
            "user_id" => $userid,
            "active"=> 'true',
            "bank" => array(
                "bank_name"=>'bank for test',
                "account_name"=>'test acc',
                "routing_number"=>'12344455512',
                "account_number"=>'123334242134',
                "account_type"=>'savings',
                "holder_type"=>'personal',
                "country"=>'AUS',
            ));
        $bankAccount = new BankAccount($info);
        $create = new BankAccountRepository();

        $bankAccountCreated = $create->createBankAccount($bankAccount);
        $gotUser = $create->getUserForBankAccount($bankAccountCreated->getId());


        $this->assertEquals($userid, $gotUser->getId());
    }

    public function testDeleteBankAccountSuccessfully()
    {
        $userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';//user id created before
        $info = array(
            "user_id" => $userid,
            "active"=> 'true',
            "bank" => array(
                "bank_name"=>'bank for test',
                "account_name"=>'test acc',
                "routing_number"=>'12344455512',
                "account_number"=>'123334242134',
                "account_type"=>'savings',
                "holder_type"=>'personal',
                "country"=>'AUS',
            ));
        $bankAccount = new BankAccount($info);
        $create = new BankAccountRepository();
        $createdBA = $create->createBankAccount($bankAccount);
        $id = $createdBA->getId();

        $this->assertTrue($create->deleteBankAccount($id));
    }


}
 
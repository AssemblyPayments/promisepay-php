<?php
/**
 * Created by PhpStorm.
 * User: Web_den
 * Date: 11.06.2015
 * Time: 17:44
 */

namespace PromisePay;

use PromisePay\DataObjects\BankAccount;

include_once '../init.php';
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
                    "bank_country"=>'AUS',
                    ));
        $bankAccount = new BankAccount($info);
        $create = new BankAccountRepository();
        $create->createBankAccount($bankAccount);

        $this->assertEquals($bankAccount->bank->getAccountName(),$create->bank->getAccountName());

        $this->assertNotNull($create->getCreatedAt());
        $this->assertNotNull($create->getUpdatedAt());
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
                "bank_country"=>'AUS',
            ));
        $bankAccount = new BankAccount($info);
        $create = new BankAccountRepository();
        $create->createBankAccount($bankAccount);
        $this->assertEquals($bankAccount->getUserId(),$create->getBankAccountById($userid));
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
                "bank_country"=>'AUS',
            ));
        $bankAccount = new BankAccount($info);
        $create = new BankAccountRepository();


        $this->assertEquals($create->createBankAccount($bankAccount)->getUserId(), $create->getUserForBankAccount($userid)->getUserId());
    }

    public function testDeleteBankAccountSuccessfully()
    {
        $bankAccount = new BankAccountRepository();
        $bankAccount->deleteBankAccount('ec9bf096-c505-4bef-87f6-18822b9dbf2c');
        $bankAccount->getBankAccountById('ec9bf096-c505-4bef-87f6-18822b9dbf2c');
    }


}
 
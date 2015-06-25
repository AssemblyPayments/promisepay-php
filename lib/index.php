<?php
namespace PromisePay;

use Httpful\Request;
use Httpful\Http;
use PromisePay\DataObjects\BankAccount;
use PromisePay\DataObjects\Item;
use PromisePay\DataObjects\User;

use PromisePay\UserRepository;
require '../init.php';
require '../tests/GUID.php';
$id = GUID() ;

$userid = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
$info = array(
    "user_id" => $userid,
    "is_active"=> 'true',
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
print_r($create->createBankAccount($bankAccount));
//print_r($bankAccount->getBank());
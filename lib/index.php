<?php
namespace PromisePay;

use Httpful\Request;
use Httpful\Http;
use PromisePay\DataObjects\User;

use PromisePay\UserRepository;
require '../init.php';
require '../tests/GUID.php';
$id = GUID() ;
$arr = array(
    "id"            => $id,
    "first_name"    => 'Test',
    "last_name"     => 'Test',
    "email"         => 'teststseere1231231231s1231213rser2131223tsetse666678889998'.'@google.com',
    "mobile"        => $id,
    "address_line1" => 'a line 1',
    "address_line2" => 'a line 2',
    "state"         => 'state',
    "city"          => 'city',
    "zip"           => '90210',
    "country"       => 'AFG',
    "dob"           => '11/01/1971'
);
$test = new UserRepository();
$userObj = new User($arr);
print_r($test->createUser($userObj));
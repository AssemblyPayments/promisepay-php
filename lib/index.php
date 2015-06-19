<?php
namespace PromisePay;

use Httpful\Request;
use Httpful\Http;
include_once 'Configuration.php';
include_once 'Exception/Credentials.php';
include_once 'Exception/Base.php';
include_once 'Vendors/Httpful/Http.php';
include_once 'Vendors/Httpful/Bootstrap.php';
include_once 'Vendors/Httpful/Request.php';
include_once 'ApiAbstract.php';
include_once 'DataObjects/AccountAbstract.php';
include_once 'DataObjects/Object.php';
include_once 'UserRepository.php';
$test = new UserRepository();

//Request::delete();
//Request::get();
//Request::patch();
//Request::post();

//$response = Request::get($test->getApiUrl().'users')->authenticateWith($test->getUserLogin(), $test->getUserPassword())->send();
$user = array(
    "id"            => '123123',
    "first_name"    => 'bob',
    "last_name"     => 'taylor',
    "email"         => 'taylor@bob.com',
    "mobile"        => '3213121223',
    "address_line1" => 'a line 1',
    "address_line2" => 'a line 2',
    "state"         => 'state',
    "city"          => 'city',
    "zip"           => '223312',
    "country"       => 'AFG',
);

$user = array(
    "id"            => sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535)),
    "first_name"    => 'bob',
    "last_name"     => 'taylor',
    "email"         => 'taylor@bob.com',
    "mobile"        => '3213121223',
    "address_line1" => 'a line 1',
    "address_line2" => 'a line 2',
    "state"         => 'state',
    "city"          => 'city',
    "zip"           => '223312',
    "country"       => 'AFG',
);
//print_r($test->createUser($user));
print_r($test->getListOfUsers());
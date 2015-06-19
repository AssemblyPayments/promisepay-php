<?php
/**
 * Created by PhpStorm.
 * User: Web_den
 * Date: 11.06.2015
 * Time: 17:48
 */
namespace PromisePay;
chdir("../lib");
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

chdir("../tests");

class UserTest extends \PHPUnit_Framework_TestCase {

    public function testListUsersSuccessfully() {
        chdir("../lib");
        $userRepo = new UserRepository();
        $list = $userRepo->getListOfUsers();
        $this->assertTrue(count($list)>0);
    }



}
 
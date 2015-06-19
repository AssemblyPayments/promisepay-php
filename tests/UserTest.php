<?php
/**
 * Created by PhpStorm.
 * User: Web_den
 * Date: 11.06.2015
 * Time: 17:48
 */
namespace PromisePay;


include_once '../init.php';


class UserTest extends \PHPUnit_Framework_TestCase {

    public function testListUsersSuccessfully() {
        //chdir("../lib");
        $userRepo = new UserRepository();
        $list = $userRepo->getListOfUsers();
        $this->assertTrue(count($list)>0);
    }



}
 
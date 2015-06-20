<?php
/**
 * Created by PhpStorm.
 * User: Web_den
 * Date: 11.06.2015
 * Time: 17:48
 */
namespace PromisePay;


use PromisePay\DataObjects\User;

include_once '../init.php';
include_once 'GUID.php';


class UserTest extends \PHPUnit_Framework_TestCase {

    public function testListUsersSuccessfully() {
        $userRepo = new UserRepository();
        $list = $userRepo->getListOfUsers();
        $this->assertTrue(count($list)>0);
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testListUsersNegativeParams() {
        $userRepo = new UserRepository();
        $userRepo->getListOfUsers(-10,-20);
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testListUsersTooHighLimit()
    {
        $userRepo = new UserRepository();
        $userRepo->getListOfUsers(-201);
    }


    public function testUserCreateSuccessful()
    {
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        $repo = new UserRepository();
        $id = GUID();
        //$user = new User();
        //$user->setId();
        $arr = array(
            "id"            => $id,
            "first_name"    => 'Test',
            "last_name"     => 'Test',
            "email"         => $id . '@google.com',
            "mobile"        => $id . '3213125551223',
            "address_line1" => 'a line 1',
            "address_line2" => 'a line 2',
            "state"         => 'state',
            "city"          => 'city',
            "zip"           => '90210',
            "country"       => 'AUS',
        );

        $user = new User($arr);

        //$user = json_decode(json_encode($arr), FALSE);

        $createdUser = $repo->createUser($user);

        $findUser = $repo->getUserById($id);

        $this->assertEquals($createdUser->id, $findUser->getId());

        $this->assertEquals($user->getId(), $createdUser->id);

        $this->assertEquals($user->getFirstName(), $createdUser->first_name);
        $this->assertEquals($user->getLastName(), $createdUser->last_name);
        $this->assertEquals($user->getEmail(), $createdUser->email);
        $this->assertNotNull($user->getCreatedAt());
        $this->assertNotNull($user->getUpdatedAt());
    }



}
 

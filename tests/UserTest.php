<?php
/**
 * Created by PhpStorm.
 * User: Web_den
 * Date: 11.06.2015
 * Time: 17:48
 */
namespace PromisePay;


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
        $repo = new UserRepository();
        $id = GUID();
        $user = new User();
        $user.setId()
        $arr = array(
            "id"            => $id,
            "FirstName"    => 'Test',
            "LastName"     => 'Test',
            "email"         => $id . 'google.com',
            "mobile"        => '3213121223',
            "address_line1" => 'a line 1',
            "address_line2" => 'a line 2',
            "state"         => 'state',
            "city"          => 'city',
            "zip"           => '90210',
            "country"       => 'AUS',
        );

        $user = json_decode(json_encode($arr), FALSE);

        $createdUser = $repo->createUser($user);

        $this->assertEquals($user->id, $createdUser->id);

        $this->assertEquals($user->first_name, $createdUser->first_name);
        $this->assertEquals($user->last_name, $createdUser->last_name);
        $this->assertEquals($user->email, $createdUser->email);
        $this->assertNotNull($user->createdAt);
        $this->assertNotNull($user->updatedAt);
    }



}
 
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

        $arr = array(
            "id"            => $id,
            "first_name"    => 'Test',
            "last_name"     => 'Test',
            "email"         => $id . '@google.com',
            "mobile"        => $id.'3213125551223',
            "address_line1" => 'a line 1',
            "address_line2" => 'a line 2',
            "state"         => 'state',
            "city"          => 'city',
            "zip"           => '90210',
            "country"       => 'AUS',
        );

        $user = new User($arr);



        $createdUser = $repo->createUser($user);

        $findUser = $repo->getUserById($id);

        $this->assertEquals($createdUser->id, $findUser->getId());

        $this->assertEquals($user->getId(), $createdUser->id);

        $this->assertEquals($user->getFirstName(), $createdUser->first_name);
        $this->assertEquals($user->getLastName(), $createdUser->last_name);
        $this->assertEquals($user->getEmail(), $createdUser->email);
        $this->assertNotNull($createdUser->created_at);
        $this->assertNotNull($createdUser->updated_at);
    }




    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function CreateUserIdMissing()
    {
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        $repo = new UserRepository();
        $id = GUID();

        $arr = array(
            "id"            => '',
            "first_name"    => 'Test',
            "last_name"     => 'Test',
            "email"         => $id . '@google.com',
            "mobile"        => $id.'3213125551223',
            "address_line1" => 'a line 1',
            "address_line2" => 'a line 2',
            "state"         => 'state',
            "city"          => 'city',
            "zip"           => '90210',
            "country"       => 'AUS',
        );

        $user = new User($arr);
        $repo->createUser($user);
    }



    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function createUserMissedFirstname()
    {
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        $repo = new UserRepository();
        $id = GUID();

        $arr = array(
            "id"            => $id,
            "first_name"    => '',
            "last_name"     => 'Test',
            "email"         => $id . '@google.com',
            "mobile"        => $id.'3213125551223',
            "address_line1" => 'a line 1',
            "address_line2" => 'a line 2',
            "state"         => 'state',
            "city"          => 'city',
            "zip"           => '90210',
            "country"       => 'AUS',
        );
        $user = new User($arr);
        $repo->createUser($user);
    }


    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function createUserWrongCountry()
    {
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        $repo = new UserRepository();
        $id = GUID();

        $arr = array(
            "id"            => $id,
            "first_name"    => 'test',
            "last_name"     => 'Test',
            "email"         => $id . '@google.com',
            "mobile"        => $id.'3213125551223',
            "address_line1" => 'a line 1',
            "address_line2" => 'a line 2',
            "state"         => 'state',
            "city"          => 'city',
            "zip"           => '90210',
            "country"       => 'AUSee',
        );
        $user = new User($arr);
        $repo->createUser($user);
    }


    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function createUserWrongEmail()
    {
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        $repo = new UserRepository();
        $id = GUID();

        $arr = array(
            "id"            => $id,
            "first_name"    => 'Tese',
            "last_name"     => 'Test',
            "email"         => $id . 'google.com',
            "mobile"        => $id.'3213125551223',
            "address_line1" => 'a line 1',
            "address_line2" => 'a line 2',
            "state"         => 'state',
            "city"          => 'city',
            "zip"           => '90210',
            "country"       => 'AUS',
        );
        $user = new User($arr);
        $repo->createUser($user);
    }


    public function getUserSuccess()
    {
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        $repo = new UserRepository();
        $id = GUID();

        $arr = array(
            "id"            => $id,
            "first_name"    => 'test',
            "last_name"     => 'Test',
            "email"         => $id . '@google.com',
            "mobile"        => $id.'3213125551223',
            "address_line1" => 'a line 1',
            "address_line2" => 'a line 2',
            "state"         => 'state',
            "city"          => 'city',
            "zip"           => '90210',
            "country"       => 'AUS',
        );
        $user = new User($arr);
        $createdUser = $repo->createUser($user);

        $findUser = $repo->getUserById($id);
        $this->assertEquals($createdUser->id, $findUser->getId());
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function getUserMissedID()
    {

        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        $repo = new UserRepository();
        $id = GUID();
        $arr = array(
            "id"            => $id,
            "first_name"    => 'test',
            "last_name"     => 'Test',
            "email"         => $id . '@google.com',
            "mobile"        => $id.'3213125551223',
            "address_line1" => 'a line 1',
            "address_line2" => 'a line 2',
            "state"         => 'state',
            "city"          => 'city',
            "zip"           => '90210',
            "country"       => 'AUS',
        );
        $user = new User($arr);
        $repo->createUser($user);
        $missed = '';
        $repo->getUserById($missed);
    }



    public function deleteUserbyIdsuccessful()
    {
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        $repo = new UserRepository();
        $repo->deleteUser('d8cc55d2-a5ab-476d-9816-9d7491d522c5');
        $repo->getUserById('d8cc55d2-a5ab-476d-9816-9d7491d522c5');
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function deleteUserbyIdmissedId()
    {
        \PHPUnit_Framework_Error_Notice::$enabled = FALSE;
        $repo = new UserRepository();
        $repo->deleteUser('');

    }


// edit user success
// edit user missed id


// send mibilepin successful

// list user items successful
// list user bank accounts
// list user CardAccounts
// list user Ppal accounts
//list user disbursement accounts successful

}
 

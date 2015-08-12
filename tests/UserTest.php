<?php

namespace PromisePay;


use PromisePay\DataObjects\BankAccount;
use PromisePay\DataObjects\User;
use PromisePay\Exception\Validation;
use PromisePay\Exception\Argument;

include_once 'GUID.php';
include_once __DIR__ . '/../init.php';

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

        $this->assertEquals($createdUser->getId(), $findUser->getId());

        $this->assertEquals($user->getId(), $createdUser->getId());

        $this->assertEquals($user->getFirstName(), $createdUser->getFirstName());
        $this->assertEquals($user->getLastName(), $createdUser->getLastName());
        $this->assertEquals($user->getEmail(), $createdUser->getEmail());
        $this->assertNotNull($createdUser->getCreatedAt());
        $this->assertNotNull($createdUser->getUpdatedAt());
    }




    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function testCreateUserIdMissing()
    {

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
    public function testcreateUserMissedFirstname()
    {

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
    public function testcreateUserWrongCountry()
    {

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
    public function testcreateUserWrongEmail()
    {

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


    public function testgetUserSuccess()
    {

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
        $this->assertEquals($createdUser->getId(), $findUser->getId());
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testgetUserMissedID()
    {


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



    public function testdeleteUserbyIdsuccessful()
    {

        $repo = new UserRepository();
        $repo->deleteUser('d8cc55d2-a5ab-476d-9816-9d7491d522c5');
        $repo->getUserById('d8cc55d2-a5ab-476d-9816-9d7491d522c5');
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testdeleteUserbyIdmissedId()
    {

        $repo = new UserRepository();
        $repo->deleteUser('');
    }


    public function testEditUserSuccess()
    {
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

            $edit = array(
                "id"            => $id,
                "first_name"    => 'test edited',
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
        $edituser = new User($edit);
        $repo->updateUser($edituser);
        $findUser = $repo->getUserById($id);
        $this->assertEquals($edituser->getFirstName(), $findUser->getFirstName());
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testEditUserMissedId()
    {
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

        $edit = array(
            "id"            => '',
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
        $edituser = new User($edit);
        $repo->updateUser($edituser);
        $findUser = $repo->getUserById($id);
        $this->assertEquals($createdUser->getId(), $findUser->getId());
    }
    // send mibilepin successful
    // no method in entity

// list user items successful
    public function testListItemSuccessfully()
    {
        $repo = new UserRepository();
        $repo->getListOfItemsForUser('89592d8a-6cdb-4857-a90d-b41fc817d639');
    }
// list user bank accounts
    public function testListUserCardAccounts()
    {
        $repo = new UserRepository();
        $repo->getListOfCardAccountsForUser('89592d8a-6cdb-4857-a90d-b41fc817d639');
    }
// list user CardAccounts

    public function testListUserBankAccounts()
    {
        $repo = new UserRepository();
        $repo->getListOfBankAccountsForUser('89592d8a-6cdb-4857-a90d-b41fc817d639');
    }
// list user Ppal accounts
    public function testListPpalAccounts()
    {
        $repos = new UserRepository();
        $repos->getListOfPayPalAccountsForUser('89592d8a-6cdb-4857-a90d-b41fc817d639');
    }
//list user disbursement accounts successful
//disbursement not ready
}
 

<?php
namespace PromisePay;
use PromisePay\DataObjects\User;

class UserTest extends \PHPUnit_Framework_TestCase {
	
	public function setUp() {
		require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'init.php');
		require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests/GUID.php');
	}
	
    public function testUserCreateSuccess() {
        $id = GUID();
        $userRepo = new UserRepository();
		
        $payload = array(
            'id'            => $id,
            'first_name'    => 'UserCreateTest',
            'last_name'     => 'UserLastname',
            'email'         => $id . '@google.com',
            'mobile'        => $id . '00012',
            'address_line1' => 'a_line1',
            'address_line2' => 'a_line2',
            'state'         => 'state',
            'city'          => 'city',
            'zip'           => '90210',
            'country'       => 'AUS'
        );

        $user = new User($payload);
        $createdUser = $userRepo->createUser($user);
        $findUser = $userRepo->getUserById($id);
		
        $this->assertEquals($createdUser->getId(), $findUser->getId());
        $this->assertNotNull($createdUser->getCreatedAt());
        $this->assertNotNull($createdUser->getUpdatedAt());
    }

    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function testUserCreateMissedId() {
        $id = GUID();
        $userRepo = new UserRepository();
		
        $payload = array(
            'id'            => '',
            'first_name'    => 'UserCreateTest',
            'last_name'     => 'UserLastname',
            'email'         => $id.'@google.com',
            'mobile'        => $id . '00012',
            'address_line1' => 'a_line1',
            'address_line2' => 'a_line2',
            'state'         => 'state',
            'city'          => 'city',
            'zip'           => '90210',
            'country'       => 'AUS'
        );
		
        $user = new User($payload);
        $userRepo->createUser($user);
    }

    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function testUserCreateMissedFirstName() {
        $id = GUID();
        $userRepo = new UserRepository();
		
        $payload = array(
            'id'            => $id,
            'first_name'    => '',
            'last_name'     => 'UserLastname',
            'email'         => $id.'@google.com',
            'mobile'        => $id . '00012',
            'address_line1' => 'a_line1',
            'address_line2' => 'a_line2',
            'state'         => 'state',
            'city'          => 'city',
            'zip'           => '90210',
            'country'       => 'AUS'
        );

        $user = new User($payload);
        $userRepo->createUser($user);
    }

    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function testUserCreateWrongCountryCode() {
        $id = GUID();
        $userRepo = new UserRepository();
		
        $payload = array(
            'id'            => '',
            'first_name'    => 'UserCreateTest',
            'last_name'     => 'UserLastname',
            'email'         => $id.'@google.com',
            'mobile'        => $id . '00012',
            'address_line1' => 'a_line1',
            'address_line2' => 'a_line2',
            'state'         => 'state',
            'city'          => 'city',
            'zip'           => '90210',
            'country'       => 'TESTWRONGCODE'
        );

        $user = new User($payload);
        $userRepo->createUser($user);
    }

    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function testUserCreateInvalidEmail() {
        $id = GUID();
        $userRepo = new UserRepository();
		
        $payload = array(
            'id'            => '',
            'first_name'    => 'UserCreateTest',
            'last_name'     => 'UserLastname',
            'email'         => '___@google.com',
            'mobile'        => $id . '00012',
            'address_line1' => 'a_line1',
            'address_line2' => 'a_line2',
            'state'         => 'state',
            'city'          => 'city',
            'zip'           => '90210',
            'country'       => 'AUS'
        );

        $user = new User($payload);
        $userRepo->createUser($user);
    }

    public function testGetListOfUsersSuccess() {
        $userRepo = new UserRepository();
        $list = $userRepo->getListOfUsers();
        $this->assertTrue(count($list) > 0);
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testGetListOfUsersNegativeParams() {
        $userRepo = new UserRepository();
        $userRepo->getListOfUsers(-10, -20);
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testGetListOfUsersOverLimit() {
        $userRepo = new UserRepository();
        $userRepo->getListOfUsers(-201);
    }

    public function testGetUserSuccess() {
        $id = GUID();
        $userRepo = new UserRepository();
		
        $payload = array(
            'id'            => $id,
            'first_name'    => 'UserCreateTest',
            'last_name'     => 'UserLastname',
            'email'         => $id.'@google.com',
            'mobile'        => $id.'00012',
            'address_line1' => 'a_line1',
            'address_line2' => 'a_line2',
            'state'         => 'state',
            'city'          => 'city',
            'zip'           => '90210',
            'country'       => 'AUS'
        );

        $user = new User($payload);
        $createdUser = $userRepo->createUser($user);
        $findUser = $userRepo->getUserById($id);
        $this->assertEquals($createdUser->getId(), $findUser->getId());
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testGetUserMissedId() {
        $id = GUID();
        $userRepo = new UserRepository();
		
        $payload = array(
            'id' => $id,
            'first_name'    => 'UserCreateTest',
            'last_name'     => 'UserLastname',
            'email'         => $id.'@google.com',
            'mobile'        => $id.'00012',
            'address_line1' => 'a_line1',
            'address_line2' => 'a_line2',
            'state'         => 'state',
            'city'          => 'city',
            'zip'           => '90210',
            'country'       => 'AUS'
        );
		
        $missedId = '';
        $user = new User($payload);
        $createdUser = $userRepo->createUser($user);
        $findUser = $userRepo->getUserById($missedId);
    }

    public function testDeleteUserSuccess() {
        $id = GUID();
        $userRepo = new UserRepository();
		
        $payload = array(
            'id' => $id,
            'first_name'    => 'UserCreateTest',
            'last_name'     => 'UserLastname',
            'email'         => $id.'@google.com',
            'mobile'        => $id.'00012',
            'address_line1' => 'a_line1',
            'address_line2' => 'a_line2',
            'state'         => 'state',
            'city'          => 'city',
            'zip'           => '90210',
            'country'       => 'AUS'
        );

        $user = new User($payload);
        $createdUser = $userRepo->createUser($user);
		
        //delete action not working ina API, Uncomment asserting below after fix.
        //$this->assertTrue($userRepo->deleteUser($createdUser->getId()));
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testDeleteUserMissedId()
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
            "country"       => 'AUS'
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
            "country"       => 'AUS'
        );
		
        $edituser = new User($edit);
        $repo->updateUser($edituser);
        $findUser = $repo->getUserById($id);
        $this->assertEquals($edituser->getFirstName(), $findUser->getFirstName());
    }

    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function testEditUserMissedId() {
        $id = GUID();
        $userRepo = new UserRepository();
        $payload = array(
            'id'            => '',
            'first_name'    => 'UserCreateTest',
            'last_name'     => 'UserLastname',
            'email'         => $id.'@google.com',
            'mobile'        => $id.'00012',
            'address_line1' => 'a_line1',
            'address_line2' =>'a_line2',
            'state'         => 'state',
            'city'          => 'city',
            'zip'           => '90210',
            'country'       => 'AUS'
        );

        $user = new User($payload);
        $userRepo->updateUser($user);
    }

    public function testListUserItemsSuccess() {
        $repo = new UserRepository();
        $this->assertNotNull($repo->getListOfItemsForUser('ec9bf096-c505-4bef-87f6-18822b9dbf2c'));
    }

    public function testListUserBankAccountSuccess() {
        $repo = new UserRepository();
        $this->assertTrue(is_object($repo->getListOfBankAccountsForUser('ec9bf096-c505-4bef-87f6-18822b9dbf2c')));
    }

    public function testListUserCardAccountSuccess() {
        $repo = new UserRepository();
        $this->assertTrue(is_object($repo->getListOfCardAccountsForUser('ec9bf096-c505-4bef-87f6-18822b9dbf2c')));
    }

    public function testListUserPayPalAccountSuccess() {
        $repos = new UserRepository();
        $this->assertTrue(is_object($repos->getListOfPayPalAccountsForUser('ec9bf096-c505-4bef-87f6-18822b9dbf2c')));
    }

    public function testListUserDisbursementAccountSuccess() {
        $repos = new UserRepository();
        $this->assertNotNull($repos->setDisbursementAccount('ec9bf096-c505-4bef-87f6-18822b9dbf2c', '123'));
    }
}
<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class UserTest extends \PHPUnit_Framework_TestCase {
    
    protected $GUID, $userData;
    
    public function setUp() {
        $this->GUID = GUID();
        $this->userData = array(
            'id'            => $this->GUID,
            'first_name'    => 'UserCreateTest',
            'last_name'     => 'UserLastname',
            'email'         => $this->GUID . '@google.com',
            'mobile'        => $this->GUID . '00012',
            'address_line1' => 'a_line1',
            'address_line2' => 'a_line2',
            'state'         => 'state',
            'city'          => 'city',
            'zip'           => '90210',
            'country'       => 'AUS'
        );
    }
    
    public function testUserCreate() {
        // First, create the user
        $createUser = PromisePay::createUser($this->userData);
        
        // Second, fetch its data
        $fetchUser = PromisePay::getUserById($this->GUID);
        
        $this->assertEquals($createUser['id'], $fetchUser['id']);
        $this->assertNotNull($createUser['created_at']);
        $this->assertNotNull($createUser['updated_at']);
    }

    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function testUserCreateMissedId() {
        // Isolate the user data
        $data = $this->userData;
        
        // Change some params
        $data['id'] = '';
        
        // Fire (and expect an exception)
        PromisePay::createUser($data);
    }

    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function testUserCreateMissedFirstName() {
        // Isolate the user data
        $data = $this->userData;
        
        // Change some params
        $data['first_name'] = '';
        
        // Fire (and expect an exception)
        PromisePay::createUser($data);
    }

    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function testUserCreateWrongCountryCode() {
        // Isolate the user data
        $data = $this->userData;
        
        // Change some params
        $data['country'] = 'WRONGCODE';
        
        // Fire (and expect an exception)
        PromisePay::createUser($data);
    }

    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function testUserCreateInvalidEmail() {
        // Isolate the user data
        $data = $this->userData;
        
        // Change some params
        $data['email'] = '@promisepay.com';
        
        // Fire (and expect an exception)
        PromisePay::createUser($data);
    }

    public function testGetListOfUsersSuccess() {
        $usersList = PromisePay::getListOfUsers();
        
        $this->assertNotNull($usersList);
        $this->assertTrue(count($usersList) > 0);
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testGetListOfUsersNegativeParams() {
        PromisePay::getListOfUsers(-10, -20);
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testGetListOfUsersOverLimit() {
        PromisePay::getListOfUsers(-201);
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testGetUserMissedId() {
        PromisePay::getUserById("");
    }

    public function testEditUserSuccess()
    {
        $userData = $this->userData;
        
        $createUser = PromisePay::createUser($this->userData);
        
        $userData['first_name'] = 'Edited First name';
        
        $updateUser = PromisePay::updateUser($createUser['id'], $userData);
        
        $this->assertEquals($userData['first_name'], $updateUser['first_name']);
    }

    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function testEditUserMissedId() {
        // First, create the user
        $createUser = PromisePay::createUser($this->userData);
        
        $userData = $this->userData;
        $userData['id'] = "";
        
        PromisePay::updateUser($createUser['id'], $userData);
    }
    
    /*
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
    */
}
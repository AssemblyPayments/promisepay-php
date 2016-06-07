<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class WalletAccountsTest extends \PHPUnit_Framework_TestCase {
    
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
    
    protected function createUser() {
        $user = PromisePay::User()->create($this->userData);
        
        $this->assertEquals($this->userData['email'], $user['email']);
        
        return $user;
    }
    
    protected function createBankAccount($uid) {
        require_once __DIR__ . '/BankAccountTest.php';
        
        $bankAccountTest = new BankAccountTest;
        
        $bankAccountTest->setUp();
        $bankAccountTest->setBankAccountUserId($uid);
        
        return $bankAccountTest->testCreateBankAccount();
    }
    
    public function testShow() {
        $user = $this->createUser();
        $bank = $this->createBankAccount($user['id']);
        
        $wallet = PromisePay::WalletAccounts()->show($bank['id']);
        
        $this->assertNotNull($wallet);
        $this->assertEquals($bank['id'], $wallet['id']);
    }
    
    public function testGetUser() {
        $user = $this->createUser();
        $bank = $this->createBankAccount($user['id']);
        
        $walletUser = PromisePay::WalletAccounts()->getUser(
            $bank['id']
        );
        
        $this->assertNotNull($walletUser);
        $this->assertEquals($user['email'], $walletUser['email']);
        $this->assertEquals($user['first_name'], $walletUser['first_name']);
        $this->assertEquals($user['last_name'], $walletUser['last_name']);
    }
    /**
     * @group dev
     */
    public function testDepositFunds() {
        $user = $this->createUser();
        
        $bankOne = $this->createBankAccount($user['id']);
        $bankTwo = $this->createBankAccount($user['id']);
        
        var_dump($bankOne, $bankTwo);
    }
}


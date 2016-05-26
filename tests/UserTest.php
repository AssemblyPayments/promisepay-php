<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class UserTest extends \PHPUnit_Framework_TestCase {
    
    protected $GUID, $userData, $itemData, $bankAccountData, $cardAccountData, $payPalData;
    
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
        
        $this->buyerId = "ec9bf096-c505-4bef-87f6-18822b9dbf2c";
        
        $this->itemData = array(
            "id"              => GUID(),
            "name"            => '3 Happy Friends Collection',
            "amount"          => 2000,
            "payment_type_id" => 1,
            "buyer_id"        => $this->buyerId,
            "seller_id"       => '',
            "description"     => '3 Happy Friends Collection in BluRay.'
        );
        
        
        $this->bankAccountData = array(
            "user_id"        => '',
            "active"         => 'true',
            "bank_name"      => 'Bank of America',
            "account_name"   => 'John Doe',
            "routing_number" => '122235821',
            "account_number" => '123334242134',
            "account_type"   => 'savings',
            "holder_type"    => 'personal',
            "country"        => 'USA',
        );
        
        $this->cardAccountData = array(
           'user_id'      => GUID(),
           'full_name'    => 'UserCreateTest UserLastname',
           'number'       => '4111111111111111',
           "expiry_month" => '06',
           "expiry_year"  => '2020',
           "cvv"          => '123'
        );
        
        $this->payPalData = array(
            'user_id'      => '',
            'paypal_email' => 'test@paypalname.com'
        );
        
    }
    
    public function testUserCreate() {
        // First, create the user
        $createUser = PromisePay::User()->create($this->userData);
        
        // Second, fetch its data
        $getUser = PromisePay::User()->get($createUser['id']);
        
        $this->assertNotNull($createUser['created_at']);
        $this->assertNotNull($createUser['updated_at']);
        $this->assertEquals($createUser['id'], $getUser['id']);
        $this->assertEquals($this->userData['first_name'] . ' ' . $this->userData['last_name'], $getUser['full_name']);
    }
    
    public function testGetListOfUsers() {
        $usersList = PromisePay::User()->getList();
        
        $this->assertNotNull($usersList);
        $this->assertTrue(count($usersList) > 0);
        $this->assertTrue(array_key_exists('full_name', reset($usersList)));
    }
    
    public function testEditUser() {
        $userData = $this->userData;
        
        $createUser = PromisePay::User()->create($this->userData);
        
        $userData['first_name'] = 'Edited First name';
        
        $updateUser = PromisePay::User()->update($createUser['id'], $userData);
        
        $this->assertEquals($userData['first_name'], $updateUser['first_name']);
    }
    
    public function testListUserItems() {
        // First, create the user
        $createUser = PromisePay::User()->create($this->userData);
        
        // update itemData, so seller is just created user
        $this->itemData['seller_id'] = $createUser['id'];
        
        // Create an item
        $createItem = PromisePay::Item()->create($this->itemData);
        
        // Get the list
        $getListOfItems = PromisePay::User()->getListOfItems($createUser['id']);
        
        $this->assertEquals($this->itemData['name'], $getListOfItems[0]['name']);
        $this->assertEquals($this->itemData['description'], $getListOfItems[0]['description']);
    }
    
    public function testListUserBankAccounts() {
        // First, create the user
        $createUser = PromisePay::User()->create($this->userData);
        
        // update bank account data with the id of just created user
        $this->bankAccountData['user_id'] = $createUser['id'];
        
        // create a Bank Account
        $createBankAccount = PromisePay::BankAccount()->create($this->bankAccountData);
        
        // Lookup Bank Accounts associated with the user
        $userBankAccounts = PromisePay::User()->getListOfBankAccounts($createUser['id']);
        
        $this->assertEquals($this->bankAccountData['bank_name'], $userBankAccounts['bank']['bank_name']);
    }
    
    public function testListUserCardAccount() {
        // First, create the user
        $createUser = PromisePay::User()->create($this->userData);
        
        // update card account data with the id of just created user
        $this->cardAccountData['user_id'] = $createUser['id'];
        
        // create a Card Account
        $createCardAccount = PromisePay::CardAccount()->create($this->cardAccountData);
        
        // Lookup Card Accounts associated with the user
        $userCardAccounts = PromisePay::User()->getListOfCardAccounts($createUser['id']);
        
        $this->assertEquals($this->cardAccountData['full_name'], $userCardAccounts['card']['full_name']);
    }
    
    
    public function testListUserPayPalAccountSuccess() {
        // First, create the user
        $createUser = PromisePay::User()->create($this->userData);
        
        // Update PayPal account data with the id of just created user
        $this->payPalData['user_id'] = $createUser['id'];
        
        // Create a PayPal Account
        $createPayPalAccount = PromisePay::PayPalAccount()->create($this->payPalData);
        
        // Lookup PayPal Accounts associated with the user
        $userPayPalAccounts = PromisePay::User()->getListOfPayPalAccounts($createUser['id']);
        
        $this->assertEquals($this->payPalData['paypal_email'], $userPayPalAccounts['paypal']['email']);
    }
    
    public function testSetDisbursementAccount() {
        // First, create the user
        $createUser = PromisePay::User()->create($this->userData);
        
        // Alias newly created user id for the sake of clarity
        $UID = $createUser['id'];
        
        // setDisbursementAccount requires Bank or PayPal account param.
        // We're gonna go for PayPal.
        
        // Update PayPal account data with the id of just created user
        $this->payPalData['user_id'] = $createUser['id'];
        
        // Create a PayPal Account
        $createPayPalAccount = PromisePay::PayPalAccount()->create($this->payPalData);
        
        
        $setDisbursementAccountRequestParams = array(
            'id'         => $UID,
            'account_id' => $createPayPalAccount['id']
        );
        
        $setDisbursementAccount = PromisePay::User()->setDisbursementAccount($UID, $setDisbursementAccountRequestParams);
    }
    
}
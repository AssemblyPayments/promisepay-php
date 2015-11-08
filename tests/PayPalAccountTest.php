<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class PayPalAccountTest extends \PHPUnit_Framework_TestCase {
    
    protected $userId, $payPalData;
    
    public function setUp() {
        $this->userId = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
        $this->payPalData = array(
            'user_id' => $this->userId,
            'paypal_email' => 'test@paypalname.com'
        );
    }

    public function testCreatePaypalAccount() {
        // Create a PayPal Account
        $createPayPalAccount = PromisePay::PayPalAccount()->create($this->payPalData);
        
        $this->assertTrue(array_key_exists('paypal', $createPayPalAccount));
        $this->assertTrue(is_array($createPayPalAccount['paypal']));
        $this->assertEquals($this->payPalData['paypal_email'], $createPayPalAccount['paypal']['email']);
        $this->assertNotNull($createPayPalAccount['created_at']);
    }
    
    public function testGetAccount() {
        // Create a PayPal Account
        $createPayPalAccount = PromisePay::PayPalAccount()->create($this->payPalData);
        
        // Get the PayPal Account
        $getPayPalAccount = PromisePay::PayPalAccount()->get($createPayPalAccount['id']);
        
        $this->assertTrue(array_key_exists('paypal', $createPayPalAccount));
        $this->assertTrue(is_array($createPayPalAccount['paypal']));
        $this->assertEquals($this->payPalData['paypal_email'], $createPayPalAccount['paypal']['email']);
        $this->assertNotNull($createPayPalAccount['created_at']);
    }
    
    
    public function testGetUserForAccount() {
        // Create a PayPal Account
        $createPayPalAccount = PromisePay::PayPalAccount()->create($this->payPalData);
        
        // Get user for account
        $getUser = PromisePay::PayPalAccount()->getUser($createPayPalAccount['id']);
        
        $this->assertEquals($this->userId, $getUser['id']);
    }
    
    
    public function testDeletePayPalAccount() {
        // Create a PayPal Account
        $createPayPalAccount = PromisePay::PayPalAccount()->create($this->payPalData);
        
        // Then, delete it
        $deletePayPalAccount = PromisePay::PayPalAccount()->delete($createPayPalAccount['id']);
        
        $this->assertEquals($deletePayPalAccount, 'Successfully redacted');
    }
    
}
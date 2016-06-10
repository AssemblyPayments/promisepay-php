<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class ChargesTest extends \PHPUnit_Framework_TestCase {
    
    protected $chargeData,
    $bankTest,
    $userTest,
    $userData;
    
    protected function setUp() {
        $this->chargeData = array(
            'account_id' => null,
            'amount' => 100,
            'email' => null,
            'zip' => 90210,
            'country' => 'AUS',
            'device_id' => GUID(),
            'ip_address' => '49.229.186.182'
        );
        
        $this->createBankTestInstance();
        $createBankAccount = $this->bankTest->testCreateBankAccount();
        
        $this->chargeData['account_id'] = $createBankAccount['id'];
        
        $this->userData = PromisePay::User()->show(
            $this->bankTest->getBankAccountUserId()
        );
        
        $this->chargeData['email'] = $this->userData['email'];
    }
    
    protected function createBankTestInstance() {
        require_once __DIR__ . '/BankAccountTest.php';
        
        $this->bankTest = new BankAccountTest;
        $this->bankTest->setUp();
    }
    
    protected function createUserTestInstance() {
        require_once __DIR__ . '/UserTest.php';
        
        $this->userTest = new UserTest;
        $this->userTest->setUp();
    }
    
    protected function createAuthority($accountId, $amount) {
        return PromisePay::DirectDebitAuthority()->create(
            array(
                'account_id' => $accountId,
                'amount' => $amount
            )
        );
    }
    
    public function testCreate() {
        $authority = $this->createAuthority(
            $this->chargeData['account_id'],
            $this->chargeData['amount']
        );
        
        $createCharge = PromisePay::Charges()->create(
            $this->chargeData
        );
        
        $this->assertNotNull($createCharge);
        
        $this->assertEquals(
            $createCharge['buyer_zip'],
            $this->chargeData['zip']
        );
        
        $this->assertEquals(
            $createCharge['amount'],
            $this->chargeData['amount']
        );
        
        $this->assertEquals(
            $createCharge['buyer_email'],
            $this->userData['email']
        );
        
        return $createCharge;
    }
    
    public function testGetList() {
        $createCharge = $this->testCreate();
        
        $getList = PromisePay::Charges()->getList();
        
        $this->assertNotNull($getList);
        
        $chargeFound = false;
        
        foreach ($getList as $charge) {
            if ($charge['id'] == $createCharge['id']) {
                $chargeFound = true;
                
                break;
            }
        }
        
        $this->assertTrue($chargeFound);
    }
    
    public function testShow() {
        $charge = $this->testCreate();
        
        $showCharge = PromisePay::Charges()->show($charge['id']);
        
        $this->assertNotNull($showCharge);
        
        $this->assertEquals(
            $showCharge['buyer_zip'],
            $this->chargeData['zip']
        );
        
        $this->assertEquals(
            $showCharge['amount'],
            $this->chargeData['amount']
        );
        
        $this->assertEquals(
            $showCharge['buyer_email'],
            $this->userData['email']
        );
    }
    /**
     * @group failing
     */
    public function testShowBuyer() {
        $charge = $this->testCreate();
        
        $user = PromisePay::Charges()->showBuyer($charge['id']);
        
        var_dump($user); 
    }
    
    public function testShowStatus() {
        $charge = $this->testCreate();
        
        $status = PromisePay::Charges()->showStatus($charge['id']);
        
        $this->assertNotNull($status);
        $this->assertNotNull($status['state']);
        $this->assertEquals($status['id'], $charge['id']);
    }
    
}

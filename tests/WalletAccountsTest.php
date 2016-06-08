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
    
    protected function regenUserData() {
        $guid = GUID();
        
        $this->userData['id'] = $guid;
        $this->userData['email'] = $guid . '@testing.com';
        $this->userData['mobile'] = $guid . '00012';
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
    
    public function testDeposit() {
        // USING 1 USER, 2 BANK ACCOUNTS AND DIRECT DEBIT AUTHORITY
        $user = $this->createUser();
        
        // add KYC (Know Your Customer) properties
        $user = PromisePay::User()->update(
            $user['id'],
            array(
                'government_number'      => 123456782,
                'phone'                  => '+1234567889',
                'dob'                    => '30/01/1990',
                'drivers_license_number' => '123456789',
                'drivers_license_state'  => 'NSW'
            )
        );
        
        $this->assertNotNull($user);
        
        $bankReceiving = $this->createBankAccount($user['id']);
        $bankSending = $this->createBankAccount($user['id']);
        
        $this->assertNotNull($bankReceiving);
        $this->assertNotNull($bankSending);
        
        $depositAmount = 1000;
        
        $bankSendingAuthority = PromisePay::DirectDebitAuthority()->create(
            array(
                'account_id' => $bankSending['id'],
                'amount'     => $depositAmount
            )
        );
        
        $this->assertNotNull($bankSendingAuthority);
        
        $deposit = PromisePay::WalletAccounts()->deposit(
            $bankReceiving['id'],
            array(
                'account_id' => $bankSending['id'],
                'amount'     => $depositAmount
            )
        );
        
        $this->assertNotNull($deposit);
        
        $this->assertEquals($deposit['amount'], $depositAmount);
        $this->assertEquals($deposit['currency'], $bankReceiving['currency']);
        $this->assertEquals($deposit['to'], 'Bank Account');
        $this->assertEquals($deposit['bank_name'], $bankReceiving['bank']['bank_name']);
        $this->assertEquals($deposit['bank_account_number'], $bankReceiving['bank']['account_number']);
        
        return array(
            'user'                            => $user,
            'bankReceiving'                   => $bankReceiving,
            'bankSending'                     => $bankSending,
            'bankSendingDirectDebitAuthority' => $bankSendingAuthority,
            'deposit'                         => $deposit
        );
    }
    
    public function testWithdrawalToPayPal() {
        extract($this->testDeposit());
        
        // in testDeposit(), money was being sent to receiving bank.
        // now, we're going to withdraw that money to a PayPal account
        $bankWithdrawingFrom = $bankReceiving;
        
        $withdrawalAmount = 100;
        
        $payPalAccount = PromisePay::PayPalAccount()->create(
            array(
                'user_id'      => $user['id'],
                'paypal_email' => $user['email']
            )
        );
        
        $bankWithdrawingFromAuthority = PromisePay::DirectDebitAuthority()->create(
            array(
                'account_id' => $bankWithdrawingFrom['id'],
                'amount'     => $withdrawalAmount
            )
        );
        
        $withdrawal = PromisePay::WalletAccounts()->withdraw(
            $bankWithdrawingFrom['id'],
            array(
                'account_id' => $payPalAccount['id'],
                'amount'     => $withdrawalAmount
            )
        );
        
        $this->assertNotNull($withdrawal);
        $this->assertEquals($withdrawal['amount'], $withdrawalAmount);
        $this->assertEquals(
            trim($withdrawal['to']), // trimming because API currently returns "PayPal Disbursement "
            'PayPal Disbursement'
        );
        $this->assertEquals($withdrawal['paypal_email'], $user['email']);
    }
    /**
     * @group dev
     */
    public function testWithdrawToBankAccount() {
        extract($this->testDeposit());
        
        $withdrawalAmount = 100;
        
        // in testDeposit(), money was being sent to receiving bank.
        // now, we're going to withdraw that money to the bank that sent it.
        $bankWithdrawingFrom = $bankReceiving;
        $bankWithdrawingTo = $bankSending;
        
        $bankWithdrawingFromAuthority = PromisePay::DirectDebitAuthority()->create(
            array(
                'account_id' => $bankWithdrawingFrom['id'],
                'amount'     => $withdrawalAmount
            )
        );
        
        $withdrawal = PromisePay::WalletAccounts()->withdraw(
            $bankWithdrawingFrom['id'],
            array(
                'account_id' => $bankWithdrawingTo['id'],
                'amount'     => $withdrawalAmount
            )
        );
        
        $this->assertNotNull($withdrawal);
        $this->assertEquals($withdrawal['amount'], $withdrawalAmount);
        $this->assertEquals(
            $withdrawal['to'],
            'Bank Account'
        );
        
        $this->assertEquals($withdrawal['bank_name'], $bankWithdrawingTo['bank']['bank_name']);
        $this->assertEquals($withdrawal['bank_account_name'], $bankWithdrawingTo['bank']['account_name']);
        $this->assertEquals($withdrawal['bank_account_number'], $bankWithdrawingTo['bank']['account_number']);
        $this->assertEquals($withdrawal['bank_routing_number'], $bankWithdrawingTo['bank']['routing_number']);
    }
    
    private function readmeExamples() {
        // SHOW
        $wallet = PromisePay::WalletAccounts()->show('WALLET_ID');
        
        // SHOW ACCOUNT USER
        $walletUser = PromisePay::WalletAccounts()->getUser('WALLET_ID');
        
        // DEPOSIT
        // Authorize bank account to be used as a funding source
        $authority = PromisePay::DirectDebitAuthority()->create(
            array(
                'account_id' => 'SOURCE_BANK_ID',
                'amount'     => 100
            )
        );
        
        $deposit = PromisePay::WalletAccounts()->deposit(
            'TARGET_WALLET_ID',
            array(
                'account_id' => 'SOURCE_BANK_ID',
                'amount'     => 100
            )
        );
        
        // WITHDRAW
        // Withdraw to PayPal
        $authority = PromisePay::DirectDebitAuthority()->create(
            array(
                'account_id' => 'SOURCE_BANK_ID',
                'amount'     => 100
            )
        );
        
        $withdrawal = PromisePay::WalletAccounts()->withdraw(
            'SOURCE_BANK_ID',
            array(
                'account_id' => 'PAYPAY_ACCOUNT_ID',
                'amount'     => 100
            )
        );
        
        // Withdraw to Bank Account
            array(
            )
        );
        
        $withdrawal = PromisePay::WalletAccounts()->withdraw(
            array(
                'amount'     => $withdrawalAmount
            )
        );
    }
}
<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class TransactionTest extends \PHPUnit_Framework_TestCase {
    
    protected $transactionId;
    
    public function setUp() {
        $this->transactionId = 'b916bd3e-973e-4274-9b10-1ef1db2b855c';
    }
    
    public function testListTransactions() {
        $getList = PromisePay::Transaction()->getList();
        
        $this->assertTrue(is_array($getList));
        
        foreach ($getList as $transaction) {
            $this->assertNotNull($transaction['id']);
        }
    }
    
    public function testGetById() {
        $getTransaction = PromisePay::Transaction()->get($this->transactionId);
        
        $this->assertTrue(is_array($getTransaction));
        $this->assertEquals($this->transactionId, $getTransaction['id']);
    }
    
    public function testGetUserRelatedToTransaction() {
        $getUser = PromisePay::Transaction()->getUser($this->transactionId);
        
        $this->assertTrue(is_array($getUser));
    }
    
    protected function makePaymentWithFees() {
        require_once __DIR__ . '/ItemTest.php';
        
        $itemTest = new ItemTest;
        
        $itemTest->setUp();
        
        $itemTest->itemData['payment_type'] = 4;
        
        return $itemTest->makePayment();
    }
    
    public function testGetFees() {
        extract($this->makePaymentWithFees());
        
        $itemTransactions = PromisePay::Item()->getListOfTransactions(
            $item['id']
        );
        
        $feeTransactionId = null;
        
        foreach ($itemTransactions as $transaction) {
            if ($transaction['type'] != 'fee') continue;
            
            $feeTransactionId = $transaction['id'];
            
            break;
        }
        
        $getFee = PromisePay::Transaction()->getFee($feeTransactionId);
        
        $this->assertTrue(is_array($getFee));
        $this->assertEquals($getFee['fee_list']['amount'], $fee['amount']);
        $this->assertEquals($getFee['fee_list']['name'], $fee['name']);
    }
    
    public function testGetWalletAccounts() {
        extract($this->makePaymentWithFees());
        
        $itemTransactions = PromisePay::Transaction()->getList(
            array(
                'item_id'                 => $item['id'],
                'transaction_type_method' => 'wallet_account_transfer'
            )
        );
        
        $this->assertTrue(is_array($itemTransactions));
        
        foreach ($itemTransactions as $transaction) {
            if (strpos($transaction['type_method'], 'wallet_account') === false) {
                // the server side of getList() from above currently
                // doesn't filter out as intended, so we're filtering
                // it here manually
                continue;
            }
            
            foreach ($transaction['related']['transactions'] as $transactionMeta) {
                $walletAccounts = PromisePay::Transaction()->getWalletAccount(
                    $transactionMeta['id']
                );
                
                $this->assertNotNull($walletAccounts);
                $this->assertNotNUll($walletAccounts['id']);
                
                $walletAccountsFound = true;
            }
        }
        
        $this->assertTrue($walletAccountsFound);
    }
    /**
     * @group dev
     */
    public function testGetBankAccount() {
        $this->markTestIncomplete();
    }
    
    public function testGetCardAccount() {
        extract($this->makePaymentWithFees());
        
        $itemTransactions = PromisePay::Transaction()->getList(
            array(
                'item_id'                 => $item['id'],
                'transaction_type_method' => 'credit_card'
            )
        );
        
        $this->assertTrue(is_array($itemTransactions));
        
        foreach ($itemTransactions as $transaction) {
            if (strpos($transaction['type_method'], 'credit_card') === false) {
                // the server side of getList() from above currently
                // doesn't filter out as intended, so we're filtering
                // it here manually
                continue;
            }
            
            foreach ($transaction['related']['transactions'] as $transactionMeta) {
                $cardAccounts = PromisePay::Transaction()->getCardAccount(
                    $transactionMeta['id']
                );
                
                $this->assertNotNull($cardAccounts);
                $this->assertNotNUll($cardAccounts['id']);
                $this->assertNotNUll($cardAccounts['card']);
                $this->assertNotNUll($cardAccounts['card']['type']);
                $this->assertNotNUll($cardAccounts['card']['full_name']);
                $this->assertNotNUll($cardAccounts['card']['number']);
                $this->assertNotNUll($cardAccounts['card']['expiry_month']);
                $this->assertNotNUll($cardAccounts['card']['expiry_year']);
                
                $cardAccountsFound = true;
            }
        }
        
        $this->assertTrue($cardAccountsFound);
    }
    
    public function testGetPayPalAccount() {
        $this->markTestIncomplete();
    }
    
}
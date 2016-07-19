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
        
        $transaction = PromisePay::Transaction()->get($getList[0]['id']);
        
        $this->assertEquals($getList[0]['id'], $transaction['id']);
        
        foreach ($getList as $transaction) {
            $this->assertNotNull($transaction['id']);
        }
    }
    
    /**
     * @group filters-type
     */
    public function testListTransactionsWithFilterTransactionType() {
        // transaction type => payment
        $getList = $getListPayment = PromisePay::Transaction()->getList(
            array(
                'transaction_type' => 'payment'
            )
        );
        
        foreach ($getList as $transaction) {
            $this->assertEquals($transaction['type'], 'payment');
        }
        
        // transaction type => refund
        $getList = PromisePay::Transaction()->getList(
            array(
                'transaction_type' => 'refund'
            )
        );
        
        foreach ($getList as $transaction) {
            $this->assertEquals($transaction['type'], 'refund');
        }
        
        // transaction type => disbursement
        $getList = PromisePay::Transaction()->getList(
            array(
                'transaction_type' => 'disbursement'
            )
        );
        
        foreach ($getList as $transaction) {
            $this->assertEquals($transaction['type'], 'disbursement');
        }
        
        // transaction type => fee
        $getList = PromisePay::Transaction()->getList(
            array(
                'transaction_type' => 'fee'
            )
        );
        
        foreach ($getList as $transaction) {
            $this->assertEquals($transaction['type'], 'fee');
        }
        
        // transaction type => deposit
        $getList = PromisePay::Transaction()->getList(
            array(
                'transaction_type' => 'deposit'
            )
        );
        
        foreach ($getList as $transaction) {
            // this doesn't work as one might think:
            // $this->assertEquals($transaction['type'], 'deposit');
            // instead, checking for:
            $this->assertEquals($transaction['type'], 'payment');
            $this->assertEquals($transaction['type_method'], 'credit_card');
        }
        
        // transaction type => withdrawal
        $getList = PromisePay::Transaction()->getList(
            array(
                'transaction_type' => 'withdrawal'
            )
        );
        
        foreach ($getList as $transaction) {
            // this doesn't work as intended
            // $this->assertEquals($transaction['type'], 'withdrawal');
            
            // TODO
            // PLACEHOLDER
        }
        
        $this->markTestIncomplete();
    }
    
    /**
     * @group filters-type-method
     */
    public function testListTransactionsWithFilterTransactionTypeMethod() {
        // transaction_type_method => credit_card
        $getList = PromisePay::Transaction()->getList(
            array(
                'transaction_type_method' => 'credit_card'
            )
        );
        
        foreach ($getList as $transaction) {
            $this->assertEquals($transaction['type_method'], 'credit_card');
        }
        
        // transaction_type_method => wire_transfer
        $getList = PromisePay::Transaction()->getList(
            array(
                'transaction_type_method' => 'wire_transfer'
            )
        );
        
        // TODO
        // at the moment $getList returns NULL, so we'll do a bit of typecasting
        // to avoid warnings
        foreach ((array) $getList as $transaction) {
            $this->assertEquals($transaction['type_method'], 'wire_transfer');
        }
        
        // transaction_type_method => wallet_account_transfer
        $getList = PromisePay::Transaction()->getList(
            array(
                'transaction_type_method' => 'wallet_account_transfer'
            )
        );
        
        foreach ($getList as $transaction) {
            $this->assertTrue(
                $transaction['type_method'] == 'wallet_account'
                ||
                $transaction['account_type'] == 'wallet_account'
                ||
                (
                    isset($transaction['related']['transactions'][0]['account_type'])
                    &&
                    $transaction['related']['transactions'][0]['account_type'] == 'wallet_account'
                )
            );
        }
        
        $this->markTestIncomplete(); // because of wire_transfer case
    }
    
    /**
     * @group filters-direction
     */
    public function testListTransactionsWithFilterDirection() {
        // direction => debit
        $getList = PromisePay::Transaction()->getList(
            array(
                'direction' => 'debit'
            )
        );
        
        foreach ($getList as $transaction) {
            $this->assertEquals($transaction['debit_credit'], 'debit');
        }
        
        // direction => credit
        $getList = PromisePay::Transaction()->getList(
            array(
                'direction' => 'credit'
            )
        );
        
        foreach ($getList as $transaction) {
            $this->assertEquals($transaction['debit_credit'], 'credit');
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
    
    protected function makePaymentWithFees($fundingMethod = 'card') {
        require_once __DIR__ . '/ItemTest.php';
        
        $itemTest = new ItemTest;
        
        $itemTest->setUp();
        
        $itemTest->itemData['payment_type'] = 4;
        
        return $itemTest->makePayment($fundingMethod);
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
     * @group charge
     */
    public function testGetChargeBankAccount() {
        $this->markTestIncomplete();
        
        $buyerId = "fdf58725-96bd-4bf8-b5e6-9b61be20662e";
        $sellerId = "ec9bf096-c505-4bef-87f6-18822b9dbf2c";
        
        $buyer = PromisePay::User()->get($buyerId);
        
        $buyerBank = PromisePay::User()->getBankAccount(
            $buyerId
        );
        
        $charge = PromisePay::Charges()->create(array(
            'account_id' => $buyerBank['id'],
            'amount' => 1000,
            'email' => $buyer['email'],
            'zip' => 3000,
            'country' => $buyer['location'],
            'currency' => 'AUD',
            'retain_account' => true
        ));
        
        // $charge['state'] is "payment_pending". not good.
    }
    
    /**
     * @group bank
     * @group failing
     */
    public function testGetBankAccount() {
        // create Item
        $itemData = array(
            "id"              => GUID(),
            "name"            => 'Item #12893489',
            "amount"          => 1000,
            "payment_type"    => 2,
            "buyer_id"        => "ec9bf096-c505-4bef-87f6-18822b9dbf2c",
            "seller_id"       => "fdf58725-96bd-4bf8-b5e6-9b61be20662e",
            "description"     => "This is item's description."
        );
        
        require_once __DIR__ . '/BankAccountTest.php';
        
        $bankAccount = new BankAccountTest;
        $bankAccount->setUp();
        
        // CREATE BANK ACCOUNT FOR BUYER
        $bankAccount->setBankAccountUserId($itemData['buyer_id']);
        $buyerBankAccount = $bankAccount->testCreateBankAccount();
        
        // CREATE BANK ACCOUNT FOR SELLER
        $bankAccount->setBankAccountUserId($itemData['seller_id']);
        $buyerBankAccount = $bankAccount->testCreateBankAccount();
        
        $buyerBank = PromisePay::User()->getBankAccount(
            $itemData['buyer_id']
        );
        
        $sellerBank = PromisePay::User()->getBankAccount(
            $itemData['seller_id']
        );
        
        $item = PromisePay::Item()->create($itemData);
        
        // create authority
        $directDebitAUthority = PromisePay::DirectDebitAuthority()->create(
            array(
                'account_id' => $buyerBank['id'],
                'amount' => $itemData['amount']
            )
        );
        
        // request payment
        $requestPayment = PromisePay::Item()->requestPayment(
            $item['id']
        );
        
        // acknowledge wire
        $ackWire = PromisePay::Item()->acknowledgeWire($item['id']);
        
        // pay for item
        $makePayment = PromisePay::Item()->makePayment(
            $item['id'],
            array(
                'account_id' => $buyerBank['id']
            )
        );
        
        // this is weird:
        // $makePayment["payment_method"]=>string(7) "pending"
        // shouldn't it be bank account?
        // also
        // $makePayment['state'] is payment_pending, instead of completed
        
        $wireDetails = PromisePay::Item()->getWireDetails($item['id']);
        $this->assertNotNull($wireDetails);
        
        //$releasePayment = PromisePay::Item()->releasePayment(
        //    $item['id']
        //);
        // yields Error Message: item: action is invalid, state transition invalid
        
        /*
            1) PromisePay\Tests\TransactionTest::testGetBankAccount
            PromisePay\Exception\Unauthorized:
            Response Code: 401
            Error Message: not_authorized: to access that record
        */
        
        $this->markTestSkipped();
        
        // $transactionBankAccount = PromisePay::Transaction()->getBankAccount($makePayment['id']);
        // Error Message: not_authorized: to access that record
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
    /**
     * @group paypal
     * @group failing
     */
    public function testGetPayPalTransaction() {
        $this->markTestIncomplete();
        
        require_once __DIR__ . '/WalletAccountsTest.php';
        
        $wallet = new WalletAccountsTest;
        $wallet->setUp();
        
        extract($wallet->testWithdrawalToPayPal());
        
        $total = null;
        $offset = 0;
        $types = array();
        
        do {
            $disbursements = PromisePay::Transaction()->getList(array(
                'limit' => 200,
                'offset' => $offset,
                'transaction_type' => 'withdrawal'
            ));
            
            foreach ($disbursements as $disbursement) {
                $types[] = $disbursement['account_type'];
                
                if (strpos($disbursement['description'], 'paypal') !== false) {
                    fwrite(STDOUT, 'PAYPAL DETECTED: ' . print_r($disbursement, true));
                    break;
                }
            }
            
            fwrite(STDOUT, print_r(array_unique($types), true));
            fwrite(STDOUT, PHP_EOL . sprintf('%d/%d', $offset, $total) . PHP_EOL . PHP_EOL);
            
            if ($total === null) {
                $meta = PromisePay::getMeta();
                $total = $meta['total'];
            }
            
            $offset += 200;
        } while ($total > $offset);
    }
    
    private function readmeExamples() {
        $walletAccount = PromisePay::Transaction()->getWalletAccount(
            'TRANSACTION_ID'
        );
        
        $cardAccount = PromisePay::Transaction()->getCardAccount(
            'TRANSACTION_ID'
        );
    }
    
}
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
    /**
     * @group show-transaction-details
     */
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
     */
    public function testGetBankAccount() {
        // create Item
        $itemData = array(
            "id"              => GUID(),
            "name"            => 'Item #12893489',
            "amount"          => 1000,
            "payment_type"    => 2,
            "buyer_id"        => "fdf58725-96bd-4bf8-b5e6-9b61be20662e",
            "seller_id"       => "ec9bf096-c505-4bef-87f6-18822b9dbf2c",
            "description"     => "This is item's description."
        );
        
        $buyerBank = PromisePay::User()->getBankAccount(
            $itemData['buyer_id']
        );
        
        $sellerBank = PromisePay::User()->getBankAccount(
            $itemData['seller_id']
        );
        
        // DEBUG/EXPERIMENTAL: maybe seller needs a PP disbursement account?
        PromisePay::PayPalAccount()->create(array(
            'user_id' => $itemData['seller_id'],
            'paypal_email' => $itemData['seller_id'] . '@paypal.com'
        ));
        
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
        
        $wireDetails = PromisePay::Item()->getWireDetails($item['id']);
        $this->assertNotNull($wireDetails); // this passes
        
        print_r($makePayment); // state is payment_pending, instead of completed
        
        $itemTransactions = PromisePay::Transaction()->getList(
            array(
                'limit' => 200,
                'item_id' => $item['id']
            )
        );
        
        var_dump($itemTransactions); // yields NULL instead of array
        
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
    /**
     * @group paypal
     */
    public function testGetPayPalTransaction() {
        require_once __DIR__ . '/WalletAccountsTest.php';
        
        $wallet = new WalletAccountsTest;
        $wallet->setUp();
        
        extract($wallet->testWithdrawalToPayPal());
        
        $total = null;
        $offset = 0;
        $types = [];
        
        do {
            $disbursements = PromisePay::Transaction()->getList(array(
                'limit' => 200,
                'offset' => $offset,
                'transaction_type' => 'withdrawal'
            ));
            
            foreach ($disbursements as $disbursement) {
                $types[] = $disbursement['account_type'];
                
                if (strpos($disbursement['description'], 'paypal') !== false) {
                    var_dump($disbursement, "paypal detected");
                    break;
                }
            }
            
            fwrite(STDOUT, print_r(array_unique($types), true));
            fwrite(STDOUT, PHP_EOL . sprintf('%d/%d', $offset, $total) . PHP_EOL . PHP_EOL);
            
            if ($total === null) {
                $total = PromisePay::getMeta()['total'];
            }
            
            $offset += 200;
        } while ($total > $offset);
        
        $this->markTestIncomplete();
    }
    
}
<?php
namespace PromisePay;

class TransactionTest extends \PHPUnit_Framework_TestCase {
	
	public function setUp() {
		require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'init.php');
	}

    public function testListTransactionsSuccessful() {
        $repo = new TransactionRepository();
        $transactions = $repo->getListOfTransactions(200);

        $this->assertNotNull($transactions);
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testListTransactionsNegativeParams() {
            $repo = new TransactionRepository();
            $repo->getListOfTransactions(-10, -20);
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testListTransactionsTooHighLimit() {
        $repo = new TransactionRepository();
        $repo->getListOfTransactions(201);
    }
	
}
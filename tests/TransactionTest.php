<?php
/**
 * Created by PhpStorm.
 * User: Web_den
 * Date: 11.06.2015
 * Time: 17:47
 */

namespace PromisePay;

include_once '../init.php';
include_once 'GUID.php';

class TransactionTest extends \PHPUnit_Framework_TestCase {

    public function testListTransactionsSuccessful()
    {
        $repo = new TransactionRepository();
        $transactions = $repo->getListOfTransactions(200);

        $this->assertNotNull($transactions);
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testListTransactionsNegativeParams()
    {
            $repo = new TransactionRepository();
            $repo->getListOfTransactions(-10, -20);
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testListTransactionsTooHighLimit()
    {
        $repo = new TransactionRepository();
        $repo->getListOfTransactions(201);
    }
}
 
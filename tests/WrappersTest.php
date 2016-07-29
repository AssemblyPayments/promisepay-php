<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class WrappersTest extends \PHPUnit_Framework_TestCase {
    
    public function testGetAllResultsForFees() {
        $feesList = PromisePay::getAllResults(function($limit, $offset) {
            return PromisePay::Fee()->getList(
                array(
                    'limit' => $limit,
                    'offset' => $offset
                )
            );
        });
        
        foreach ($feesList as $fee) {
            $this->assertNotNull($fee['id']);
            $this->assertArrayHasKey('fee_type_id', $fee);
            $this->assertArrayHasKey('amount', $fee);
            $this->assertArrayHasKey('cap', $fee);
            $this->assertArrayHasKey('min', $fee);
            $this->assertArrayHasKey('max', $fee);
            $this->assertArrayHasKey('to', $fee);
        }
    }
    
    public function testGetAllResultsForItems() {
        
    }
    
}
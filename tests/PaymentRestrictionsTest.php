<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class PaymentRestrictionsTest extends \PHPUnit_Framework_TestCase {

    public function testGetList() {
        $list = PromisePay::PaymentRestrictions()->getList();

        $meta = PromisePay::getMeta();

        if ($meta['total'] === 0) {
            $this->assertEmpty($list);

            return;
        }

        $this->assertTrue(is_array($list));
        $this->assertTrue(count($list) <= $meta['limit']);
    }

    public function testGet() {
        //PromisePay::PaymentRestrictions()->get();
    }

}
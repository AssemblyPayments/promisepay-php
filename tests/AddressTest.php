<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class AddressTest extends \PHPUnit_Framework_TestCase {

    public function testGetAddressByIdSuccessfully() {
        $getAddress = PromisePay::getAddressById('07ed45e5-bb9d-459f-bb7b-a02ecb38f443');
        
        $this->assertEquals('07ed45e5-bb9d-459f-bb7b-a02ecb38f443', $getAddress['id']);
    }
    
}

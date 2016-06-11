<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

class AddressTest extends \PHPUnit_Framework_TestCase {
    
    protected $addressId;
    
    public function setUp() {
        $this->addressId = '07ed45e5-bb9d-459f-bb7b-a02ecb38f443';
    }

    public function testGetAddressById() {
        $getAddress = PromisePay::Address()->get($this->addressId);
        
        $this->assertEquals($this->addressId, $getAddress['id']);
    }
    
    private function readmeExamples() {
        $address = PromisePay::Address()->get('ADDRESS_ID');
    }
    
}

<?php
namespace PromisePay;

class AddressTest extends \PHPUnit_Framework_TestCase {
	
	public function setUp() {
		require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'init.php');
	}

    public function testGetAddressByIdSuccessfully() {
        $address = new AddressRepository();
        $get = $address->getAddressById('07ed45e5-bb9d-459f-bb7b-a02ecb38f443');
        $this->assertEquals('07ed45e5-bb9d-459f-bb7b-a02ecb38f443', $get->getId());
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testGetAddressByIdMissedId() {
        $address = new AddressRepository();
        $address->getAddressById('');
    }
	
}
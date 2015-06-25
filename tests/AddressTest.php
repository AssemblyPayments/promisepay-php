<?php
/**
 * Created by PhpStorm.
 * User: Web_den
 * Date: 11.06.2015
 * Time: 17:43
 */
namespace PromisePay;
include_once '../init.php';
include_once 'GUID.php';

class AddressTest extends \PHPUnit_Framework_TestCase {

    public function testGetAddressByIdSuccessfully()
    {
        $address = new AddressRepository();
        $get = $address->getAddressById('07ed45e5-bb9d-459f-bb7b-a02ecb38f443');
        $this->assertEquals('07ed45e5-bb9d-459f-bb7b-a02ecb38f443', $get->getId());
    }

    /**
     * @expectedException PromisePay\Exception\Argument
     */
    public function testGetAddressByIdMissedId()
    {
        $address = new AddressRepository();
        $missed = '';
        $address->getAddressById($missed);

    }
}
 
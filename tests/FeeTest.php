<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;
use PromisePay\Enum\FeeType;

class FeeTest extends \PHPUnit_Framework_TestCase {
    
    protected $enum, $GUID, $feeData;
    
    public function setUp() {
        $this->enum = new FeeType;
        $this->GUID = GUID();
        
        $this->feeData = array(
            'id'          => $this->GUID,
            'amount'      => 1000,
            'name'        => 'fee test',
            'fee_type_id' => (string) $this->enum->Fixed,
            'cap'         => '1',
            'max'         => '3',
            'min'         => '2',
            'to'          => 'buyer'
        );
    }
    
    public function testCreateFee() {
        $createFee = PromisePay::createFee($this->feeData);
        
        $this->assertNotNull($createFee['id']);
        $this->assertEquals($createFee['name'], $this->feeData['name']);
    }
    
    /**
     * @expectedException PromisePay\Exception\Unauthorized
     */
    public function testCreateFeeWrongTo() {
        $data = $this->feeData;
        $data['to'] = 'test';
        
        $createFee = PromisePay::createFee($data);
        
        $this->assertNotNull($createFee);
    }

    public function testGetFeeById() {
        $id  = '79116c9f-d750-4faa-85c7-b7da36f23b38';
        $getFeeById = PromisePay::getFeeById($id);
        
        $this->assertNotNull($getFeeById['id']);
        $this->assertEquals($id, $getFeeById['id']);
    }

    public function testListSuccessfull() {
        $this->assertTrue(is_array(PromisePay::getListOfFees()));
    }

}
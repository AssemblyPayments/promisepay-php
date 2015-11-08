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
        $createFee = PromisePay::Fee()->create($this->feeData);
        
        $this->assertNotNull($createFee['id']);
        $this->assertEquals($createFee['name'], $this->feeData['name']);
    }
    
    /**
     * @expectedException PromisePay\Exception\Unauthorized
     */
    public function testCreateFeeWrongTo() {
        $data = $this->feeData;
        $data['to'] = 'test';
        
        $createFee = PromisePay::Fee()->create($data);
        
        $this->assertNotNull($createFee);
    }

    public function testGetFeeById() {
        $createFee = PromisePay::Fee()->create($this->feeData);
        
        $this->assertNotNull($createFee['id']);
        $this->assertEquals($createFee['name'], $this->feeData['name']);
        
        $getFeeById = PromisePay::Fee()->get($createFee['id']);
        
        $this->assertNotNull($getFeeById['id']);
        $this->assertEquals($createFee['id'], $getFeeById['id']);
        $this->assertEquals($createFee['name'], $getFeeById['name']);
    }

    public function testList() {
        $this->feeData['name'] = 'Fee Test Fee Test 123456';
        
        $createFee = PromisePay::Fee()->create($this->feeData);
        
        $getList = PromisePay::Fee()->getList(200);
        
        $this->assertTrue(in_array($createFee, $getList));
    }

}
<?php



namespace PromisePay;


use PromisePay\DataObjects\Fee;
use PromisePay\Enum\FeeType;
include_once __DIR__ . '/../init.php';
include_once 'GUID.php';
class FeeTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFeeSuccessfully()
    {
        $enum = new FeeType();
        $id = GUID();
        $repo = new FeeRepository();
        $data = array(
            'id'=>$id,
            'amount'=>1000,
            'name'=>'fee test',
            'fee_type'=>$enum->Fixed,
            'cap'=>'1',
            'max'=>'3',
            'min'=>'2',
            'to'=>'buyer'
        );
        $fee = new Fee($data);
        $this->assertNotNull($repo->createFee($fee));
    }

    /**
     * @expectedException PromisePay\Exception\Validation
     */
    public function testCreateFeeWrongTo()
    {
        $enum = new FeeType();
        $id = GUID();
        $repo = new FeeRepository();
        $data = array(
            'id'=>$id,
            'amount'=>1000,
            'name'=>'fee test2',
            'fee_type'=>$enum->Fixed,
            'cap'=>'1',
            'max'=>'3',
            'min'=>'2',
        );
        $fee = new Fee($data);
        $repo->createFee($fee);
    }

    public function testGetFeeByIdSuccessfull()
    {
        $repo = new FeeRepository();
        $id  = '79116c9f-d750-4faa-85c7-b7da36f23b38';
        $this->assertNotNull($repo->getFeeById($id));
    }

    public function testListSuccessfull()
    {
        $repo = new FeeRepository();
        $this->assertNotNull($repo->getListOfFees());
    }
}
 
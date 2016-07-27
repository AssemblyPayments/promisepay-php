<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class CompanyTest extends \PHPUnit_Framework_TestCase {
    
    protected $userId, $companyId, $companyInfo;
    
    public function setUp() {
        $this->userId = 'ec9bf096-c505-4bef-87f6-18822b9dbf2c';
        $this->companyId = 'e466dfb4-f05c-4c7f-92a3-09a0a28c7af5';
        $this->companyInfo = array(
            'user_id'    => $this->userId,
            'legal_name' => 'Test edit company',
            'name'       => 'test company name edit',
            'country'    => 'AUS'
        );
    }
    
    /**
     * @group backend-issues
     */
    public function testListOfCompanies() {
        try {
            $companiesList = PromisePay::Company()->getList(
                array(
                    'limit' => 2,
                    'offset' => 0
                )
            );
            
            $this->assertNotEmpty($companiesList);
            $this->assertTrue(is_array($companiesList));
            $this->assertTrue(count($companiesList) > 0);
            $this->assertNotNull($companiesList[0]['id']);
        } catch (\PromisePay\Exception\Api $e) {
            $meta = PromisePay::getDebugData();
            
            // server usually responds with 504 on this test
            $this->assertEquals(
                substr($meta->code, 0, 1),
                '5'
            );
            
            $this->markTestIncomplete();
        }
    }

    public function testGetCompanyById() {
        $companyData = PromisePay::Company()->get($this->companyId);
        
        $this->assertEquals($this->companyId, $companyData['id']);
    }
    
    public function testCreateCompany() {
        $companyCreate = PromisePay::Company()->create($this->companyInfo);
        
        $this->assertNotNull($companyCreate['id']);
    }

    public function testEditCompany() {
        $this->companyInfo['name'] = 'Modified company name';
        
        $companyUpdate = PromisePay::Company()->update($this->companyId, $this->companyInfo);
        
        $this->assertEquals($this->companyInfo['legal_name'], $companyUpdate['legal_name']);
        $this->assertEquals($this->companyInfo['name'], $companyUpdate['name']);
    }

}
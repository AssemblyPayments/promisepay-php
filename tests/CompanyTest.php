<?php
namespace PromisePay\Tests;
use PromisePay\CompanyRepository;

class CompanyTest extends \PHPUnit_Framework_TestCase {
    
    protected $instance, $userId, $companyId, $companyInfo;
    
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
    
    public function testListOfCompanies() {
        $companiesList = CompanyRepository::getListOfCompanies();
        
        $this->assertNotEmpty($companiesList);
        $this->assertTrue(is_array($companiesList));
        $this->assertTrue(count($companiesList) > 0);
        $this->assertNotNull($companiesList[0]['id']);
    }

    public function testGetCompanyByIdSuccessfully() {
        $companyData = CompanyRepository::getCompanyById($this->companyId);
        
        $this->assertEquals($this->companyId, $companyData['id']);
    }
    
    public function testCreateCompanySuccessfully() {
        $companyCreate = CompanyRepository::createCompany($this->companyInfo);
        
        $this->assertNotNull($companyCreate['id']);
    }

    public function testEditCompanySuccessfully() {
        $this->companyInfo['name'] = 'Modified company name';
        
        $companyUpdate = CompanyRepository::updateCompany($this->companyId, $this->companyInfo);
        
        $this->assertEquals($this->companyInfo['legal_name'], $companyUpdate['legal_name']);
        $this->assertEquals($this->companyInfo['name'], $companyUpdate['name']);
    }

}
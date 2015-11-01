<?php
namespace PromisePay;
use PromisePay\DataObjects\Company;

class CompanyTest extends \PHPUnit_Framework_TestCase {
    
    public function setUp() {
        require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'init.php');
    }
    
    public function testListOfCompanies() {
        $repo = new CompanyRepository();
        $this->assertNotEmpty($repo->getListOfCompanies());
    }

    public function testGetCompanyByIdSuccessfully() {
        $id = 'e466dfb4-f05c-4c7f-92a3-09a0a28c7af5';
        $repo = new CompanyRepository();
        $this->assertNotEmpty($repo->getCompanyById($id));
    }

    public function testEditCompanySuccessfully() {
        $repo = new CompanyRepository();
        
        $params = array(
            'id'         => '739dcfc5-adf0-4a00-b639-b4e05922994d',
            'legal_name' => 'Test edit company',
            'name'       => 'test company name edit',
            'country'    => 'AUS'
        );
        
        $editPayload = new Company($params);
        
        $edit = $repo->updateCompany($editPayload, $params['id']);
        $this->assertEquals($edit->getLegalName(), $editPayload->getLegalName());
    }

}
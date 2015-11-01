<?php
namespace PromisePay;

use PromisePay\DataObjects\Company;
use PromisePay\Exception;
use PromisePay\Log;

/**
 * Class CompanyRepository
 *
 * @package PromisePay
 */
class CompanyRepository extends BaseRepository {
    /**
     * Accepts two params - amount of entities to list,
     * and listing starting point (offset).
     * Returns Company object.
     *
     * @param int $limit
     * @param int $offset
     * @return Company
     */
    public function getListOfCompanies($limit = 20, $offset = 0) {
        $this->paramsListCorrect($limit, $offset);
        $response = $this->RestClient('get', 'companies?limit=' . $limit . '&offset=' . $offset, '', '');
        $companiesList = array();
        $jsonData = json_decode($response->raw_body, true)['companies'];
        foreach($jsonData as $company)
        {
            $company = new Company($company);
            array_push($companiesList, $company);
        }
        return $companiesList;
    }
    
    /**
     * List a single company for a legal entity.
     * Expects company ID parameter (in form of "ec9bf096-c505-4bef-87f6-18822b9dbf2c").
     *
     * @param string $id
     * @return Company|null
     */
    public function getCompanyById($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'companies/' . $id);
        $jsonData = json_decode($response->raw_body, true);
        if (array_key_exists("companies", $jsonData))
        {
            $company = new Company($jsonData['companies']);
            return $company;
        }
        return null;
    }
    
    /**
     * Creates a new company.
     * Expects Company object and company id (in form of "ec9bf096-c505-4bef-87f6-18822b9dbf2c").
     *
     * @param Company $company
     * @param string $id
     * @return object
     */
    public function createCompany(Company $company, $id)
    {
        $this->checkIdNotNull($id);
        $payload = '';

        $preparePayload = array(
            "user_id" =>$id,
            "name"=>$company->getName(),
            "legal_name"=>$company->getLegalName(),
            "tax_number"=>$company->getTaxNumber(),
            "charge_tax"=>$company->getChargeTax(),
            "address_line1"=>$company->getAddressLine1(),
            "address_line2"=>$company->getAddressLine2(),
            "city"=>$company->getCity(),
            "state"=>$company->getState(),
            "zip"=>$company->getZip(),
            "country"=>$company->getCountry(),
        );
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $response = $this->RestClient('post', 'companies/'.$id , $payload);
        return $response;
    }
    
    /**
     * Update existing company.
     * Expects Company object and company id (in form of "ec9bf096-c505-4bef-87f6-18822b9dbf2c").
     *
     * @param Company $company
     * @param string $id
     * @return Company|null
     */
    public function updateCompany(Company $company, $id) {
        $this->checkIdNotNull($id);
        $payload='';
        
        $preparePayload = array(
            "user_id" => $id,
            "name" => $company->getName(),
            "legal_name"=>$company->getLegalName(),
            "tax_number"=>$company->getTaxNumber(),
            "charge_tax"=>$company->getChargeTax(),
            "address_line1"=>$company->getAddressLine1(),
            "address_line2"=>$company->getAddressLine2(),
            "city"=>$company->getCity(),
            "state"=>$company->getState(),
            "zip"=>$company->getZip(),
            "country"=>$company->getCountry(),
        );
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $payload = substr($payload,0,-1);
        
        $response = $this->RestClient('patch', 'companies/'. $id, $payload);
        $jsonData = json_decode($response->raw_body, true);

        if (array_key_exists("companies", $jsonData))
        {
            $jsonData = $jsonData["companies"];
            $company = new Company($jsonData);
            return $company;
        }
        return null;
    }
}
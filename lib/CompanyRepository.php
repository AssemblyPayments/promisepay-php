<?php
namespace PromisePay;

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
     * @return array
     */
    public static function getListOfCompanies($limit = 20, $offset = 0) {
        parent::paramsListCorrect($limit, $offset);
        
        $requestParams = array(
            'limit' => $limit,
            'offset' => $offset
        );
        
        $response = parent::RestClient('get', 'companies/', $requestParams);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        /*
            Even though $companyList[] creates the array automatically, in case there's no 
            companies returned, returning non-existent $companyList would trigger a PHP notice
        */
        $companyList = array(); 
        
        foreach ($jsonDecodedResponse['companies'] as $company) {
            $companyList[] = $company;
        }
        
        return $companyList;
    }

    /**
     * List a single company for a legal entity.
     * Expects company ID parameter (in form of "ec9bf096-c505-4bef-87f6-18822b9dbf2c").
     *
     * @param string $id
     * @return array
     */
    public static function getCompanyById($id) {
        parent::checkIdNotNull($id);
        
        $response = parent::RestClient('get', 'companies/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['companies'];
    }

    /**
     * Creates a new company.
     * Expects Company object and company id (in form of "ec9bf096-c505-4bef-87f6-18822b9dbf2c").
     *
     * @param Company $company
     * @param string $id
     * @return array
     */
    public static function createCompany($companyData) {
        $response = parent::RestClient('post', 'companies/', $companyData);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['companies'];
    }

    /**
     * Update existing company.
     * Expects Company object and company id (in form of "ec9bf096-c505-4bef-87f6-18822b9dbf2c").
     *
     * @param Company $company
     * @param string $id
     * @return array
     */
    public static function updateCompany($id, $companyData) {
        parent::checkIdNotNull($id);

        $response = parent::RestClient('patch', 'companies/' . $id, $companyData);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['companies'];
    }
}
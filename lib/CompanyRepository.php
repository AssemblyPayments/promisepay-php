<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

/**
 * Class CompanyRepository
 *
 * @package PromisePay
 */
class CompanyRepository {
    
    /**
     * Accepts two params - amount of entities to list,
     * and listing starting point (offset).
     * Returns Company object.
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public static function getList($params = null) {
        $response = PromisePay::RestClient('get', 'companies/', $params);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['companies'];
    }

    /**
     * List a single company for a legal entity.
     * Expects company ID parameter (in form of "ec9bf096-c505-4bef-87f6-18822b9dbf2c").
     *
     * @param string $id
     * @return array
     */
    public static function get($id) {
        $response = PromisePay::RestClient('get', 'companies/' . $id);
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
    public static function create($params) {
        $response = PromisePay::RestClient('post', 'companies/', $params);
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
    public static function update($id, $params) {
        $response = PromisePay::RestClient('patch', 'companies/' . $id, $params);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['companies'];
    }
}
<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

/**
 * Class CompanyRepository
 *
 * @package PromisePay
 */
class Company {
    
    /**
     * Gets a list of companies.
     *
     * @param array|string $params
     * 
     * @return array
     */
    public static function getList($params = array('limit' => 200, 'offset' => 0)) {
        PromisePay::RestClient('get', 'companies/', $params);
        
        return PromisePay::getDecodedResponse('companies');
    }

    /**
     * List a single company for a legal entity.
     * Expects company ID parameter (in form of "ec9bf096-c505-4bef-87f6-18822b9dbf2c").
     *
     * @param string $id
     *
     * @return array
     */
    public static function get($id) {
        PromisePay::RestClient('get', 'companies/' . $id);
        
        return PromisePay::getDecodedResponse('companies');
    }

    /**
     * Creates a new company.
     *
     * @param array|string $params
     *
     * @return array
     */
    public static function create($params) {
        PromisePay::RestClient('post', 'companies/', $params);
        
        return PromisePay::getDecodedResponse('companies');
    }

    /**
     * Update existing company.
     *
     * @param string $id
     * @param array|string $params
     *
     * @return array
     */
    public static function update($id, $params) {
        PromisePay::RestClient('patch', 'companies/' . $id, $params);
        
        return PromisePay::getDecodedResponse('companies');
    }
}
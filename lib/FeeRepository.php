<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class FeeRepository {
    
    public static function getList($limit = 20, $offset = 0) {
        PromisePay::paramsListCorrect($limit, $offset);
        
        $requestParams = array(
            'limit' => $limit,
            'offset' => $offset
        );
        
        $response = PromisePay::RestClient('get', 'fees/', $requestParams);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['fees'];
    }
    
    public static function get($id) {
        PromisePay::checkIdNotNull($id);
        
        $response = PromisePay::RestClient('get', 'fees/' . $id);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['fees'];
    }
    
    public static function create($params) {
        $response = PromisePay::RestClient('post', 'fees/', $params);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['fees'];
    }
}

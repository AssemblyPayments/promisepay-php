<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class FeeRepository extends BaseRepository {
    
    public static function getListOfFees() {
        $response = parent::RestClient('get', 'fees/');
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['fees'];
    }
    
    public static function getFeeById($id) {
        $response = parent::RestClient('get', 'fees/' . $id);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['fees'];
    }
    
    public static function createFee($params) {
        $response = parent::RestClient('post', 'fees/', $params);
        $jsonDecodedResponse = json_decode($response, true);
        
        return $jsonDecodedResponse['fees'];
    }
}
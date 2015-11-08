<?php
namespace PromisePay;

use PromisePay\PromisePay;
use PromisePay\Exception;
use PromisePay\Log;

class UserRepository {
    
    public static function create($params)
    {
        self::validateUser($params);
        
        $response = PromisePay::RestClient('post', 'users/', $params);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['users'];
    }
    
    public static function get($id)
    {
        PromisePay::checkIdNotNull($id);
        
        $response = PromisePay::RestClient('get', 'users/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['users'];
    }
    
    public static function getList($limit = 20, $offset = 0)
    {
        PromisePay::paramsListCorrect($limit, $offset);
        
        $params = array(
            'limit' => $limit,
            'offset' => $offset
        );
        
        $response = PromisePay::RestClient('get', 'users/', $params);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['users'];
    }
    
    public static function update($id, $params)
    {
        PromisePay::checkIdNotNull($id);
        self::validateUser($params);
        
        $response = PromisePay::RestClient('patch', 'users/' . $id . "/", $params);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['users'];
    }

    public static function sendMobilePin($id)
    {
        PromisePay::checkIdNotNull($id);
        
        $response = PromisePay::RestClient('post', '/users/' . $id . '/mobile_pin');
        return json_decode($response->raw_body, true);
    }

    public static function getListOfItems($id)
    {
        PromisePay::checkIdNotNull($id);
        
        $response = PromisePay::RestClient('get', 'users/' . $id . '/items');
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['items'];
    }

    public static function getListOfBankAccounts($id)
    {
        PromisePay::checkIdNotNull($id);
        
        $response = PromisePay::RestClient('get', 'users/' . $id . '/bank_accounts');
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['bank_accounts'];
    }

    public static function getListOfCardAccounts($id)
    {
        PromisePay::checkIdNotNull($id);
        
        $response = PromisePay::RestClient('get', 'users/' . $id . '/card_accounts');
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['card_accounts'];
    }

    public static function getListOfPayPalAccounts($id)
    {
        PromisePay::checkIdNotNull($id);
        
        $response = PromisePay::RestClient('get', 'users/' . $id . '/paypal_accounts');
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['paypal_accounts'];
    }

    public static function setDisbursementAccount($id, $params)
    {
        PromisePay::checkIdNotNull($id);
        
        $response = PromisePay::RestClient('post', 'users/' . $id . '/disbursement_account', $params);
        return json_decode($response->raw_body, true);
    }
    
    private static function validateUser($userData) {
        if (empty($userData['id'])) {
            throw new Exception\Validation('Field User.ID should not be empty.');
        }
        if (empty($userData['first_name'])) {
            throw new Exception\Validation('Field User.FirstName should not be empty.');
        }
        if (!self::isCorrectCountryCode($userData['country'])) {
            throw new Exception\Validation('Field User.Country should contain a 3-letter ISO country code.');
        }
        if (!self::isCorrectEmail($userData['email'])) {
            throw new Exception\Validation('Field User.Email is invalid.');
        }
    }
    
    private static function isCorrectEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } 
        else {
            return true;
        }
    }
    
    private static function isCorrectCountryCode($country) {
        $allowedCountryCodes = array("AFG", "ALA", "ALB", "DZA", "ASM", "AND", "AGO", "AIA", "ATA", "ATG", "ARG", "ARM", "ABW", "AUS", "AUT", "AZE", "BHS", "BHR", "BGD", "BRB", "BLR", "BEL", "BLZ", "BEN", "BMU", "BTN", "BOL", "BIH", "BWA", "BVT", "BRA", "VGB", "IOT", "BRN", "BGR", "BFA", "BDI", "KHM", "CMR", "CAN", "CPV", "CYM", "CAF", "TCD", "CHL", "CHN", "HKG", "MAC", "CXR", "CCK", "COL", "COM", "COG", "COD", "COK", "CRI", "CIV", "HRV", "CUB", "CYP", "CZE", "DNK", "DJI", "DMA", "DOM", "ECU", "EGY", "SLV", "GNQ", "ERI", "EST", "ETH", "FLK", "FRO", "FJI", "FIN", "FRA", "GUF", "PYF", "ATF", "GAB", "GMB", "GEO", "DEU", "GHA", "GIB", "GRC", "GRL", "GRD", "GLP", "GUM", "GTM", "GGY", "GIN", "GNB", "GUY", "HTI", "HMD", "VAT", "HND", "HUN", "ISL", "IND", "IDN", "IRN", "IRQ", "IRL", "IMN", "ISR", "ITA", "JAM", "JPN", "JEY", "JOR", "KAZ", "KEN", "KIR", "PRK", "KOR", "KWT", "KGZ", "LAO", "LVA", "LBN", "LSO", "LBR", "LBY", "LIE", "LTU", "LUX", "MKD", "MDG", "MWI", "MYS", "MDV", "MLI", "MLT", "MHL", "MTQ", "MRT", "MUS", "MYT", "MEX", "FSM", "MDA", "MCO", "MNG", "MNE", "MSR", "MAR", "MOZ", "MMR", "NAM", "NRU", "NPL", "NLD", "ANT", "NCL", "NZL", "NIC", "NER", "NGA", "NIU", "NFK", "MNP", "NOR", "OMN", "PAK", "PLW", "PSE", "PAN", "PNG", "PRY", "PER", "PHL", "PCN", "POL", "PRT", "PRI", "QAT", "REU", "ROU", "RUS", "RWA", "BLM", "SHN", "KNA", "LCA", "MAF", "SPM", "VCT", "WSM", "SMR", "STP", "SAU", "SEN", "SRB", "SYC", "SLE", "SGP", "SVK", "SVN", "SLB", "SOM", "ZAF", "SGS", "SSD", "ESP", "LKA", "SDN", "SUR", "SJM", "SWZ", "SWE", "CHE", "SYR", "TWN", "TJK", "TZA", "THA", "TLS", "TGO", "TKL", "TON", "TTO", "TUN", "TUR", "TKM", "TCA", "TUV", "UGA", "UKR", "ARE", "GBR", "USA", "UMI", "URY", "UZB", "VUT", "VEN", "VNM", "VIR", "WLF", "ESH", "YEM", "ZMB", "ZWE");
        
        if (!in_array($country, $allowedCountryCodes)) {
            return false;
        } 
        else {
            return true;
        }
        
    }
    
}

<?php
namespace PromisePay;

use PromisePay\DataObjects\BankAccount;
use PromisePay\DataObjects\CardAccount;
use PromisePay\DataObjects\Errors;
use PromisePay\DataObjects\Item;
use PromisePay\DataObjects\PayPalAccount;
use PromisePay\DataObjects\User;
use PromisePay\Exception;
use PromisePay\Log;

class UserRepository extends ApiAbstract
{
    
    public function getListOfUsers($limit = 20, $offset = 0) {
        $this->paramsListCorrect($limit, $offset);
        $response = $this->RestClient('get', 'users?limit=' . $limit . '&offset=' . $offset, '', '');
        $allUsers = array();
        $jsonData = json_decode($response->raw_body, true) ['users'];
        foreach ($jsonData as $oneUser) {
            $user = new User($oneUser);
            array_push($allUsers, $user);
        }
        return $allUsers;
    }
    
    public function getUserById($id) {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'users/' . $id);
        $jsonData = json_decode($response->raw_body, true);
        if (array_key_exists('users', $jsonData)) {
            $user = new User($jsonData['users']);
            return $user;
        } 
        else {
            return null;
        }
    }
    
    public function createUser(User $user) {
        $this->validateUser($user);
        $payload = '';
        $preparePayload = array("id" => $user->getId(), "first_name" => $user->getFirstName(), "last_name" => $user->getLastName(), "email" => $user->getEmail(), "mobile" => $user->getMobile(), "address_line1" => $user->getAddressLine1(), "address_line2" => $user->getAddressLine2(), "state" => $user->getState(), "city" => $user->getCity(), "zip" => $user->getZip(), "country" => $user->getCountry(),);
        foreach ($preparePayload as $key => $value) {
            $payload.= $key . '=';
            $payload.= urlencode($value);
            $payload.= "&";
        }
        
        $response = $this->RestClient('post', 'users/', $payload, '');
        $jsonRaw = json_decode($response->raw_body, true);
        if (array_key_exists("errors", $jsonRaw)) {
            $errors = new Errors($jsonRaw);
            return $errors;
        } 
        else {
            $jsonData = json_decode($response->raw_body, true) ['users'];
            $user = new User($jsonData);
            return $user;
        }
    }
    
    public function deleteUser($id) {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('delete', 'users/' . $id);
        if ($response->code) {
            return false;
        } 
        else {
            return true;
        }
    }
    
    public function sendMobilePin($id) {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('post', '/users/' . $id . '/mobile_pin');
        $jsonRaw = json_decode($response->raw_body, true);
    }
    
    public function getListOfItemsForUser($id) {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'users/' . $id . '/items');
        $jsonData = json_decode($response->raw_body, true);
        $listItems = array();
        if (array_key_exists('items', $jsonData)) {
            foreach ($jsonData['items'] as $part) {
                $Item = new Item($part);
                array_push($listItems, $Item);
            }
            return $listItems;
        } 
        else {
            return null;
        }
    }
    
    public function getListOfCardAccountsForUser($id) {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'users/' . $id . '/card_accounts');
        $jsonData = json_decode($response->raw_body, true);
        
        // var_dump($jsonData);
        if (array_key_exists('card_accounts', $jsonData)) {
            $accounts = new CardAccount($jsonData['card_accounts']);
            return $accounts;
        } 
        else {
            return null;
        }
    }
    
    public function getListOfPayPalAccountsForUser($id) {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'users/' . $id . '/paypal_accounts');
        $jsonData = $jsonData = json_decode($response->raw_body, true);
        
        // var_dump($jsonData);
        if (array_key_exists('paypal_accounts', $jsonData)) {
            $accounts = new PayPalAccount($jsonData['paypal_accounts']);
            return $accounts;
        } 
        else {
            return null;
        }
    }
    
    public function getListOfBankAccountsForUser($id) {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'users/' . $id . '/bank_accounts');
        $jsonData = json_decode($response->raw_body, true);
        
        // var_dump($jsonData);
        if (array_key_exists('bank_accounts', $jsonData)) {
            $jsonData = $jsonData['bank_accounts'];
            var_dump($jsonData);
            $bankAccounts = new BankAccount($jsonData);
            return $bankAccounts;
        } 
        else {
            return null;
        }
    }
    
    public function setDisbursementAccount($id, $accountId) {
        
        //throw new \Exception('no fields for this method');
        
        $this->checkIdNotNull($id);
        $this->checkIdNotNull($accountId);
        
        $payload = '';
        $preparePayload = array("account_id" => $accountId);
        array_shift($preparePayload);
        foreach ($preparePayload as $key => $value) {
            $payload.= $key . '=';
            $payload.= urlencode($value);
            $payload.= "&";
        }
        
        $response = $this->RestClient('post', 'users/' . $id . '/disbursement_account', $payload);
        if ($response->code) {
            return false;
        } 
        else {
            return true;
        }
    }
    
    public function updateUser(User $user) {
        $this->validateUser($user);
        
        $payload = '';
        $preparePayload = array("id" => $user->getId(), "first_name" => $user->getFirstName(), "last_name" => $user->getLastName(), "email" => $user->getEmail(), "mobile" => $user->getMobile(), "address_line1" => $user->getAddressLine1(), "address_line2" => $user->getAddressLine2(), "state" => $user->getState(), "city" => $user->getCity(), "zip" => $user->getZip(), "country" => $user->getCountry());
        array_shift($preparePayload);
        foreach ($preparePayload as $key => $value) {
            $payload.= $key . '=';
            $payload.= urlencode($value);
            $payload.= "&";
        }
        
        $response = $this->RestClient('patch', 'users/' . $user->getId(), $payload);
        $jsonData = json_decode($response->raw_body, true);
        
        if (array_key_exists("users", $jsonData)) {
            $user = new User($jsonData['users']);
            return $user;
        } 
        else {
            $errors = new Errors(get_object_vars($response->body->errors));
            return $errors;
        }
    }
    
    private function validateUser($user) {
        if ($user->getId() == null) {
            throw new Exception\Validation('Field User.ID should not be empty');
        }
        if ($user->getFirstName() == null) {
            throw new Exception\Validation('Field User.ID should not be empty');
        }
        if ($this->isCorrectCountryCode($user->getCountry()) != true) {
            throw new Exception\Validation('Field Country should contain 3-letter ISO country code!');
        }
        if ($this->isCorrectEmail($user->getEmail()) != true) {
            throw new Exception\Validation('Incorrect email address');
        }
    }
    
    private function isCorrectEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } 
        else {
            return true;
        }
    }
    
    private function isCorrectCountryCode($Country) {
        $allowedCountryCode = array("AFG", "ALA", "ALB", "DZA", "ASM", "AND", "AGO", "AIA", "ATA", "ATG", "ARG", "ARM", "ABW", "AUS", "AUT", "AZE", "BHS", "BHR", "BGD", "BRB", "BLR", "BEL", "BLZ", "BEN", "BMU", "BTN", "BOL", "BIH", "BWA", "BVT", "BRA", "VGB", "IOT", "BRN", "BGR", "BFA", "BDI", "KHM", "CMR", "CAN", "CPV", "CYM", "CAF", "TCD", "CHL", "CHN", "HKG", "MAC", "CXR", "CCK", "COL", "COM", "COG", "COD", "COK", "CRI", "CIV", "HRV", "CUB", "CYP", "CZE", "DNK", "DJI", "DMA", "DOM", "ECU", "EGY", "SLV", "GNQ", "ERI", "EST", "ETH", "FLK", "FRO", "FJI", "FIN", "FRA", "GUF", "PYF", "ATF", "GAB", "GMB", "GEO", "DEU", "GHA", "GIB", "GRC", "GRL", "GRD", "GLP", "GUM", "GTM", "GGY", "GIN", "GNB", "GUY", "HTI", "HMD", "VAT", "HND", "HUN", "ISL", "IND", "IDN", "IRN", "IRQ", "IRL", "IMN", "ISR", "ITA", "JAM", "JPN", "JEY", "JOR", "KAZ", "KEN", "KIR", "PRK", "KOR", "KWT", "KGZ", "LAO", "LVA", "LBN", "LSO", "LBR", "LBY", "LIE", "LTU", "LUX", "MKD", "MDG", "MWI", "MYS", "MDV", "MLI", "MLT", "MHL", "MTQ", "MRT", "MUS", "MYT", "MEX", "FSM", "MDA", "MCO", "MNG", "MNE", "MSR", "MAR", "MOZ", "MMR", "NAM", "NRU", "NPL", "NLD", "ANT", "NCL", "NZL", "NIC", "NER", "NGA", "NIU", "NFK", "MNP", "NOR", "OMN", "PAK", "PLW", "PSE", "PAN", "PNG", "PRY", "PER", "PHL", "PCN", "POL", "PRT", "PRI", "QAT", "REU", "ROU", "RUS", "RWA", "BLM", "SHN", "KNA", "LCA", "MAF", "SPM", "VCT", "WSM", "SMR", "STP", "SAU", "SEN", "SRB", "SYC", "SLE", "SGP", "SVK", "SVN", "SLB", "SOM", "ZAF", "SGS", "SSD", "ESP", "LKA", "SDN", "SUR", "SJM", "SWZ", "SWE", "CHE", "SYR", "TWN", "TJK", "TZA", "THA", "TLS", "TGO", "TKL", "TON", "TTO", "TUN", "TUR", "TKM", "TCA", "TUV", "UGA", "UKR", "ARE", "GBR", "USA", "UMI", "URY", "UZB", "VUT", "VEN", "VNM", "VIR", "WLF", "ESH", "YEM", "ZMB", "ZWE");
        if (!in_array($Country, $allowedCountryCode)) {
            return false;
        } 
        else {
            return true;
        }
    }
}

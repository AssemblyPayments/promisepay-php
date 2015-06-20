<?php
namespace PromisePay;

use PromisePay\DataObjects\Errors;
use PromisePay\DataObjects\User;
use PromisePay\Exception;
use PromisePay\Log;


class UserRepository extends ApiAbstract
{

    public function getListOfUsers($limit = 20, $offset = 0)
    {
        $this->paramsListCorrect($limit,$offset);
        $response = $this->RestClient('get', 'users?limit=' . $limit . '&offset=' . $offset, '', '');
        $allUsers = array();
        $jsonData = json_decode($response->raw_body, true)['users'];
        foreach($jsonData as $oneUser )
        {
            $user = new User($oneUser);
            array_push($allUsers, $user);
        }
        return $allUsers;
    }

    public function getUserById($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'users/' . $id);
        $jsonData = json_decode($response->raw_body, true)['users'];
        $user = new User($jsonData);
        return $user;
    }

    public function createUser(User $user)
    {
        $this->validateUser($user);
        //$mime = 'multipart/form-data';
        $payload = '';
        $preparePayload = array(
                "id"            => $user->getId(),
                "first_name"    => $user->getFirstName(),
                "last_name"     => $user->getLastName(),
                "email"         => $user->getEmail(),
                "mobile"        => $user->getMobile(),
                "address_line1" => $user->getAddressLine1(),
                "address_line2" => $user->getAddressLine2(),
                "state"         => $user->getState(),
                "city"          => $user->getCity(),
                "zip"           => $user->getZip(),
                "country"       => $user->getCountry(),
            );
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }

        $response = $this->RestClient('post', 'users/', $payload, '');

        if($response->body->errors)
        {
            $errors = new Errors(get_object_vars($response->body->errors));
            return $errors;
        }
        else
        {
            return $response->body->users;
        }

    }

    public function deleteUser($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('delete', 'users/'.$id);
        return json_decode($response->raw_body, true)['users'];
    }

    public function sendMobilePin()
    {

    }

    public function getListOfItemsForUsers()
    {

    }

    public function getListOfPayPalAccountsForUser()
    {

    }

    public function getListOfBankAccountsForUser()
    {

    }

    public function getDisbursementAccount()
    {

    }

    public function updateUser($id)
    {

    }

    private function validateUser($user)
    {
        if($user->getId() == null)
        {
            throw new Exception\Validation('Field User.ID should not be empty');
        }
        if($user->getFirstName() == null)
        {
            throw new Exception\Validation('Field User.ID should not be empty');
        }
        if($this->isCorrectCountryCode($user->getCountry()) != true)
        {
            throw new Exception\Validation('Field Country should contain 3-letter ISO country code!');
        }
        if($this->isCorrectEmail($user->getEmail()) != true)
        {
            throw new Exception\Validation('Incorrect email address');
        }

    }

    private function isCorrectEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    private function isCorrectCountryCode($Country)
    {
        $allowedCountryCode = array(
            "AFG", "ALA", "ALB", "DZA", "ASM", "AND", "AGO", "AIA", "ATA",
            "ATG", "ARG", "ARM", "ABW", "AUS", "AUT", "AZE", "BHS", "BHR",
            "BGD", "BRB", "BLR", "BEL", "BLZ", "BEN", "BMU", "BTN", "BOL",
            "BIH", "BWA", "BVT", "BRA", "VGB", "IOT", "BRN", "BGR", "BFA",
            "BDI", "KHM", "CMR", "CAN", "CPV", "CYM", "CAF", "TCD", "CHL",
            "CHN", "HKG", "MAC", "CXR", "CCK", "COL", "COM", "COG", "COD",
            "COK", "CRI", "CIV", "HRV", "CUB", "CYP", "CZE", "DNK", "DJI",
            "DMA", "DOM", "ECU", "EGY", "SLV", "GNQ", "ERI", "EST", "ETH",
            "FLK", "FRO", "FJI", "FIN", "FRA", "GUF", "PYF", "ATF", "GAB",
            "GMB", "GEO", "DEU", "GHA", "GIB", "GRC", "GRL", "GRD", "GLP",
            "GUM", "GTM", "GGY", "GIN", "GNB", "GUY", "HTI", "HMD", "VAT",
            "HND", "HUN", "ISL", "IND", "IDN", "IRN", "IRQ", "IRL", "IMN",
            "ISR", "ITA", "JAM", "JPN", "JEY", "JOR", "KAZ", "KEN", "KIR",
            "PRK", "KOR", "KWT", "KGZ", "LAO", "LVA", "LBN", "LSO", "LBR",
            "LBY", "LIE", "LTU", "LUX", "MKD", "MDG", "MWI", "MYS", "MDV",
            "MLI", "MLT", "MHL", "MTQ", "MRT", "MUS", "MYT", "MEX", "FSM",
            "MDA", "MCO", "MNG", "MNE", "MSR", "MAR", "MOZ", "MMR", "NAM",
            "NRU", "NPL", "NLD", "ANT", "NCL", "NZL", "NIC", "NER", "NGA",
            "NIU", "NFK", "MNP", "NOR", "OMN", "PAK", "PLW", "PSE", "PAN",
            "PNG", "PRY", "PER", "PHL", "PCN", "POL", "PRT", "PRI", "QAT",
            "REU", "ROU", "RUS", "RWA", "BLM", "SHN", "KNA", "LCA", "MAF",
            "SPM", "VCT", "WSM", "SMR", "STP", "SAU", "SEN", "SRB", "SYC",
            "SLE", "SGP", "SVK", "SVN", "SLB", "SOM", "ZAF", "SGS", "SSD",
            "ESP", "LKA", "SDN", "SUR", "SJM", "SWZ", "SWE", "CHE", "SYR",
            "TWN", "TJK", "TZA", "THA", "TLS", "TGO", "TKL", "TON", "TTO",
            "TUN", "TUR", "TKM", "TCA", "TUV", "UGA", "UKR", "ARE", "GBR",
            "USA", "UMI", "URY", "UZB", "VUT", "VEN", "VNM", "VIR", "WLF",
            "ESH", "YEM", "ZMB", "ZWE");
        if (!in_array($Country, $allowedCountryCode))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

}
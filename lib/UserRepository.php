<?php
namespace PromisePay;

use Httpful\Request;
use PromisePay\Exception;
use PromisePay\Log;

use PromisePay\DataObjects\User;


class UserRepository extends ApiAbstract
{
    const ENTITY = 'users';

    public function getListOfUsers($limit = 20, $offset = 0)
    {
        $this->paramsListCorrect($limit,$offset);
        $response = $this->RestClient('get', 'users/', '', '');
        return $response->body->users;
    }

    public function getUserById($id)
    {

    }

    public function createUser($user)
    {
        $entity = 'users/';
        $mime = 'multipart/form-data';
        $payload = '';
        foreach ($user as $key => $value)
        {
            $payload .= $key . '=';
        $payload .= urlencode($value);
        $payload .= "&";
        }
        $response = $this->RestClient('post', $entity, $payload, $mime);
        return $response;
    }

    public function deleteUser($id)
    {
        Request::delete($this->baseUrl().self::ENTITY.$id)->send();
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

    public function validateUser($user)
    {
        if($user->id == null)
        {
            throw new Exception\Validation('Field User.ID should not be empty');
        }
        if($user->FirstName == null)
        {
            throw new Exception\Validation('Field User.ID should not be empty');
        }
        if($this->isCorrectCountryCode($user->_country) != true)
        {
            throw new Exception\Validation('Field Country should contain 3-letter ISO country code!');
        }
        if($this->isCorrectEmail($user->_email) != true)
        {
            throw new Exception\Validation('Incorrect email address');
        }

    }

    public function isCorrectEmail($email)
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

    public function isCorrectCountryCode($Country)
    {
        $allowedCountryCode = array("AFG", "ALA", "ALB", "DZA", "ASM", "AND", "AGO", "AIA", "ATA", "ATG", "ARG", "ARM", "ABW", "AUS", "AUT", "AZE", "BHS", "BHR", "BGD", "BRB", "BLR", "BEL", "BLZ", "BEN", "BMU", "BTN", "BOL", "BIH", "BWA", "BVT", "BRA", "VGB", "IOT", "BRN", "BGR", "BFA", "BDI", "KHM", "CMR", "CAN", "CPV", "CYM", "CAF", "TCD", "CHL", "CHN", "HKG", "MAC", "CXR", "CCK", "COL", "COM", "COG", "COD", "COK", "CRI", "CIV", "HRV", "CUB", "CYP", "CZE", "DNK", "DJI", "DMA", "DOM", "ECU", "EGY", "SLV", "GNQ", "ERI", "EST", "ETH", "FLK", "FRO", "FJI", "FIN", "FRA", "GUF", "PYF", "ATF", "GAB", "GMB", "GEO", "DEU", "GHA", "GIB", "GRC", "GRL", "GRD", "GLP", "GUM", "GTM", "GGY", "GIN", "GNB", "GUY", "HTI", "HMD", "VAT", "HND", "HUN", "ISL", "IND", "IDN", "IRN", "IRQ", "IRL", "IMN", "ISR", "ITA", "JAM", "JPN", "JEY", "JOR", "KAZ", "KEN", "KIR", "PRK", "KOR", "KWT", "KGZ", "LAO", "LVA", "LBN", "LSO", "LBR", "LBY", "LIE", "LTU", "LUX", "MKD", "MDG", "MWI", "MYS", "MDV", "MLI", "MLT", "MHL", "MTQ", "MRT", "MUS", "MYT", "MEX", "FSM", "MDA", "MCO", "MNG", "MNE", "MSR", "MAR", "MOZ", "MMR", "NAM", "NRU", "NPL", "NLD", "ANT", "NCL", "NZL", "NIC", "NER", "NGA", "NIU", "NFK", "MNP", "NOR", "OMN", "PAK", "PLW", "PSE", "PAN", "PNG", "PRY", "PER", "PHL", "PCN", "POL", "PRT", "PRI", "QAT", "REU", "ROU", "RUS", "RWA", "BLM", "SHN", "KNA", "LCA", "MAF", "SPM", "VCT", "WSM", "SMR", "STP", "SAU", "SEN", "SRB", "SYC", "SLE", "SGP", "SVK", "SVN", "SLB", "SOM", "ZAF", "SGS", "SSD", "ESP", "LKA", "SDN", "SUR", "SJM", "SWZ", "SWE", "CHE", "SYR", "TWN", "TJK", "TZA", "THA", "TLS", "TGO", "TKL", "TON", "TTO", "TUN", "TUR", "TKM", "TCA", "TUV", "UGA", "UKR", "ARE", "GBR", "USA", "UMI", "URY", "UZB", "VUT", "VEN", "VNM", "VIR", "WLF", "ESH", "YEM", "ZMB", "ZWE");
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
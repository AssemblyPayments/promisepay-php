<?php
namespace PromisePay;

use PromisePay\DataObjects\Company;
use PromisePay\Exception;
use PromisePay\Log;

class CompanyRepository extends ApiAbstract
{
    public function getListOfCompanies($limit = 20, $offset = 0)
    {
        $this->paramsListCorrect($limit,$offset);
        $response = $this->RestClient('get', 'companies?limit=' . $limit . '&offset=' . $offset, '', '');
        $companiesList = array();
        $jsonData = json_decode($response->raw_body, true)['companies'];
        foreach($jsonData as $company )
        {
           $company = new Company($company);
            array_push($companiesList, $company);
        }
        return $companiesList;
    }

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

    public function createCompany(Company $company, $id)
    {
        $this->checkIdNotNull($id);
        $payload = '';

        $preparePayload = array(
            "id" =>$id,
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


    public function editCompany(Company $company)
    {

        $payload='';
        $preparePayload = array(
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
        $response = $this->RestClient('patch', 'companies/'.$company->getId().'?', $payload);
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
<?php
namespace PromisePay;

use PromisePay\DataObjects\Fee;
use PromisePay\Exception;
use PromisePay\Log;

class FeeRepository extends ApiAbstract
{
    public function getListOfFees($limit = 20, $offset = 0)
    {
        $this->paramsListCorrect($limit,$offset);
        $response = $this->RestClient('get', 'fees?limit=' . $limit . '&offset=' . $offset, '', '');
        $allFees = array();
        $jsonData = json_decode($response->raw_body, true)['fees'];
        foreach($jsonData as $onefee )
        {
            $fee = new Fee($onefee);
            array_push($allFees, $fee);
        }
        return $allFees;
    }

    public function getFeeById($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get', 'fees/' . $id);
        $jsonData = json_decode($response->raw_body, true)['fees'];
        $fee = new Fee($jsonData);
        return $fee;
    }
///fees?name&fee_type_id&amount&cap&min&max&to
    public function createFee(Fee $fee)
    {
        $this->ValidateFee($fee);
        $payload = '';
        $preparePayload = array(
            "name"        => $fee->getName(),
            "fee_type_id" => $fee->getId(),//or getFeeType()
            "amount"      => $fee->getAmount(),
            "cap"         => $fee->getCap(),
            "min"         => $fee->getMin(),
            "max"         => $fee->getMax(),
            "to"          => $fee->getTo(),
        );
        foreach ($preparePayload as $key => $value)
        {
            $payload .= $key . '=';
            $payload .= urlencode($value);
            $payload .= "&";
        }
        $response = $this->RestClient('post', 'fees/', $payload, '');
        return $response;
    }

    public function ValidateFee(Fee $fee)
    {
        if ($fee == null)
        {
            throw new Exception\Argument ('fee is empty');
        }

    }
}
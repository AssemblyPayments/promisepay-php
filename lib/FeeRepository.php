<?php
namespace PromisePay;

use PromisePay\DataObjects\Fee;
use PromisePay\DataObjects\Errors;

use PromisePay\Exception;
use PromisePay\Log;

class FeeRepository extends BaseRepository
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
        $jsonData = json_decode($response->raw_body, true);
        if(array_key_exists("errors", $jsonData))
        {
            $errors = new Errors($jsonData);
            return $errors;
        }
        else
        {
            $jsonData = $jsonData['fees'];
            $fee = new Fee($jsonData);
            return $fee;
        }
    }

    public function ValidateFee(Fee $fee)
    {
        if ($fee == null)
        {
            throw new Exception\Argument ('fee is empty');
        }
        if (!in_array($fee->getTo(), $this->possibleTos()))
        {
            throw new Exception\Validation ("To should have value of \"buyer\", \"seller\", \"cc\", \"int_wire\", \"paypal_payout\"");
        }

    }

    private function possibleTos()
    {
        $possibilities  = array(
            "buyer", "seller", "cc", "int_wire", "paypal_payout",
        );
        return $possibilities;
    }
}
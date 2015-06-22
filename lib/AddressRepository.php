<?php
namespace PromisePay;

use PromisePay\DataObjects\Address;
use PromisePay\Exception;
use PromisePay\Log;


class AddressRepository extends ApiAbstract
{
    public function getAddressById($id)
    {
        $this->checkIdNotNull($id);
        $response = $this->RestClient('get','addresses/'.$id);
        $jsonData = json_decode($response->raw_body, true)['addresses'];
        $address = new Address($jsonData);
        return $address;
    }
}
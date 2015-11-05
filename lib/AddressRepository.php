<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class AddressRepository extends BaseRepository
{
    public static function getAddressById($id)
    {
        $response = parent::RestClient('get', 'addresses/' . $id);
        $jsonDecodedResponse = json_decode($response->raw_body, true);
        
        return $jsonDecodedResponse['addresses'];
    }
}
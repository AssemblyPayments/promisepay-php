<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;


class AddressRepository extends BaseRepository
{
    public function getAddressById($id)
    {
        $response = $this->RestClient('get', 'addresses/' . $id);
        return json_decode($response->raw_body, true);
    }
}
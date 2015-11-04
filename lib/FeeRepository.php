<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class FeeRepository extends BaseRepository
{
    public function getListOfFees($params)
    {
        $response = $this->RestClient('get', 'fees/', $params);
        return json_decode($response->raw_body, true);
    }

    public function getFeeById($id)
    {
        $response = $this->RestClient('get', 'fees/' . $id);
        return json_decode($response->raw_body, true);
    }

    public function createFee($params)
    {
        $response = $this->RestClient('post', 'fees/', $params);
        return json_decode($response->raw_body, true);
    }
}
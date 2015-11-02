<?php
namespace PromisePay;

use PromisePay\Exception;
use PromisePay\Log;

class FeeRepository extends BaseRepository
{
    public function getListOfFees($params)
    {
        $response = $this->RestClient('get', 'fees/', $this->generate_payload($params));
        return $this->generate_response($response);
    }

    public function getFeeById($id)
    {
        $response = $this->RestClient('get', 'fees/' . $id);
        return $this->generate_response($response);
    }

    public function createFee($params)
    {
        $response = $this->RestClient('post', 'fees/', $this->generate_payload($params));
        return $this->generate_response($response);
    }
}
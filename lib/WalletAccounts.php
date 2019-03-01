<?php

namespace PromisePay;

class WalletAccounts
{
    /**
     * @param $id
     * @return array|mixed|null
     * @throws Exception\Api
     * @throws Exception\ApiUnsupportedRequestMethod
     * @throws Exception\NotFound
     * @throws Exception\Unauthorized
     */
    public function get($id)
    {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id);

        return PromisePay::getDecodedResponse('wallet_accounts');
    }

    /**
     * @param $id
     * @return array|mixed|null
     * @throws Exception\Api
     * @throws Exception\ApiUnsupportedRequestMethod
     * @throws Exception\NotFound
     * @throws Exception\Unauthorized
     */
    public function show($id)
    {
        return $this->get($id);
    }

    /**
     * @param $id
     * @param $params
     * @return array|mixed|null
     * @throws Exception\Api
     * @throws Exception\ApiUnsupportedRequestMethod
     * @throws Exception\NotFound
     * @throws Exception\Unauthorized
     */
    public function withdraw($id, $params)
    {
        PromisePay::RestClient('post', 'wallet_accounts/' . $id . '/withdraw', $params);

        return PromisePay::getDecodedResponse('disbursements');
    }

    /**
     * @param $id
     * @param $params
     * @return array|mixed|null
     * @throws Exception\Api
     * @throws Exception\ApiUnsupportedRequestMethod
     * @throws Exception\NotFound
     * @throws Exception\Unauthorized
     */
    public function deposit($id, $params)
    {
        PromisePay::RestClient('post', 'wallet_accounts/' . $id . '/deposit', $params);

        return PromisePay::getDecodedResponse('disbursements');
    }

    /**
     * @param $id
     * @return array|mixed|null
     * @throws Exception\Api
     * @throws Exception\ApiUnsupportedRequestMethod
     * @throws Exception\NotFound
     * @throws Exception\Unauthorized
     */
    public function getUser($id)
    {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id . '/users');

        return PromisePay::getDecodedResponse('users');
    }

    /**
     * @param $id
     * @return array|mixed|null
     * @throws Exception\Api
     * @throws Exception\ApiUnsupportedRequestMethod
     * @throws Exception\NotFound
     * @throws Exception\Unauthorized
     */
    public function getBpayDetails($id) {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id . '/bpay_details');

        return PromisePay::getDecodedResponse('wallet_accounts');
    }

    /**
     * @param $id
     * @return array|mixed|null
     * @throws Exception\Api
     * @throws Exception\ApiUnsupportedRequestMethod
     * @throws Exception\NotFound
     * @throws Exception\Unauthorized
     */
    public function getNppDetails($id) {
        PromisePay::RestClient('get', 'wallet_accounts/' . $id . '/npp_details');

        return PromisePay::getDecodedResponse('wallet_accounts');
    }
}
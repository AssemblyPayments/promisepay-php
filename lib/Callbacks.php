<?php
namespace PromisePay;

class Callbacks {
    public function create($params) {
        PromisePay::RestClient('POST', __CLASS__, $params);

        return PromisePay::getDecodedResponse(__CLASS__);
    }

    public function getList($params = null) {
        PromisePay::RestClient('GET', __CLASS__, $params);

        return PromisePay::getDecodedResponse(__CLASS__);
    }

    public function get($callbackId) {
        PromisePay::RestClient('GET', __CLASS__ . '/' . $callbackId);

        return PromisePay::getDecodedResponse(__CLASS__);
    }

    public function update($params) {
        PromisePay::RestClient('PATCH', __CLASS__, $params);

        return PromisePay::getDecodedResponse(__CLASS__);
    }

    public function delete($callbackId) {
        PromisePay::RestClient('DELETE', __CLASS__, $callbackId);

        return PromisePay::getDecodedResponse(__CLASS__);
    }

    public function getResponses($callbackId) {
        PromisePay::RestClient('GET', __CLASS__ . '/' . $callbackId . '/responses');

        return PromisePay::getDecodedResponse(__CLASS__ . '_responses');
    }

    public function getResponse($callbackId, $responseId) {
        PromisePay::RestClient('GET', __CLASS__ . '/' . $callbackId . '/responses/' . $responseId);

        return PromisePay::getDecodedResponse(__CLASS__ . '_responses');
    }
}
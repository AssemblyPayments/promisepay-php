<?php
namespace PromisePay;

class Callbacks {
    const ENDPOINT = 'callbacks';
    const RESPONSES_INDEX = 'callback_responses';

    public function create($params) {
        PromisePay::RestClient('POST', self::ENDPOINT, $params);

        return PromisePay::getDecodedResponse(self::ENDPOINT);
    }

    public function getList($params = null) {
        PromisePay::RestClient('GET', self::ENDPOINT, $params);

        return PromisePay::getDecodedResponse(self::ENDPOINT);
    }

    public function get($callbackId) {
        PromisePay::RestClient('GET', self::ENDPOINT . '/' . $callbackId);

        return PromisePay::getDecodedResponse(self::ENDPOINT);
    }

    public function update($callbackId, $params) {
        PromisePay::RestClient('PATCH', self::ENDPOINT . '/' . $callbackId, $params);

        return PromisePay::getDecodedResponse(self::ENDPOINT);
    }

    public function delete($callbackId) {
        PromisePay::RestClient('DELETE', self::ENDPOINT . '/' . $callbackId);

        return PromisePay::getDecodedResponse(self::ENDPOINT);
    }

    public function getListResponses($callbackId) {
        PromisePay::RestClient('GET', self::ENDPOINT . '/' . $callbackId . '/responses');

        return PromisePay::getDecodedResponse(self::RESPONSES_INDEX);
    }

    public function getResponse($callbackId, $responseId) {
        PromisePay::RestClient('GET', self::ENDPOINT . '/' . $callbackId . '/responses/' . $responseId);

        return PromisePay::getDecodedResponse(self::RESPONSES_INDEX);
    }
}
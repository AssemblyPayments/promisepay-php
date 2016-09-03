<?php
namespace PromisePay;

class Configurations {
    public function create($params) {
        PromisePay::RestClient('post', 'configurations/', $params);
        
        return PromisePay::getDecodedResponse('feature_configurations');
    }

    public function get($id) {
        PromisePay::RestClient('get', 'configurations/' . $id);

        return PromisePay::getDecodedResponse('feature_configurations');
    }

    public function update($params) {
        PromisePay::RestClient('post', 'configurations/', $params);

        return PromisePay::getDecodedResponse('feature_configurations');
    }

    public function delete($id) {
        PromisePay::RestClient('delete', 'configurations/' . $id);

        return PromisePay::getDecodedResponse('feature_configurations');
    }

    public function getList($params = array()) {
        PromisePay::RestClient('get', 'configurations/', $params);

        return PromisePay::getDecodedResponse('feature_configurations');
    }
}
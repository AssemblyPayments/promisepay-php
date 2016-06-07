<?php
namespace PromisePay;

class Token {
    public function generateCardToken($params) {
        PromisePay::RestClient('post', 'token_auths/', $params);
        
        return PromisePay::getDecodedResponse('token_auth');
    }
    
    public function requestToken() {
        PromisePay::RestClient('get', 'request_token/');
        
        return PromisePay::getDecodedResponse();
    }

    public function requestSessionToken($params) {
        PromisePay::RestClient('get', 'request_session_token/', $params);
        
        return PromisePay::getDecodedResponse();
    }
}
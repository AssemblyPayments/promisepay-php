<?php
namespace PromisePay;

class ToolsRepository {
    public static function health() {
        PromisePay::RestClient('get', 'status');
        
        return PromisePay::getDecodedResponse('status');
    }
}

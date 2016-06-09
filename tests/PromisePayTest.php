<?php
namespace PromisePay\Tests;

use Promisepay\PromisePay;

class PromisePayTest extends \PHPUnit_Framework_TestCase {
    
    public function testGetRequestMethod() {
        $request = PromisePay::RestClient('get', 'items/');
        
        $this->assertEquals($request->content_type, 'application/json');
    }
    
    /**
     * @expectedException PromisePay\Exception\ApiUnsupportedRequestMethod
     */
    public function testInvalidRequestMethod() {
        PromisePay::RestClient('commit', 'items/10');
    }
    
}

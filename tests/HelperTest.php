<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class HelperTest extends \PHPUnit_Framework_TestCase {
    
    public function testRuntimeChecks() {
        $this->assertNull(PromisePay::helper()->runtimeChecks());
    }
    
    public function testBuildErrorMessage() {
        $this->markTestIncomplete();
    }
    
    public function testArrayValueByKeyRecursive() {
        $this->markTestIncomplete();
    }
    
    public function testWaitForServerToBecomeResponsiveAgain() {
        $this->markTestIncomplete();
    }
    
}
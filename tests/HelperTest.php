<?php
namespace PromisePay\Tests;

class HelperTest extends \PHPUnit_Framework_TestCase {
    
    public function testRuntimeChecksReturnType() {
        $this->assertNull(
            \PromisePay\Helpers\Functions::runtimeChecks()
        );
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
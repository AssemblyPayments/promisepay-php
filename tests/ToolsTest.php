<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class ToolsTest extends \PHPUnit_Framework_TestCase {
    public function testHealth() {
        $healthStatus = PromisePay::Tools()->health();
        
        $this->assertNotEmpty($healthStatus);
    }
}

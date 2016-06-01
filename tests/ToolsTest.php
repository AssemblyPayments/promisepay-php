<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

class ToolsTest extends \PHPUnit_Framework_TestCase {
    public function testHealth() {
        $healthStatus = PromisePay::Tools()->getHealth();
        
        $this->assertNotEmpty($healthStatus);
    }
}

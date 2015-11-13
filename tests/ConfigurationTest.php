<?php
namespace PromisePay\Tests;

use PromisePay\Configuration;
use PromisePay\Exception;

/**
 * Class Configuration
 *
 * @package PromisePay
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase {
    
    public function setUp() {
    }
    
    public function testConstantsDefined() {
        $this->assertTrue(defined('PromisePay\API_LOGIN'));
        $this->assertTrue(defined('PromisePay\API_PASSWORD'));
        $this->assertTrue(defined('PromisePay\API_URL'));
        $this->assertTrue(defined('PromisePay\API_KEY'));
    }
    
    public function testApiKeyValidBase64Format() {
        // base64_decode returns false on invalid data 
        $this->assertNotFalse(base64_decode(constant('PromisePay\API_KEY'), true));
    }
    
}
?>
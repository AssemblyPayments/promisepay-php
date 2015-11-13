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
    
    public function testConstantsDefined() {
        $this->assertTrue(defined('PromisePay\API_LOGIN'));
        $this->assertTrue(defined('PromisePay\API_PASSWORD'));
        $this->assertTrue(defined('PromisePay\API_URL'));
    }
    
}
?>
<?php
namespace PromisePay\Tests;

use PromisePay\Configuration;
use PromisePay\Exception\NotFound;

/**
 * Class Configuration
 *
 * @package PromisePay
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    protected $instance;
    
    public function setUp() {
        require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'init.php');
        
        $this->instance = new Configuration;
    }
    
    public function testInstance() {
        $this->assertTrue($this->instance instanceof Configuration);
    }
    
    public function testPropertiesArentEmpty() {
        $this->assertNotEmpty($this->instance->sdkConfigFileName);
        $this->assertNotEmpty($this->instance->sdkConfigFileUsed);
        $this->assertNotEmpty($this->instance->permittedApiUrls);
    }
    
    public function testPropertiesAreValidTypes() {
        $this->assertTrue(is_string($this->instance->sdkConfigFileName));
        $this->assertTrue(is_string($this->instance->sdkConfigFileUsed));
        $this->assertTrue(is_array($this->instance->permittedApiUrls));
    }
    
    public function testUsedFileExists() {
        $this->assertFileExists($this->instance->sdkConfigFileUsed);
    }
    
    public function testConstantsDefined() {
        $this->assertTrue(defined('PromisePay\API_LOGIN'));
        $this->assertTrue(defined('PromisePay\API_PASSWORD'));
        $this->assertTrue(defined('PromisePay\API_URL'));
        $this->assertTrue(defined('PromisePay\API_KEY'));
    }
    
    public function testApiKeyValidBase64Format() {
        $this->assertNotFalse(base64_decode(constant('PromisePay\API_KEY'), true));
    }
    
    public function testCustomNonExistingConfigFile() {
        try {
            new Configuration("Non_Existing_SDK_Config_File.php");
			$this->fail('An expected exception \PromisePay\Exception\NotFound has not been raised.');
        } catch (NotFound $e) {
            $this->assertTrue(true);
        }
    }
    
    public function testCustomExistingConfigFile() {
        try {
            new Configuration(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'SDK_Config.php');
            $this->assertTrue(true);
        } catch (NotFound $e) {
            $this->fail("Exception \PromisePay\Exception\NotFound has been raised.");
        }
    }
}
?>
<?php
namespace PromisePay\Test;

use Promisepay;
use Promisepay\Exception;

/**
 * Class Configuration
 *
 * @package PromisePay
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
	protected $instance;
	
	public function setUp() {
		/*
		 * Suppress "Constant API_KEY already defined" notice which only happens because the test file reloads 
		 * the PromisePay\Configuration class,  which reincludes SDK Config file, which tries to redefine constants.
		 * Cleaner solution than adding defined() conditionals in SDK Config file.
		 */
		error_reporting(E_ALL ^ E_NOTICE);
		
		require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'init.php');
		
		$this->instance = new PromisePay\Configuration;
	}
	
	public function testInstance() {
		$this->assertTrue($this->instance instanceof PromisePay\Configuration);
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
			new PromisePay\Configuration("Non_Existing_SDK_Config_File.php");
		} catch (\PromisePay\Exception\NotFound $e) {
			return;
		}
		
		$this->fail('An expected exception \PromisePay\Exception\NotFound has not been raised.');
	}
	
	public function testCustomExistingConfigFile() {
		try {
			new PromisePay\Configuration(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'SDK_Config.php');
			$this->assertTrue(true);
		} catch (\PromisePay\Exception\NotFound $e) {
			$this->fail("Exception \PromisePay\Exception\NotFound has been raised.");
		}
	}
}
?>
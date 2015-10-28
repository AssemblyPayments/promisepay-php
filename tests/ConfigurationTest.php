<?php
namespace PromisePay;

/**
 * Class Configuration
 *
 * @package PromisePay
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
	// The following two PHPUnit directives are used because constants cannot be redefined, and that's what would happen if test wasn't run in separate process
	protected $preserveGlobalState = false;
    protected $runTestInSeparateProcess = true;
	
	protected $instance;
	
	public function setUp() {
		require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'init.php');
		
		$this->instance = new Configuration;
	}
	
	public function testInstance() {
		$this->assertTrue($this->instance instanceof Configuration);
	}
	
	public function testPropertiesArentEmpty() {
		$this->assertNotEmpty($this->instance->sdkConfigFile);
		$this->assertNotEmpty($this->instance->sdkConfigFileUsed);
		$this->assertNotEmpty($this->instance->permittedApiUrls);
	}
	
	public function testPropertiesAreValidTypes() {
		$this->assertTrue(is_string($this->instance->sdkConfigFile));
		$this->assertTrue(is_string($this->instance->sdkConfigFileUsed));
		$this->assertTrue(is_array($this->instance->permittedApiUrls));
	}
	
	public function testUsedFileExists() {
		$this->assertFileExists($this->instance->sdkConfigFileUsed);
	}
	
	public function testConstantsDefined() {
		$this->assertTrue(defined('API_LOGIN'));
		$this->assertTrue(defined('API_PASSWORD'));
		$this->assertTrue(defined('API_URL'));
		$this->assertTrue(defined('API_KEY'));
	}
	
	public function testApiKeyValidBase64Format() {
		$this->assertNotFalse(base64_decode(API_KEY, true));
	}
}
?>
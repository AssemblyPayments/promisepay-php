<?php
namespace PromisePay\Test;

use Promisepay;

class BaseRepositoryTest extends \PHPUnit_Framework_TestCase
{
	protected $instance;
	
	public function setUp() {
		/*
		 * Suppress "Constant API_KEY already defined" notice which only happens because the test file reloads 
		 * the PromisePay\Configuration class,  which reincludes SDK Config file, which tries to redefine constants.
		 *
		 */
		error_reporting(E_ALL ^ E_NOTICE);
		
		require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'init.php');
		
		$this->instance = new Promisepay\BaseRepository;
	}
	
	public function testInstance() {
		$this->assertTrue($this->instance instanceof PromisePay\BaseRepository);
	}
	
	public function testConstantsDefined() {
		$this->assertTrue(defined('PromisePay\API_LOGIN'));
		$this->assertTrue(defined('PromisePay\API_PASSWORD'));
		$this->assertTrue(defined('PromisePay\API_URL'));
		$this->assertTrue(defined('PromisePay\API_KEY'));
	}
	
	public function testGetRequestMethod() {
		$request = $this->instance->RestClient('get', 'addresses/9c9508e6-e1e8-8422-50c2-e3b6b26b2a9f');
		
		var_dump($request);
	}
}
?>
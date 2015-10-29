<?php
namespace PromisePay\Test;

use Promisepay;
use Promisepay\Exception;
use PromisePay\DataObjects\Token;

class BaseRepositoryTest extends \PHPUnit_Framework_TestCase
{
	protected $instance;
	
	public function setUp() {
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
		$request = $this->instance->RestClient('get', 'items/');
		
		$this->assertEquals($request->content_type, 'application/json');
		$this->assertNotNull(json_decode($request->raw_body)); // json_decode() returns null on invalid JSON, not false
		$this->assertEquals($request->request->username, constant('PromisePay\API_LOGIN'));
		$this->assertEquals($request->request->password, constant('PromisePay\API_PASSWORD'));
	}
	
	public function testPostRequestMethod() {
		$request = $this->instance->RestClient('post', 'items/');
		
		$this->assertEquals($request->content_type, 'application/json');
		$this->assertNotNull(json_decode($request->raw_body));
		$this->assertEquals($request->request->username, constant('PromisePay\API_LOGIN'));
		$this->assertEquals($request->request->password, constant('PromisePay\API_PASSWORD'));
	}
	
	public function testDeleteRequestMethod() {
		$request = $this->instance->RestClient('delete', 'items/10');
		
		$this->assertEquals($request->content_type, 'application/json');
		$this->assertNotNull(json_decode($request->raw_body));
		$this->assertEquals($request->request->username, constant('PromisePay\API_LOGIN'));
		$this->assertEquals($request->request->password, constant('PromisePay\API_PASSWORD'));
	}
	
	public function testPatchRequestMethod() {
		$request = $this->instance->RestClient('patch', 'items/10');
		
		$this->assertEquals($request->content_type, 'application/json');
		$this->assertNotNull(json_decode($request->raw_body)); // json_decode() returns null on invalid JSON, not false
		$this->assertEquals($request->request->username, constant('PromisePay\API_LOGIN'));
		$this->assertEquals($request->request->password, constant('PromisePay\API_PASSWORD'));
	}
	
	public function testInvalidRequestMethod() {
		try {
			$this->instance->RestClient('commit', 'items/10');
			$this->fail("Expected exception wasn't fired.");
		} catch (\PromisePay\Exception\ApiUnsupportedRequestMethod $e) {
			$this->assertTrue(true);
		}
	}
}
?>
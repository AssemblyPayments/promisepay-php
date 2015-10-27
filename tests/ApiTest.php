<?php
// CONTINUE HERE // CONTINUE HERE // CONTINUE HERE
namespace PromisePay;

class ApiTest extends \PHPUnit_Framework_TestCase
{
	// The following two PHPUnit directives are used because constants cannot be redefined
	protected $preserveGlobalState = false;
    protected $runTestInSeparateProcess = true;
	
	protected $instance;
	
	public function setUp() {
		require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'init.php');
		
		$this->instance = new ApiAbstract;
	}
}
?>
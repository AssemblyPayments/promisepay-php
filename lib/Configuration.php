<?php
namespace PromisePay;

use PromisePay\Exception;

/**
 * Class Configuration
 * @package PromisePay
 */
class Configuration
{
	/**
	 * Private variable.
	 * SDK Config filename. Only filename, not path. File must be in package's root folder.
	 *
	 * @var string $sdkConfigFile
	 */
	private $sdkConfigFile = 'SDK_Config.php';
	
	/**
	 * Private variable
	 * Tracks absolute path and filename of SDK Config file being used.
	 * 
	 * @var string $sdkConfigFileUsed
	 */
	private $sdkConfigFileUsed;
	
	/**
	 * Private variable
	 * Lists permitted API_URL values
	 * 
	 * @var array $permittedApiUrls
	 */
	private $permittedApiUrls = array('https://test.api.promisepay.com/', 'https://secure.api.promisepay.com/');
	
	/**
	 * Construct
	 *
	 * @param string|null $customConfigFile Optional config file PATH to use instead of default one
	 * @throws Exception\NotFound
	 * @throws Exception\Credentials
	 */
	public function __construct($customConfigFile = null) 
	{
		// Check if file exists
		if (!is_null($customConfigFile)) 
		{
			if (!file_exists($customConfigFile)) 
			{
				throw new Exception\NotFound("User supplied config file $customConfigFile not found.");
			}
			
			$this->sdkConfigFileUsed = $customConfigFile;
		} 
		else 
		{
			$project_path = dirname(__DIR__);
			$configFilePath  = $project_path . $this->sdkConfigFile;
			
			if (!file_exists($configFilePath)) 
			{
				throw new Exception\NotFound("SDK Config file {$this->sdkConfigFile} not found in $project_path");
			}
			
			$this->sdkConfigFileUsed = $configFilePath;
		}
		
		// Check if the config file is valid in order to avoid unexpected results
		if (!defined('API_LOGIN') || !defined('API_PASSWORD') || !defined('API_URL')) 
		{
			throw new Exception\Credentials("SDK Config file {$this->sdkConfigFileUsed} is missing at least one of the following constants: USERNAME, PASSWORD, API_URL");
		}
		
		if (!in_array(API_URL, $this->permittedApiUrls)) 
		{
			throw new Exception\Credentials("SDK Config file {$this->sdkConfigFileUsed} is using unsupported API_URL value " . API_URL . ". Did you forget the trailing forward slash(/) ? Supported API_URL values (API endpoints) are: " . implode(", ", $this->permittedApiUrls));
		}
		
		// Finally, generate API_KEY, which is in format of base64encode(API_LOGIN:API_PASSWORD)
		$api_key = base64_encode(API_LOGIN . ':' . API_PASSWORD);
		define('API_KEY', $api_key);
	}
}
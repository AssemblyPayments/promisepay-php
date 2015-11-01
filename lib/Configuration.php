<?php
namespace PromisePay;

use PromisePay\Exception;

/**
 * Class Configuration
 *
 * @param string|null $customConfigFile optional For custom SDK Config file path.
 * @package PromisePay
 */
class Configuration
{
	/**
	 * Private read-only variable.
	 * SDK Config filename. Only filename, not path. File must be in package's root folder.
	 *
	 * @var string $sdkConfigFileName
	 */
	private $sdkConfigFileName = 'SDK_Config.php';
	
	/**
	 * Private variable
	 * Read-only when accessed outside this class.
	 * Tracks absolute path and filename of SDK Config file being used.
	 * 
	 * @var string $sdkConfigFileUsed
	 */
	private $sdkConfigFileUsed;
	
	/**
	 * Private read-only variable
	 * Lists permitted API_URL values
	 * 
	 * @var array $permittedApiUrls
	 */
	private $permittedApiUrls = array('https://test.api.promisepay.com/', 'https://secure.api.promisepay.com/');
	
	/**
	 * Construct
	 * Loads appropriate SDK Config file.
	 *
	 * @param string|null $customConfigFile Optional config file PATH to use instead of default one
	 * @throws Exception\NotFound
	 * @throws Exception\Credentials
	 */
	public function __construct($customConfigFile = null) 
	{
		// if default timezone hasn't been set, do it here
		if (!ini_get('date.timezone')) {
			date_default_timezone_set('UTC');
		}
		
		// Check if file exists
		if (!is_null($customConfigFile)) 
		{
			if (!file_exists($customConfigFile)) 
			{
				throw new Exception\NotFound("User supplied config file $customConfigFile not found (don't forget to supply full path, not just filename).");
			}
			
			$this->sdkConfigFileUsed = $customConfigFile;
		} 
		else 
		{
			$project_path = dirname(__DIR__);
			$configFilePath  = $project_path . DIRECTORY_SEPARATOR . $this->sdkConfigFileName;
			
			if (!file_exists($configFilePath)) 
			{
				throw new Exception\NotFound("SDK Config file {$this->sdkConfigFileName} not found in $project_path");
			}
			
			$this->sdkConfigFileUsed = $configFilePath;
		}
		
		require_once($this->sdkConfigFileUsed);
		
		// Check if the config file is valid in order to avoid unexpected results
		if (!defined(__NAMESPACE__ . '\API_LOGIN')) 
		{
			throw new Exception\Credentials("SDK Config file {$this->sdkConfigFileUsed} is missing the following constant: API_LOGIN.");
		}
		
		if (!defined(__NAMESPACE__ . '\API_PASSWORD')) 
		{
			throw new Exception\Credentials("SDK Config file {$this->sdkConfigFileUsed} is missing the following constant: API_PASSWORD");
		}
		
		if (!defined(__NAMESPACE__ . '\API_URL')) 
		{
			throw new Exception\Credentials("SDK Config file {$this->sdkConfigFileUsed} is missing the following constants: API_URL");
		}
		
		if (!in_array(constant(__NAMESPACE__ . '\API_URL'), $this->permittedApiUrls)) 
		{
			throw new Exception\Credentials("SDK Config file {$this->sdkConfigFileUsed} is using unsupported API_URL value " . API_URL . ". Did you forget the trailing forward slash(/) ? Supported API_URL values (API endpoints) are: " . implode(", ", $this->permittedApiUrls));
		}
		
		// Finally, generate API_KEY, which is in format of base64encode(API_LOGIN:API_PASSWORD)
		if (!defined(__NAMESPACE__ . '\API_KEY')) {
			$api_key = base64_encode(API_LOGIN . ':' . API_PASSWORD);
			define(__NAMESPACE__ . '\API_KEY', $api_key);
		}
	}
	
	/**
	 * Magic method
	 * Makes private properties defined in this class readable outside it.
	 *
	 * @param $property Inaccessible property to return
	 * @return mixed
	 */
	public function __get($property) 
	{
		return $this->$property;
	}
}
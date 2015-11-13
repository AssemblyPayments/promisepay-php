<?php
namespace PromisePay;

use PromisePay\Exception;

/**
 * Class Configuration
 *
 * @param string|null $configurationFile optional For custom SDK Config file path.
 * @package PromisePay
 */
class Configuration {
    
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
     * @param string|null $configurationFile Optional config file PATH to use instead of default one
     * @throws Exception\NotFound
     * @throws Exception\Credentials
     */
    public function __construct($configurationFile) {
        
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            die("Fatal error: The minimum version of PHP needed for this package is 5.3.0. Exiting...");
        }
        
        // if default timezone hasn't been set, do it here
        if (!ini_get('date.timezone')) {
            date_default_timezone_set('UTC');
        }
        
        if (!file_exists($configurationFile)) {
            throw new Exception\NotFound("User supplied config file $configurationFile not found (don't forget to supply full path, not just filename).");
        }
        
        require_once($configurationFile);
        
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

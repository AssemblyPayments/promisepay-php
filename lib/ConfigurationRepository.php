<?php
namespace PromisePay;

use PromisePay\Exception;

/**
 * Class Configuration
 *
 * @param string|null $configurationFile optional For custom SDK Config file path.
 * @package PromisePay
 */
class ConfigurationRepository {
    
    /**
     * Private read-only variable
     * Lists permitted API_URL values
     * 
     * @var array $permittedApiUrls
     */
    private static $permittedApiUrls = array('prelive' => 'https://test.api.promisepay.com/', 'live' => 'https://secure.api.promisepay.com/');
    
    /**
     * Construct
     * Loads appropriate SDK Config file.
     *
     * @param string|null $configurationFile Optional config file PATH to use instead of default one
     * @throws Exception\NotFound
     * @throws Exception\Credentials
     */
    public function __construct() {
        
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            die("Fatal error: The minimum version of PHP needed for this package is 5.3.0. Exiting...");
        }
        
        // if default timezone hasn't been set, do it here
        if (!ini_get('date.timezone')) {
            date_default_timezone_set('UTC');
        }
    }
    
    /**
     * Declare API type (testing or live).
     *
     * @param string $environmentType
     */
    public static function environment($environmentType) {
        if (!array_key_exists($environmentType, self::$permittedApiUrls)) {
            die("Fatal error: Invalid API Environment type. Supported values are: prelive(sandboxed), live.");
        }
        
        define(__NAMESPACE__ . '\API_URL', self::$permittedApiUrls[$environmentType]);
    }
    
    /**
     * Declare the login address to be used when issuing 
     * requests towards API.
     *
     * @param string $emailAddress
     */
    public static function login($emailAddress) {
        define(__NAMESPACE__ . '\API_LOGIN', $emailAddress);
    }
    
    /**
     * Declare token to be used when issuing 
     * requests towards API.
     *
     * @param string $token
     */
    public static function password($token) {
        define(__NAMESPACE__ . '\API_PASSWORD', $token);
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

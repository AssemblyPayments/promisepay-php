<?php
namespace PromisePay;

/**
 * Class Configuration
 *
 * @package PromisePay
 */
class Configuration {
    
    /**
     * Protected read-only variable
     * Lists permitted API_URL values
     * 
     * @var array $permittedApiUrls
     */
    protected $permittedApiUrls = array(
        'prelive' => 'https://test.api.promisepay.com/',
        'production' => 'https://secure.api.promisepay.com/'
    );
    
    /**
     * Construct
     */
    public function __construct() {
        if (version_compare(PHP_VERSION, '5.3.3', '<')) {
            die("Fatal error: The minimum version of PHP needed for this package is 5.3.0. Exiting.");
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
    public function environment($environmentType) {
        if (!array_key_exists($environmentType, $this->permittedApiUrls)) {
            die("Fatal error: Invalid API Environment type. Supported values are: prelive, production.");
        }
        
        define(__NAMESPACE__ . '\API_URL', $this->permittedApiUrls[$environmentType]);
    }
    
    /**
     * Declare the login address to be used when issuing 
     * requests towards API.
     *
     * @param string $emailAddress
     */
    public function login($emailAddress) {
        define(__NAMESPACE__ . '\API_LOGIN', $emailAddress);
    }
    
    /**
     * Declare token to be used when issuing 
     * requests towards API.
     *
     * @param string $token
     */
    public function password($token) {
        define(__NAMESPACE__ . '\API_PASSWORD', $token);
    }
}

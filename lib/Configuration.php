<?php
namespace PromisePay;

/**
 * Class Configuration
 *
 * @package PromisePay
 */
class Configuration {
    
    /** @var array Lists permitted API_URL values */
    private $permittedApiUrls = array(
        'prelive' => 'https://test.api.promisepay.com/',
        'production' => 'https://secure.api.promisepay.com/'
    );
    
    /**
     * Declare API type (testing or live).
     *
     * @param string $environmentType
     */
    public function environment($environmentType) {
        if (!array_key_exists($environmentType, $this->permittedApiUrls)) {
            die(
                sprintf(
                    "Fatal error: Invalid API Environment type for %s package.
                    Supported values are: %s.",
                    __NAMESPACE__,
                    implode(', ', array_keys($this->permittedApiUrls))
                )
            );
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

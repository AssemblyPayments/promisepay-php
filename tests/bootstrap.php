<?php
namespace PromisePay\Tests;
use PromisePay\PromisePay;

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

define(__NAMESPACE__ . '\PHPUNIT_ENVIRONMENT', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests/SDK_Config_Tests.php');

// Configuration
require(dirname(__DIR__) . '/lib/Configuration.php');

// Repos
require(dirname(__DIR__) . '/lib/PromisePay.php');
require(dirname(__DIR__) . '/lib/AddressRepository.php');
require(dirname(__DIR__) . '/lib/BankAccountRepository.php');
require(dirname(__DIR__) . '/lib/CardAccountRepository.php');
require(dirname(__DIR__) . '/lib/CompanyRepository.php');
require(dirname(__DIR__) . '/lib/FeeRepository.php');
require(dirname(__DIR__) . '/lib/ItemRepository.php');
require(dirname(__DIR__) . '/lib/PayPalAccountRepository.php');
require(dirname(__DIR__) . '/lib/TokenRepository.php');
require(dirname(__DIR__) . '/lib/TransactionRepository.php');
require(dirname(__DIR__) . '/lib/UserRepository.php');

// Enums
require(dirname(__DIR__) . '/lib/Enum/FeeType.php');
require(dirname(__DIR__) . '/lib/Enum/PaymentType.php');

// Exception
require(dirname(__DIR__) . '/lib/Exception/Base.php');
require(dirname(__DIR__) . '/lib/Exception/Api.php');
require(dirname(__DIR__) . '/lib/Exception/ApiUnsupportedRequestMethod.php');
require(dirname(__DIR__) . '/lib/Exception/Argument.php');
require(dirname(__DIR__) . '/lib/Exception/Credentials.php');
require(dirname(__DIR__) . '/lib/Exception/Misconfiguration.php');
require(dirname(__DIR__) . '/lib/Exception/NotFound.php');
require(dirname(__DIR__) . '/lib/Exception/Unauthorized.php');
require(dirname(__DIR__) . '/lib/Exception/Validation.php');

// Custom Logger
require(dirname(__DIR__) . '/lib/Log/Logger.php');

// Rest
require(dirname(__DIR__) . '/lib/Vendors/Httpful/Bootstrap.php');
require(dirname(__DIR__) . '/lib/Vendors/Httpful/Http.php');
require(dirname(__DIR__) . '/lib/Vendors/Httpful/Request.php');

// Invoke Configuration class
new PromisePay;

// Tests/PHPunit specific file
require_once(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests/GUID.php');

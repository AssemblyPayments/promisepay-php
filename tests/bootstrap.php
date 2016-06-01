<?php
namespace PromisePay\Tests;

use PromisePay\PromisePay;

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Tests/PHPunit specific file
require_once(__DIR__ . '/GUID.php');

// Project files autoloader
require_once(__DIR__ . '/../autoload.php');

// Setup testing environment
PromisePay::Configuration()->environment('prelive');
PromisePay::Configuration()->login('idsidorov@gmail.com');
PromisePay::Configuration()->password('d897f812e8485728e1de7d8ae092b75a');

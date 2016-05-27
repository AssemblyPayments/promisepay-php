<?php
namespace PromisePay;

// Main Class
require(dirname(__FILE__) . '/lib/PromisePay.php');

// Configuration handler
require(dirname(__FILE__) . '/lib/ConfigurationRepository.php');

// Repositories
require(dirname(__FILE__) . '/lib/AddressRepository.php');
require(dirname(__FILE__) . '/lib/BankAccountRepository.php');
require(dirname(__FILE__) . '/lib/CardAccountRepository.php');
require(dirname(__FILE__) . '/lib/CompanyRepository.php');
require(dirname(__FILE__) . '/lib/FeeRepository.php');
require(dirname(__FILE__) . '/lib/ItemRepository.php');
require(dirname(__FILE__) . '/lib/PayPalAccountRepository.php');
require(dirname(__FILE__) . '/lib/TokenRepository.php');
require(dirname(__FILE__) . '/lib/TransactionRepository.php');
require(dirname(__FILE__) . '/lib/UserRepository.php');
require(dirname(__FILE__) . '/lib/DisbursementRepository.php');
require(dirname(__FILE__) . '/lib/WalletAccountsRepository.php');
require(dirname(__FILE__) . '/lib/TransactionsRepository.php');
require(__DIR__ . '/lib/ToolsRepository.php');
require(__DIR__ . '/lib/BatchTransactionsRepository.php');

// Enums
require(dirname(__FILE__) . '/lib/Enum/FeeType.php');
require(dirname(__FILE__) . '/lib/Enum/PaymentType.php');

// Exceptions
require(dirname(__FILE__) . '/lib/Exception/Base.php');
require(dirname(__FILE__) . '/lib/Exception/Api.php');
require(dirname(__FILE__) . '/lib/Exception/ApiUnsupportedRequestMethod.php');
require(dirname(__FILE__) . '/lib/Exception/Argument.php');
require(dirname(__FILE__) . '/lib/Exception/Credentials.php');
require(dirname(__FILE__) . '/lib/Exception/Misconfiguration.php');
require(dirname(__FILE__) . '/lib/Exception/NotFound.php');
require(dirname(__FILE__) . '/lib/Exception/Unauthorized.php');
require(dirname(__FILE__) . '/lib/Exception/Validation.php');
require(__DIR__ . '/lib/Exception/MalformedResponse.php');

// Custom Logger
require(dirname(__FILE__) . '/lib/Log/Logger.php');

// Rest
require(dirname(__FILE__) . '/lib/Vendors/Httpful/Bootstrap.php');
require(dirname(__FILE__) . '/lib/Vendors/Httpful/Http.php');
require(dirname(__FILE__) . '/lib/Vendors/Httpful/Request.php');

// Instantiate main class so all methods can be statically called
new PromisePay;

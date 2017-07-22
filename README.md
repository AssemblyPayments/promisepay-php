# PHP SDK - PromisePay API

[![Build Status](https://travis-ci.org/PromisePay/promisepay-php.svg)](https://travis-ci.org/NinoSkopac/promisepay-php) [![Latest Stable Version](https://poser.pugx.org/promisepay/promisepay-php/v/stable)](https://packagist.org/packages/promisepay/promisepay-php)
[![Total Downloads](https://poser.pugx.org/promisepay/promisepay-php/downloads)](https://packagist.org/packages/promisepay/promisepay-php)
[![Code Climate](https://codeclimate.com/github/PromisePay/promisepay-php/badges/gpa.svg)](https://codeclimate.com/github/PromisePay/promisepay-php)

 Note: The api only responds to the models which are included with the php package.

# 1. Installation

### Composer

You can include this package via Composer.

```json
{
  "require": {
    "promisepay/promisepay-php": "2.*"
  }
}
```

Install the package.

	composer install

Require the package in the controller where you'll be using it.

```php
use PromisePay;
```

### Manual Installation
Download the latest release from GitHub, then require the package in the relevant controller.

```php
use PromisePay;
```

### Prerequisites

   - PHP 5.3 or above
   - [curl](http://php.net/manual/en/book.curl.php) and [json](http://php.net/manual/en/book.json.php)  extensions must be enabled
   

# 2. Configuration
Before interacting with PromisePay API, you'll need to [create a prelive account](https://management.prelive.promisepay.com/#/sign-up/prelive) and get an API token.

Afterwards, you need to declare environment, login (your email address) and password (API token), thus:

```php
PromisePay::Configuration()->environment('prelive'); // Use 'production' for the production environment.
PromisePay::Configuration()->login('your_email_address');
PromisePay::Configuration()->password('your_token');
```


# 3. Examples
## Tokens
##### Example 1 - Request session token
The below example shows the request for a marketplace configured to have the Item and User IDs generated automatically for them.

```php
$token = PromisePay::Token()->requestSessionToken(array(
	'current_user'           => 'seller',
	'item_name'              => 'Test Item',
	'amount'                 => '2500',
	'seller_lastname'        => 'Seller',
	'seller_firstname'       => 'Sally',
	'buyer_lastname'         => 'Buyer',
	'buyer_firstname'        => 'Bobby',
	'buyer_country'          => 'AUS',
	'seller_country'         => 'USA',
	'seller_email'           => 'sally.seller@promisepay.com',
	'buyer_email'            => 'bobby.buyer@promisepay.com',
	'fee_ids'                => '',
	'payment_type_id'        => '2'
));
```

## Items

##### Create an item

```php
$item = PromisePay::Item()->create(array(
    "id"              => 'ITEM_ID',
    "name"            => 'Test Item # 1',
    "amount"          => 1000,
    "payment_type_id" => 1,
    "buyer_id"        => 'BUYER_ID',
    "seller_id"       => 'SELLER_ID',
    "description"     => 'Description'
));
```
##### Get an item

```php
$item = PromisePay::Item()->get('ITEM_ID');
```
##### Get a list of items
```php
$items = PromisePay::Item()->getList(array(
	'limit' => 20,
	'offset' => 0
));
```
##### Update an item
```php
$item = PromisePay::Item()->update('ITEM_ID', array(
    "id"              => 'ITEM_ID',
    "name"            => 'Test Item # 1',
    "amount"          => 1000,
    "payment_type_id" => 1,
    "buyer_id"        => 'BUYER_ID',
    "seller_id"       => 'SELLER_ID',
    "description"     => 'Description'
));
```

##### Delete an item
```php
$item = PromisePay::Item()->delete('ITEM_ID');
```

##### Get an item status
```php
$item = PromisePay::Item()->getStatus('ITEM_ID');
```

##### Get an item's buyer
```php
$user = PromisePay::Item()->getBuyer('ITEM_ID');
```

##### Get an item's seller
```php
$user = PromisePay::Item()->getSeller('ITEM_ID');
```

##### Get an item's fees
```php
$fees = PromisePay::Item()->getListOfFees('ITEM_ID');
```

##### Get an item's transactions
```php
$transactions = PromisePay::Item()->getListOfTransactions('ITEM_ID');
```

##### Get an item's wire details
```php
$wireDetails = PromisePay::Item()->getWireDetails('ITEM_ID');
```

##### Get an item's BPAY details
```php
$bPayDetails = PromisePay::Item()->getBPayDetails('ITEM_ID');
```


## Item Actions

##### Make payment

```php
$item = PromisePay::Item()->makePayment('ITEM_ID', array(
	'account_id' => 'BUYER_ACCOUNT_ID'
));
```
##### Request payment
```php
$item = PromisePay::Item()->requestPayment('ITEM_ID');
```
##### Release payment
```php
$item = PromisePay::Item()->releasePayment('ITEM_ID');
```
##### Request release
```php
$item = PromisePay::Item()->requestRelease('ITEM_ID');
```
##### Cancel
```php
$item = PromisePay::Item()->cancelItem('ITEM_ID');
```
##### Acknowledge wire
```php
$item = PromisePay::Item()->acknowledgeWire('ITEM_ID');
```
##### Acknowledge PayPal
```php
$item = PromisePay::Item()->acknowledgePayPal('ITEM_ID');
```
##### Revert wire
```php
$item = PromisePay::Item()->revertWire('ITEM_ID');
```
##### Request refund
```php
$item = PromisePay::Item()->requestRefund('ITEM_ID', array(
	'refund_amount' => 1000,
	'refund_message' => 'Frame already constructed.'
));
```
##### Refund
```php
$item = PromisePay::Item()->refund('ITEM_ID', array(
	'refund_amount' => 1000,
	'refund_message' => 'Stable deck refund.'
));
```
##### Decline refund
```php
$declineRefund = PromisePay::Item()->declineRefund(
    'ITEM_ID'
);
```
##### Raise Dispute
```php
$raiseDispute = PromisePay::Item()->raiseDispute(
    'ITEM_ID',
    'BUYER_ID'
);
```
##### Request Dispute Resolution
```php
$requestDisputeResolution = PromisePay::Item()->requestDisputeResolution(
    'ITEM_ID'
);
```
##### Resolve Dispute
```php
$resolveDispute = PromisePay::Item()->resolveDispute(
    'ITEM_ID'
);
```
##### Escalate Dispute
```php
$resolveDispute = PromisePay::Item()->escalateDispute(
    'ITEM_ID'
);
```
##### Request Tax Invoice
```php
$requestTaxInvoice = PromisePay::Item()->requestTaxInvoice(
    'ITEM_ID'
);
```
##### List Item Batch Transactions
```php
$batchTransactions = PromisePay::Item()->listBatchTransactions('ITEM_ID');
```
##### Send Tax Invoice
```php
$sendTaxInvoice = PromisePay::Item()->sendTaxInvoice(
    'ITEM_ID'
);
```



## Users

##### Create a user
```php
$user = PromisePay::User()->create(array(
    'id'            => 'USER_ID',
    'first_name'    => 'UserCreateTest',
    'last_name'     => 'UserLastname',
    'email'         => 'email@google.com',
    'mobile'        => '5455400012',
    'address_line1' => 'a_line1',
    'address_line2' => 'a_line2',
    'state'         => 'state',
    'city'          => 'city',
    'zip'           => '90210',
    'country'       => 'AUS'
));
```
##### Get a user
```php
$user = PromisePay::User()->get('USER_ID');
```
##### Get a list of users
```php
$users = PromisePay::User()->getList(array(
	'limit' => 20,
	'offset' => 0
));
```
##### Update a user
```php
$user = PromisePay::User()->update('USER_ID', array(
    'id'            => 'USER_ID',
    'first_name'    => 'UserCreateTest',
    'last_name'     => 'UserLastname',
    'email'         => 'email@google.com',
    'mobile'        => '5455400012',
    'address_line1' => 'a_line1',
    'address_line2' => 'a_line2',
    'state'         => 'state',
    'city'          => 'city',
    'zip'           => '90210',
    'country'       => 'AUS'
));
```
##### Get a user's card accounts
```php
$accounts = PromisePay::User()->getListOfCardAccounts('USER_ID');
```
##### Get a user's PayPal accounts
```php
$accounts = PromisePay::User()->getListOfPayPalAccounts('USER_ID');
```

##### Get a user's bank accounts
```php
$accounts = PromisePay::User()->getListOfBankAccounts('USER_ID');
```
##### Get a user's items
```php
$items = PromisePay::User()->getListOfItems('USER_ID');
```
##### Show User Wallet Account
```php
$accounts = PromisePay::User()->getListOfWalletAccounts('USER_ID');
```
##### Set a user's disbursement account
```php
$account = PromisePay::User()->setDisbursementAccount('ACCOUNT_ID');
```

## Wallet Accounts
##### Show Wallet Account
```php
$wallet = PromisePay::WalletAccounts()->show('WALLET_ID');
```
##### Withdraw Funds
```php
// Withdraw to PayPal

// Authorize bank account to be used as a funding source
$authority = PromisePay::DirectDebitAuthority()->create(
    array(
        'account_id' => 'SOURCE_BANK_ID',
        'amount'     => 100
    )
);

$withdrawal = PromisePay::WalletAccounts()->withdraw(
    'SOURCE_BANK_ID',
    array(
        'account_id' => 'PAYPAY_ACCOUNT_ID',
        'amount'     => 100
    )
);

// Withdraw to Bank Account

// Authorize bank account to be used as a funding source
$authority = PromisePay::DirectDebitAuthority()->create(
    array(
        'account_id' => 'SOURCE_BANK_ID',
        'amount'     => 100
    )
);

$withdrawal = PromisePay::WalletAccounts()->withdraw(
    'SOURCE_BANK_ID',
    array(
        'account_id' => 'TARGET_BANK_ID',
        'amount'     => 100
    )
);
```
##### Deposit Funds
```php
// Authorize bank account to be used as a funding source
$authority = PromisePay::DirectDebitAuthority()->create(
    array(
        'account_id' => 'SOURCE_BANK_ID',
        'amount'     => 100
    )
);

$deposit = PromisePay::WalletAccounts()->deposit(
    'TARGET_WALLET_ID',
    array(
        'account_id' => 'SOURCE_BANK_ID',
        'amount'     => 100
    )
);
```
##### Show Wallet Account User
```php
$walletUser = PromisePay::WalletAccounts()->getUser('WALLET_ID');
```



## Card Accounts
##### Create a card account

```php
$account = PromisePay::CardAccount()->create(array(
   'user_id'      => 'USER_ID',
   'full_name'    => 'Bobby Buyer',
   'number'       => '4111111111111111',
   "expiry_month" => '06',
   "expiry_year"  => '2020',
   "cvv"          => '123'
));
```

##### Get a card account
```php
$account = PromisePay::CardAccount()->get('CARD_ACCOUNT_ID');
```
##### Delete a card account
```php
$account = PromisePay::CardAccount()->delete('CARD_ACCOUNT_ID');
```
##### Get a card account's users
```php
$user = PromisePay::CardAccount()->getUser('CARD_ACCOUNT_ID');
```

## Bank Accounts
##### Create a bank account

```php
$account = PromisePay::BankAccount()->create(array(
    "user_id"        => 'USER_ID',
    "active"         => 'true',
    "bank_name"      => 'bank for test',
    "account_name"   => 'test acc',
    "routing_number" => '12344455512',
    "account_number" => '123334242134',
    "account_type"   => 'savings',
    "holder_type"    => 'personal',
    "country"        => 'USA',
));
```
##### Get a bank account
```php
$account = PromisePay::BankAccount()->get('BANK_ACCOUNT_ID');
```
##### Delete a bank account
```php
$account = PromisePay::BankAccount()->delete('BANK_ACCOUNT_ID');
```
##### Get a bank account's users
```php
$user = PromisePay::BankAccount()->getUser('BANK_ACCOUNT_ID');
```
##### Validate Routing Number
```php
$validateRoutingNumber = PromisePay::BankAccount()->validateRoutingNumber(
    'ROUTING_NUMBER'
);
```

## PayPal Accounts
##### Create a PayPal account
```php
$account = PromisePay::PayPalAccount()->create(array(
    'user_id'      => 'USER_ID',
    'paypal_email' => 'test@paypalname.com'
));
``` 
##### Get a PayPal account
```php
$account = PromisePay::PayPalAccount()->get('PAYPAL_ACCOUNT_ID');
```
##### Delete a PayPal account
```php
$account = PromisePay::PayPalAccount()->delete('PAYPAL_ACCOUNT_ID');
```
##### Get a PayPal account's users
```php
$user = PromisePay::PayPalAccount()->getUser('PAYPAL_ACCOUNT_ID');
```

## Batch Transactions
##### List Batch Transactions
```php
$batches = PromisePay::BatchTransactions()->listTransactions();
```
##### Show Batch Transaction
```php
$batch = PromisePay::BatchTransactions()->showTransaction(
    'BATCH_TRANSACTION_ID'
);
```

## Charges
##### Create Charge
```php
$createCharge = PromisePay::Charges()->create(
    array
    (
        'account_id' => 'CARD_OR_BANK_ACCOUNT_ID',
        'amount' => 100,
        'email' => 'charged.user@email.com',
        'zip' => 90210,
        'country' => 'AUS',
        'device_id' => 'DEVICE_ID',
        'ip_address' => '49.229.186.182'
    )
);
```
##### List Charges
```php
$getList = PromisePay::Charges()->getList();
```
##### Show Charge
```php
$charge = PromisePay::Charges()->show('CHARGE_ID');
```
##### Show Charge Buyer
```php
$buyer = PromisePay::Charges()->showBuyer('CHARGE_ID');
```
##### Show Charge Status
```php
$status = PromisePay::Charges()->showStatus('CHARGE_ID');
```

## Marketplaces
##### Show Marketplace
```php
$marketplaces = PromisePay::Marketplaces()->show();
```

## Token Auth
##### Generate Card Token
```php
$cardToken = PromisePay::Token()->generateCardToken(
    array
    (
        'token_type' => 'card',
        'user_id' => 'USER_ID'
    )
);
```

## Direct Debit Authority

##### Create Direct Debit Authority
```php
$directDebitAuthority = PromisePay::DirectDebitAuthority()->create(
    array
    (
        'account_id' => 'ACCOUNT_ID',
        'amount'     => 100
    )
);
```

##### List Direct Debit Authority
```php
$getList = PromisePay::DirectDebitAuthority()->getList(
    array
    (
        'account_id' => 'BANK_ACCOUNT_ID'
    )
);
```

##### Show Direct Debit Authority
```php
$directDebitAuthority = PromisePay::DirectDebitAuthority()->show(
    'DIRECT_DEBIT_AUTHORITY_ID'
);
```

##### Delete Direct Debit Authority
```php
$deleteDirectDebitAuthority = PromisePay::DirectDebitAuthority()->delete(
    'DIRECT_DEBIT_AUTHORITY_ID'
);
```


## Companies

##### Create a company
```php
$company = PromisePay::Company()->create(array(
    'user_id'    => 'USER_ID',
    'legal_name' => 'Test edit company',
    'name'       => 'test company name edit',
    'country'    => 'AUS'
));
```

##### Get a company
```php
$company = PromisePay::Company()->get('COMPANY_ID');
```

##### Get a list of companies
```php
$companys = PromisePay::Company()->getList(array(
	'limit' => 20,
	'offset' => 0
));
```

##### Update a company
```php
$company = PromisePay::Company()->update('COMPANY_ID', array(
    'id' => "e466dfb4-f05c-4c7f-92a3-09a0a28c7af5",
    'user_id' => "1",
    'name' => "Acme Co",
    'legal_name' => "Acme Co Pty Ltd",
    'tax_number' => "1231231",
    'charge_tax' => true,
    'address_line1' => "123 Test St",
    'address_line2' => "",
    'city' => "Melbourne",
    'state' => "VIC",
    'zip' => "3000",
    'country' => "AUS"
));
```

## Fees
##### Get a list of fees
```php
$fees = PromisePay::Fee()->getList(array(
	'limit' => 20,
	'offset' => 0
));
```
##### Get a fee
```php
$fee = PromisePay::Fee()->get('FEE_ID');
```
##### Create a fee
```php
$fee = PromisePay::Fee()->create(array(
    'amount'      => 1000,
    'name'        => 'fee test',
    'fee_type_id' => '1',
    'cap'         => '1',
    'max'         => '3',
    'min'         => '2',
    'to'          => 'buyer'
));
```

## Transactions
##### Get a list of transactions
```php
$transactions = PromisePay::Transaction()->getList(array(
	'limit' => 20,
	'offset' => 0
));
```
##### Get a transaction
```php
$transaction = PromisePay::Transaction()->get('TRANSACTION_ID');
```
##### Get a transaction's user
```php
$user = PromisePay::Transaction()->getUser('TRANSACTION_ID');
```
##### Get a transaction's fee
```php
$fee = PromisePay::Transaction()->getFee('TRANSACTION_ID');
```
##### Show Transaction Wallet Account
```php
$walletAccount = PromisePay::Transaction()->getWalletAccount(
    'TRANSACTION_ID'
);
```
##### Show Transaction Card Account
```php
$cardAccount = PromisePay::Transaction()->getCardAccount(
    'TRANSACTION_ID'
);
```


## Addresses
##### Show Address
```php
$address = PromisePay::Address()->get('ADDRESS_ID');
```

## Tools
##### Health check
```php
$healthStatus = PromisePay::Tools()->getHealth();
```

## Configurations
##### Create Configuration
```php
$configuration = PromisePay::Configurations()->create(array(
    'name' => 'partial_refunds',
    'enabled' => true
));
```

##### Show Configuration
```php
$configuration = PromisePay::Configurations()->get('CONFIGURATION_ID');
```

##### List Configurations
```php
$configurations = PromisePay::Configurations()->getList();
```

##### Update Configuration
```php
$configuration = PromisePay::Configurations()->update(array(
    'id' => 'CONFIGURATION_ID',
    'max' => 12345,
    'name' => 'partial_refunds',
    'enabled' => true
));
```

##### Delete Configuration
```php
PromisePay::Configurations()->delete('CONFIGURATION_ID');
```

## Payment Restrictions
##### List Payment Restrictions
```php
$list = PromisePay::PaymentRestrictions()->getList();
```

##### Show Payment Restriction
```php
$paymentRestriction = PromisePay::PaymentRestrictions()->get('PAYMENT_RESTRICTION_ID');
```

## Callbacks
#### Create Callback
```php
$callback = PromisePay::Callbacks()->create(array(
    'description' => 'Users Callback',
    'url' => 'https://domain.tld/your/post/endpoint',
    'object_type' => 'users',
    'enabled' => true
));
```

#### List Callbacks
```php
$getList = PromisePay::Callbacks()->getList();
```

#### Show Callback
```php
$getCallback = PromisePay::Callbacks()->get('f92d4ca1-4ee5-43f3-9e34-ca5f759c5e76');
```

#### Update Callback
```php
$update = PromisePay::Callbacks()->update('f92d4ca1-4ee5-43f3-9e34-ca5f759c5e76', array(
    'description' => 'Users Callback',
    'url' => 'https://domain.tld/your/post/endpoint',
    'object_type' => 'users',
    'enabled' => false
));
```

#### Delete Callback
```php
$delete = PromisePay::Callbacks()->delete('f92d4ca1-4ee5-43f3-9e34-ca5f759c5e76');
```

#### List Callback Responses
```php
$callbackResponsesList = PromisePay::Callbacks()->getListResponses('f92d4ca1-4ee5-43f3-9e34-ca5f759c5e76');
```

#### Show Callback Response
```php
$callbackResponse = PromisePay::Callbacks()->getResponse(
    'f92d4ca1-4ee5-43f3-9e34-ca5f759c5e76',
    '4476b384-fa48-4473-98ec-8fcdda4a1e84'
);
```

# 4. Async and Wrappers
## Async
Asynchronous execution provides a significant speed improvement, as compared to synchronous execution.
```php
PromisePay::AsyncClient(
    function() {
        PromisePay::Token()->generateCardToken('CARD_TOKEN_ID');
    },
    function() {
        PromisePay::Transaction()->get('TRANSACTION_ID');
    },
    function() {
        PromisePay::Transaction()->getUser('USER_ID');
    },
    function() {
        PromisePay::BatchTransactions()->listTransactions();
    }
)->done(
    $cardToken,
    $transaction,
    $transactionUser,
    $batchTransactions
);
```
Response variables are placed inside `done()` method; they can be used both as arrays and objects, but using them as objects provides finer grained control. For example, the following will return equivalent data: `$cardToken['user_id']` and `$cardToken->getJson('user_id')`.

Response variables contain the following methods/getters:
   - `getJson()` -> full response JSON
   - `getMeta()` -> meta array extracted from response JSON, if present
   - `getLinks()` -> links array extracted from response JSON, if present
   - `getDebug()` -> response headers

## Wrappers
Two wrappers are available: `PromisePay::getAllResults()` and `PromisePay::getAllResultsAsync()`. They can be used to get all results from sets of result pages, instead of up to 200 per request. For example, they can be used to fetch all batch transactions at once. Note that these requests may take some time depending on amount requested. If getting all results is mandatory, no matter how big the size, use the synchronous version. For a faster version, use async version, but not all requests are guaranteed to be returned. Generally, asynchronous execution is fine for up to 20 pages, each containing up to 200 results, yielding 4000 results within a few seconds.

Synchronous execution
```php
$batchedTransactionsList = PromisePay::getAllResults(function($limit, $offset) {
    PromisePay::BatchTransactions()->listTransactions(
        array(
            'limit' => $limit,
            'offset' => $offset
        )
    );
});
```

Asynchronous execution
```php
$batchedTransactionsList = PromisePay::getAllResultsAsync(function($limit, $offset) {
    PromisePay::BatchTransactions()->listTransactions(
        array(
            'limit' => $limit,
            'offset' => $offset
        )
    );
});
```

# 5. Contributing
	1. Fork it ( https://github.com/PromisePay/promisepay-php/fork )
	2. Create your feature branch (`git checkout -b my-new-feature`)
	3. Commit your changes (`git commit -am 'Add some feature'`)
	4. Push to the branch (`git push origin my-new-feature`)
	5. Create a new Pull Request

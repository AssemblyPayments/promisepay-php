#PHP SDK - PromisePay API

[![Join the chat at https://gitter.im/NinoSkopac/promisepay-php](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/NinoSkopac/promisepay-php?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

[![Build Status](https://travis-ci.org/NinoSkopac/promisepay-php.svg)](https://travis-ci.org/NinoSkopac/promisepay-php) [![Latest Stable Version](https://poser.pugx.org/promisepay/promisepay-php/v/stable)](https://packagist.org/packages/promisepay/promisepay-php)
[![Total Downloads](https://poser.pugx.org/promisepay/promisepay-php/downloads)](https://packagist.org/packages/promisepay/promisepay-php)
 [![Code Climate](https://codeclimate.com/github/PromisePay/promisepay-php/badges/gpa.svg)](https://codeclimate.com/github/PromisePay/promisepay-php)

#1. Installation

###Composer

You can include this package via Composer.

```json
{
  "require": {
    "promisepay/promisepay-php": "1.*"
  }
}
```

Install the package.

	composer install
	
Require the package.

```php
require init.php
```

###Manual Installation
Download the latest release from GitHub, then include the **init.php** file - see below.

```php
require init.php
```

### Prerequisites

   - PHP 5.3 or above
   - [curl](http://php.net/manual/en/book.curl.php) and [json](http://php.net/manual/en/book.json.php)  extensions must be enabled
   

#2. Configuration
Before interacting with PromisePay API, you need to generate an API token. See [http://docs.promisepay.com/v2.2/docs/request_token](http://docs.promisepay.com/v2.2/docs/request_token) for more information.

Once you have recorded your API token, configure the PHP package - see below.

Open the file **SDK_Config.php** and replace the existing credentials with the following:

```php
define(__NAMESPACE__ . '\API_LOGIN', 'YOUR EMAIL ADDRESS');
define(__NAMESPACE__ . '\API_PASSWORD', 'YOUR API PASSWORD');

/*
 * SUPPORTED ENVIRONMENT VALUES
 *
 * Test environment:        https://test.api.promisepay.com/
 * Production environment:  https://secure.api.promisepay.com/
*/
define(__NAMESPACE__ . '\API_URL', 'TEST OR PRODUCTION ENVIRONMENT URL');

```

#3. Examples
##Tokens
##### Example 1 - Request session token
The below example shows the request for a marketplace configured to have the Item and User IDs generated automatically for them.

```php
//TODO
```

#####Example 2 - Request session token
The below example shows the request for a marketplace that passes the Item and User IDs.

```php
//TODO
```
##Items

#####Create an item

```php
$itemData = array(
    "id"              => 'ITEM_ID',
    "name"            => 'Test Item #1',
    "amount"          => 1000,
    "payment_type_id" => 1,
    "buyer_id"        => 'BUYER_ID',
    "seller_id"       => 'SELLER_ID',
    "description"     => 'Description'
);

$createItem = PromisePay::Item()->create($itemData);
```
#####Get an item

```php
$getItem = PromisePay::Item()->get('ITEM_ID');
```
#####Get a list of items
```php
$fetchList = PromisePay::Item()->getList(200, 0); //limit, offset
```
#####Update an item
```php
$itemData = array(
    "id"              => 'ITEM_ID',
    "name"            => 'Test Item #1',
    "amount"          => 1000,
    "payment_type_id" => 1,
    "buyer_id"        => 'BUYER_ID',
    "seller_id"       => 'SELLER_ID',
    "description"     => 'Description'
);

$createItem = PromisePay::Item()->update($itemData);
```

#####Delete an item
```php
$deleteItem = PromisePay::Item()->delete('ITEM_ID');
```

#####Get an item status
```php
$itemStatus = PromisePay::Item()->getStatus('ITEM_ID');
```

#####Get an item's buyer
```php
//TODO
```

#####Get an item's seller
```php
//TODO
```

#####Get an item's fees
```php
//TODO
```

#####Get an item's transactions
```php
//TODO
```

#####Get an item's wire details
```php
$wireDetails = PromisePay::Item()->getWireDetails('ITEM_ID');
```

#####Get an item's BPAY details
```php
$bPayDetails = PromisePay::Item()->getBPayDetails('ITEM_ID');
```


##Users

#####Create a user
```php
$userData = array(
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
);
$createUser = PromisePay::User()->create($userData);
```
#####Get a user
```php
$getUser = PromisePay::User()->get('USER_ID');
```
#####Get a list of users
```php
$usersList = PromisePay::User()->getList(200, 0); //limit, offset
```
#####Update a user
```php
$userData = array(
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
);
$updateUser = PromisePay::User()->update('USER_ID', $userData);
```
#####Get a user's card accounts
```php
$userCardAccounts = PromisePay::User()->getListOfCardAccounts('USER_ID');
```
#####Get a user's PayPal accounts
```php
$userPayPalAccounts = PromisePay::User()->getListOfPayPalAccounts('USER_ID');
```

#####Get a user's bank accounts
```php
$userBankAccounts = PromisePay::User()->getListOfBankAccounts('USER_ID');
```
#####Get a user's items
```php
$getListOfItems = PromisePay::User()->getListOfItems('USER_ID');
```
#####Set a user's disbursement account
```php
//TODO
```

##Item Actions

#####Make payment

```php
//TODO
```
#####Request payment
```php
//TODO
```
#####Release payment
```php
//TODO
```
#####Request release
```php
//TODO
```
#####Cancel
```php
//TODO
```
#####Acknowledge wire
```php
//TODO
```
#####Acknowledge PayPal
```php
//TODO
```
#####Revert wire
```php
//TODO
```
#####Request refund
```php
//TODO
```
#####Refund
```php
//TODO
```

##Card Accounts
#####Create a card account

```php
$cardAccountData = array(
   'user_id'      => 'USER_ID',
   'full_name'    => 'Bobby Buyer',
   'number'       => '4111111111111111',
   "expiry_month" => '06',
   "expiry_year"  => '2020',
   "cvv"          => '123'
);
$createAccount = PromisePay::CardAccount()->create($cardAccountData);
```

#####Get a card account
```php
$fetchCardAccount = PromisePay::CardAccount()->get('CARD_ACCOUNT_ID');
```
#####Delete a card account
```php
$deleteCardAccount = PromisePay::CardAccount()->delete('CARD_ACCOUNT_ID');
```
#####Get a card account's users
```php
$getList = PromisePay::CardAccount()->getUser('CARD_ACCOUNT_ID');
```

##Bank Accounts
#####Create a bank account

```php
$bankAccountData = array(
    "user_id"        => 'USER_ID',
    "active"         => 'true',
    "bank_name"      => 'bank for test',
    "account_name"   => 'test acc',
    "routing_number" => '12344455512',
    "account_number" => '123334242134',
    "account_type"   => 'savings',
    "holder_type"    => 'personal',
    "country"        => 'USA',
);

$createBankAccount = PromisePay::BankAccount()->create($bankAccountData);
```
#####Get a bank account
```php
$bankAccountLookup = PromisePay::BankAccount()->get('BANK_ACCOUNT_ID');
```
#####Delete a bank account
```php
$deleteBankAccount = PromisePay::BankAccount()->delete('BANK_ACCOUNT_ID');
```
#####Get a bank account's users
```php
$getUser = PromisePay::BankAccount()->getUser('BANK_ACCOUNT_ID');
```

##PayPal Accounts
#####Create a PayPal account
```php
$payPalData = array(
    'user_id'      => 'USER_ID',
    'paypal_email' => 'test@paypalname.com'
);
$createPayPalAccount = PromisePay::PayPalAccount()->create($payPalData);
``` 
#####Get a PayPal account
```php
$getPayPalAccount = PromisePay::PayPalAccount()->get('PAYPAL_ACCOUNT_ID');
```
#####Delete a PayPal account
```php
$deletePayPalAccount = PromisePay::PayPalAccount()->delete('PAYPAL_ACCOUNT_ID');
```
#####Get a PayPal account's users
```php
$getUser = PromisePay::PayPalAccount()->getUser('PAYPAL_ACCOUNT_ID');
```

##Companies

#####Create a company
```php
$companyInfo = array(
    'user_id'    => 'USER_ID',
    'legal_name' => 'Test edit company',
    'name'       => 'test company name edit',
    'country'    => 'AUS'
);

$companyCreate = PromisePay::Company()->create($companyInfo);
```

#####Get a company
```php
$companyData = PromisePay::Company()->get('COMPANY_ID');
```

#####Get a list of companies
```php
$companiesList = PromisePay::Company()->getList(200, 0); // limit, offset
```

#####Update a company
```php
$companyInfo = array(
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
);
$companyUpdate = PromisePay::Company()->update('COMPANY_ID', $companyInfo);
```

##Fees
#####Get a list of fees
```php
$getList = PromisePay::Fee()->getList(200, 0); // limit, offset
```
#####Get a fee
```php
$getFeeById = PromisePay::Fee()->get('FEE_ID');
```
#####Create a fee
```php
$feeData = array(
    'amount'      => 1000,
    'name'        => 'fee test',
    'fee_type_id' => '1',
    'cap'         => '1',
    'max'         => '3',
    'min'         => '2',
    'to'          => 'buyer'
);
$createFee = PromisePay::Fee()->create($feeData);
```

##Transactions
#####Get a list of transactions
```php
//TODO
```
#####Get a transaction
```php
//TODO
```
#####Get a transaction's users
```php
//TODO
```
#####Get a transaction's fees
```php
//TODO
```

#4. Contributing
	1. Fork it ( https://github.com/PromisePay/promisepay-php/fork )
	2. Create your feature branch (`git checkout -b my-new-feature`)
	3. Commit your changes (`git commit -am 'Add some feature'`)
	4. Push to the branch (`git push origin my-new-feature`)
	5. Create a new Pull Request
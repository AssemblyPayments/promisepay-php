#PHP SDK - PromisePay API

[![Join the chat at https://gitter.im/PromisePay/promisepay-php](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/NinoSkopac/promisepay-php?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

[![Build Status](https://travis-ci.org/PromisePay/promisepay-php.svg)](https://travis-ci.org/NinoSkopac/promisepay-php) [![Latest Stable Version](https://poser.pugx.org/promisepay/promisepay-php/v/stable)](https://packagist.org/packages/promisepay/promisepay-php)
[![Total Downloads](https://poser.pugx.org/promisepay/promisepay-php/downloads)](https://packagist.org/packages/promisepay/promisepay-php)
[![Code Climate](https://codeclimate.com/github/PromisePay/promisepay-php/badges/gpa.svg)](https://codeclimate.com/github/PromisePay/promisepay-php)

 Note: The api only responds to the models which are included with the php package.

#1. Installation

###Composer

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

###Manual Installation
Download the latest release from GitHub, then require the package in the relevant controller.

```php
use PromisePay;
```

### Prerequisites

   - PHP 5.3 or above
   - [curl](http://php.net/manual/en/book.curl.php) and [json](http://php.net/manual/en/book.json.php)  extensions must be enabled
   

#2. Configuration
Before interacting with PromisePay API, you need to generate an API token. See [http://docs.promisepay.com/v2.2/docs/request_token](http://docs.promisepay.com/v2.2/docs/request_token) for more information.

Afterwards, you need to declare environment, login (your email address) and password (token), thus:

```php
PromisePay::Configuration()->environment('prelive'); // Use 'production' for the production environment.
PromisePay::Configuration()->login('your_email_address');
PromisePay::Configuration()->password('your_token');
```


#3. Examples
##Tokens
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

#####Example 2 - Request session token
The below example shows the request for a marketplace that passes the Item and User IDs.

```php
$token = PromisePay::Token()->requestSessionToken(array(
	'current_user_id'        => 'seller1234',
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
	'external_item_id'       => 'TestItemId1234',
	'external_seller_id'     => 'seller1234',
	'external_buyer_id'      => 'buyer1234',
	'fee_ids'                => '',
	'payment_type_id'        => '2'
));
```
##Items

#####Create an item

```php
$item = PromisePay::Item()->create(array(
    "id"              => 'ITEM_ID',
    "name"            => 'Test Item #1',
    "amount"          => 1000,
    "payment_type_id" => 1,
    "buyer_id"        => 'BUYER_ID',
    "seller_id"       => 'SELLER_ID',
    "description"     => 'Description'
));
```
#####Get an item

```php
$item = PromisePay::Item()->get('ITEM_ID');
```
#####Get a list of items
```php
$items = PromisePay::Item()->getList(array(
	'limit' => 20,
	'offset' => 0
));
```
#####Update an item
```php
$item = PromisePay::Item()->update('ITEM_ID', array(
    "id"              => 'ITEM_ID',
    "name"            => 'Test Item #1',
    "amount"          => 1000,
    "payment_type_id" => 1,
    "buyer_id"        => 'BUYER_ID',
    "seller_id"       => 'SELLER_ID',
    "description"     => 'Description'
));
```

#####Delete an item
```php
$item = PromisePay::Item()->delete('ITEM_ID');
```

#####Get an item status
```php
$item = PromisePay::Item()->getStatus('ITEM_ID');
```

#####Get an item's buyer
```php
$user = PromisePay::Item()->getBuyer('ITEM_ID');
```

#####Get an item's seller
```php
$user = PromisePay::Item()->getSeller('ITEM_ID');
```

#####Get an item's fees
```php
$fees = PromisePay::Item()->getListOfFees('ITEM_ID');
```

#####Get an item's transactions
```php
$transactions = PromisePay::Item()->getListOfTransactions('ITEM_ID');
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
#####Get a user
```php
$user = PromisePay::User()->get('USER_ID');
```
#####Get a list of users
```php
$users = PromisePay::User()->getList(array(
	'limit' => 20,
	'offset' => 0
));
```
#####Update a user
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
#####Get a user's card accounts
```php
$accounts = PromisePay::User()->getListOfCardAccounts('USER_ID');
```
#####Get a user's PayPal accounts
```php
$accounts = PromisePay::User()->getListOfPayPalAccounts('USER_ID');
```

#####Get a user's bank accounts
```php
$accounts = PromisePay::User()->getListOfBankAccounts('USER_ID');
```
#####Get a user's items
```php
$items = PromisePay::User()->getListOfItems('USER_ID');
```
#####Set a user's disbursement account
```php
$account = PromisePay::User()->setDisbursementAccount('ACCOUNT_ID');
```

##Item Actions

#####Make payment

```php
$item = PromisePay::Item()->makePayment('ITEM_ID', array(
	'account_id' => 'BUYER_ACCOUNT_ID'
));
```
#####Request payment
```php
$item = PromisePay::Item()->requestPayment('ITEM_ID');
```
#####Release payment
```php
$item = PromisePay::Item()->releasePayment('ITEM_ID');
```
#####Request release
```php
$item = PromisePay::Item()->requestRelease('ITEM_ID');
```
#####Cancel
```php
$item = PromisePay::Item()->cancelItem('ITEM_ID');
```
#####Acknowledge wire
```php
$item = PromisePay::Item()->acknowledgeWire('ITEM_ID');
```
#####Acknowledge PayPal
```php
$item = PromisePay::Item()->acknowledgePayPal('ITEM_ID');
```
#####Revert wire
```php
$item = PromisePay::Item()->revertWire('ITEM_ID');
```
#####Request refund
```php
$item = PromisePay::Item()->requestRefund('ITEM_ID', array(
	'refund_amount' => 1000,
	'refund_message' => 'Refund please.'
));
```
#####Refund
```php
$item = PromisePay::Item()->refund('ITEM_ID', array(
	'refund_amount' => 1000,
	'refund_message' => 'Refund please.'
));
```

##Card Accounts
#####Create a card account

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

#####Get a card account
```php
$account = PromisePay::CardAccount()->get('CARD_ACCOUNT_ID');
```
#####Delete a card account
```php
$account = PromisePay::CardAccount()->delete('CARD_ACCOUNT_ID');
```
#####Get a card account's users
```php
$user = PromisePay::CardAccount()->getUser('CARD_ACCOUNT_ID');
```

##Bank Accounts
#####Create a bank account

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
#####Get a bank account
```php
$account = PromisePay::BankAccount()->get('BANK_ACCOUNT_ID');
```
#####Delete a bank account
```php
$account = PromisePay::BankAccount()->delete('BANK_ACCOUNT_ID');
```
#####Get a bank account's users
```php
$user = PromisePay::BankAccount()->getUser('BANK_ACCOUNT_ID');
```
#####Validate Routing Number
```php
$validateRoutingNumber = PromisePay::BankAccount()->validateRoutingNumber(
    122235821
);
```

##PayPal Accounts
#####Create a PayPal account
```php
$account = PromisePay::PayPalAccount()->create(array(
    'user_id'      => 'USER_ID',
    'paypal_email' => 'test@paypalname.com'
));
``` 
#####Get a PayPal account
```php
$account = PromisePay::PayPalAccount()->get('PAYPAL_ACCOUNT_ID');
```
#####Delete a PayPal account
```php
$account = PromisePay::PayPalAccount()->delete('PAYPAL_ACCOUNT_ID');
```
#####Get a PayPal account's users
```php
$user = PromisePay::PayPalAccount()->getUser('PAYPAL_ACCOUNT_ID');
```

##Companies

#####Create a company
```php
$company = PromisePay::Company()->create(array(
    'user_id'    => 'USER_ID',
    'legal_name' => 'Test edit company',
    'name'       => 'test company name edit',
    'country'    => 'AUS'
));
```

#####Get a company
```php
$company = PromisePay::Company()->get('COMPANY_ID');
```

#####Get a list of companies
```php
$companys = PromisePay::Company()->getList(array(
	'limit' => 20,
	'offset' => 0
));
```

#####Update a company
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

##Fees
#####Get a list of fees
```php
$fees = PromisePay::Fee()->getList(array(
	'limit' => 20,
	'offset' => 0
));
```
#####Get a fee
```php
$fee = PromisePay::Fee()->get('FEE_ID');
```
#####Create a fee
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

##Transactions
#####Get a list of transactions
```php
$transactions = PromisePay::Transaction()->getList(array(
	'limit' => 20,
	'offset' => 0
));
```
#####Get a transaction
```php
$transaction = PromisePay::Transaction()->get('TRANSACTION_ID');
```
#####Get a transaction's user
```php
$user = PromisePay::Transaction()->getUser('TRANSACTION_ID');
```
#####Get a transaction's fee
```php
$fee = PromisePay::Transaction()->getFee('TRANSACTION_ID');
```

#4. Contributing
	1. Fork it ( https://github.com/PromisePay/promisepay-php/fork )
	2. Create your feature branch (`git checkout -b my-new-feature`)
	3. Commit your changes (`git commit -am 'Add some feature'`)
	4. Push to the branch (`git push origin my-new-feature`)
	5. Create a new Pull Request

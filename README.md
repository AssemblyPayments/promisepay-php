#PHP SDK - PromisePay API

[![Join the chat at https://gitter.im/PromisePay/promisepay-php](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/PromisePay/promisepay-php?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

[![PHP version](https://badge.fury.io/ph/PromisePay%2Fpromisepay-php.svg)](http://badge.fury.io/ph/PromisePay%2Fpromisepay-php)
[![Build Status](https://travis-ci.org/PromisePay/promisepay-php.svg)](https://travis-ci.org/PromisePay/promisepay-php) [![Code Climate](https://codeclimate.com/github/PromisePay/promisepay-php/badges/gpa.svg)](https://codeclimate.com/github/PromisePay/promisepay-php)

#1. Installation
Download the latest release from GitHub, then include the **init.php** file - see below.

	require init.php

#2. Configuration
Before interacting with PromisePay API, you need to generate an API token. See [http://docs.promisepay.com/v2.2/docs/request_token](http://docs.promisepay.com/v2.2/docs/request_token) for more information.

Once you have recorded your API token, configure the PHP package - see below.

Open the file **libs/promisepay-credentials.xml** and replace the existing credentials with the following:

```xml
	<?xml version='1.0'?>
		<ApiCredentials>
   			<ApiUrl>https://test.api.promisepay.com/</ApiUrl>
   			<ApiLogin>user.name@yourdomain.com</ApiLogin>
   			<ApiPassword>Password</ApiPassword>
   			<ApiKey>APIToken</ApiKey>
	</ApiCredentials>
```

#3. Examples
##Tokens
##### Example 1 - Request session token
The below example shows the request for a marketplace configured to have the Item and User IDs generated automatically for them.

```php
$repo = new TokenRepository();
$sessionToken = new Token($arr = array(
			   'current_user' 			=> 'seller',
           	   'item_name'				=> 'Test Item',
          		   'amount'					=> '2500',
           	   'seller_lastname' 		=> 'Seller',
           	   'seller_firstname'		=> 'Sally',
           	   'buyer_lastname'			=> 'Buyer',
           	   'buyer_firstname'		=> 'Bobby',
           	   'buyer_country'			=> 'AUS',
           	   'seller_country'			=> 'USA',
           	   'seller_email'			=> 'sally.seller@promisepay.com',
           	   'buyer_email'			=> 'bobby.buyer@promisepay.com',
           	   'fee_ids'				=> '',
           	   'payment_type_id'		=> '2'))
$repo->requestSessionToken($sessionToken)
```

#####Example 2 - Request session token
The below example shows the request for a marketplace that passes the Item and User IDs.

```php
$repo = new TokenRepository();
$sessionToken = new Token($arr = array(
			   'current_user_id' 		=> 'seller1234',
           	   'item_name'				=> 'Test Item',
          		   'amount'					=> '2500',
           	   'seller_lastname' 		=> 'Seller',
           	   'seller_firstname'		=> 'Sally',
           	   'buyer_lastname'			=> 'Buyer',
           	   'buyer_firstname'		=> 'Bobby',
           	   'buyer_country'			=> 'AUS',
           	   'seller_country'			=> 'USA',
           	   'seller_email'			=> 'sally.seller@promisepay.com',
           	   'buyer_email'			=> 'bobby.buyer@promisepay.com',
           	   'external_item_id'		=> 'TestItemId1234',
           	   'external_seller_id'		=> 'seller1234',
           	   'external_buyer_id'		=> 'buyer1234',
           	   'fee_ids'				=> '',
           	   'payment_type_id'		=> '2'))
$repo->requestSessionToken($sessionToken)
```
##Items

#####Create an item

```php
$repo = new ItemRepository();
$user = new Item($arr = array(
           'id'            => 'External_id',
           'name'          => 'Item Name',
           'amount'        => '2000',
           'payment_type'  => '1',
           'buyer_id'      => 'External_buyer_id',
           'seller_id'     => 'External_seller_id',
           'fee_ids'       => 'fee_id_1,fee_id_2',
           'description'   => 'Item Description'));
$repo->createItem($user)
```
#####Get an item
#####Get a list of items
#####Update an item
#####Delete an item
#####Get an item status
#####Get an item's buyer
#####Get an item's seller
#####Get an item's fees
#####Get an item's transactions
#####Get an item's wire details
#####Get an item's BPAY details

##Users

#####Create a user

```php
$repo = new UserRepository();
$user = new User($arr = array(
           'id'            => id,
           'first_name'    => 'First Name',
           'last_name'     => 'Last Name',
           'email'         => 'email'
           'mobile'        => 'mobile phone'
           'address_line1' => 'a line 1',
           'address_line2' => 'a line 2',
           'state'         => 'state',
           'city'          => 'city',
           'zip'           => '90210',
           'country'       => 'AUS'//country code,));
$repo->createUser($user)
```

#####Get a user
#####Get a list of users

```php
var repo = container.Resolve<IUserRepository>();
var users = repo.ListUsers();
```

#####Delete a User
#####Get a user's card accounts
#####Get a user's PayPal accounts
#####Get a user's bank accounts
#####Get a user's items
#####Set a user's disbursement account

##Item Actions
#####Make payment

```php
$repo = new ItemRepository();
$repo->makePayment('External_item_id', 'Card_account_id', 'User_id')
```

#####Request payment
#####Release payment
#####Request release
#####Cancel
#####Acknowledge wire
#####Acknowledge PayPal
#####Revert wire
#####Request refund
#####Refund

##Card Accounts
#####Create a card account

```php
$repo = new CardAccountRepository();
$user = new CardAccount($arr = array(
           'user_id'       => id,
           'full_name'     => 'Bobby Buyer',
           'number'        => '4111111111111111',
           'expiry_month'  => '06'
           'expiry_year'   => '2016'
           'cvv' 			=> '123'));
$repo->createCardAccount($user)
```

#####Get a card account
#####Delete a card account
#####Get a card account's users

##Bank Accounts
#####Create a bank account

```php
$repo = new BankAccountRepository();
$bankAccount = new BankAccount($arr = array(
			   'user_id' 			=> 'External_seller_id',
           	   'bank_name'			=> 'Test Bank',
          		   'account_name'		=> 'Sally Seller',
           	   'routing_number' 	=> '123456',
           	   'account_number'		=> '12345678',
           	   'account_type'		=> 'checking',
           	   'holder_type'		=> 'personal',
           	   'bank_country'		=> 'AUS'))
$repo->createBankAccount($bankAccount)
```

#####Get a bank account
#####Delete a bank account
#####Get a bank account's users

##PayPal Accounts
#####Create a PayPal account
#####Get a PayPal account
#####Delete a PayPal account
#####Get a PayPal account's users

##Fees
#####Get a list of fees
#####Get a fee
#####Create a fee

##Transactions
#####Get a list of transactions
#####Get a transactions
#####Get a transaction's users
#####Get a transaction's fees

#4. Contributing
	1. Fork it ( https://github.com/PromisePay/promisepay-php/fork )
	2. Create your feature branch (`git checkout -b my-new-feature`)
	3. Commit your changes (`git commit -am 'Add some feature'`)
	4. Push to the branch (`git push origin my-new-feature`)
	5. Create a new Pull Request

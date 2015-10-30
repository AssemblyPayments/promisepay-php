#PHP SDK - PromisePay API

[![Join the chat at https://gitter.im/PromisePay/promisepay-php](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/PromisePay/promisepay-php?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

[![Build Status](https://travis-ci.org/PromisePay/promisepay-php.svg)](https://travis-ci.org/PromisePay/promisepay-php) [![Latest Stable Version](https://poser.pugx.org/promisepay/promisepay-php/v/stable)](https://packagist.org/packages/promisepay/promisepay-php)
[![Total Downloads](https://poser.pugx.org/promisepay/promisepay-php/downloads)](https://packagist.org/packages/promisepay/promisepay-php)
 [![Code Climate](https://codeclimate.com/github/PromisePay/promisepay-php/badges/gpa.svg)](https://codeclimate.com/github/PromisePay/promisepay-php)

 Note: The api only responds to the models which are included with the php package.

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

Require the package in the controller where you'll be using it.

```php
use PromisePay;
```

###Manual Installation
Download the latest release from GitHub, then require the package in the relevant controller.

```php
use PromisePay;
```

#2. Configuration
Before interacting with PromisePay API, you need to generate an API token. See [http://docs.promisepay.com/v2.2/docs/request_token](http://docs.promisepay.com/v2.2/docs/request_token) for more information.

Once you have recorded your API token, configure the PHP package - see below.

Open the file **vendor/promisepay/promisepay-php/libs/promisepay-credentials.xml** and replace the existing credentials with your account information:

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
          	   'amount'		            => '2500',
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

```php
$repo = new ItemRepository();
$item = $repo->getItemById('item_id');
```
#####Get a list of items
```php
$repo = new ItemRepository();
$listOfItems = $repo->getListOfItems(20, 0); // limit, offset
```
#####Update an item
```php
$repo = new ItemRepository();
$item = new Item($arr = array(
           'id'            => 'External_id',
           'name'          => 'Item Name',
           'amount'        => '2000',
           'payment_type'  => '1',
           'buyer_id'      => 'External_buyer_id',
           'seller_id'     => 'External_seller_id',
           'fee_ids'       => 'fee_id_1,fee_id_2',
           'description'   => 'Item Description'));
$repo->updateItem($item, 'user', 'account', 'release_amount');
```

#####Delete an item
```php
$repo = new ItemRepository();
$repo->deleteItem('item_id');
```

#####Get an item status
```php
$repo = new ItemRepository();
$repo->getItemStatus('item_id');
```

#####Get an item's buyer
```php
$repo = new ItemRepository();
$buyer = $repo->getBuyerOfItem('item_id');
```

#####Get an item's seller
```php
$repo = new ItemRepository();
$seller = $repo->getSellerForItem('item_id');
```

#####Get an item's fees
```php
$repo = new ItemRepository();
$fees = $repo->getListFeesForItems('item_id');
```

#####Get an item's transactions
```php
$repo = new ItemRepository();
$transactions = $repo->getListOfTransactionsForItem('item_id');
```

#####Get an item's wire details
```php
$repo = new ItemRepository();
$wireDetails = $repo->getWireDetailsForItem('item_id');
```

#####Get an item's BPAY details
```php
$repo = new ItemRepository();
$bpayDetails = $repo->getBPayDetailsForItem('item_id');
```


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
           'country'       => 'AUS'));
$repo->createUser($user)
```
#####Get a user
```php
$repo = new UserRepository();
$user = $repo->getUserById('User id');
```
#####Get a list of users
```php
$repo = new UserRepository();
$users = $repo->getListOfUsers(20, 0); // limit, offset
```
#####Update a user
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
           'country'       => 'AUS'));
$repo->updateUser($user)
```
#####Delete a User
```php
$repo = new UserRepository();
$repo->deleteUser('User_id');
```
#####Get a user's card accounts
```php
$repo = new UserRepository();
$usersCardAccounts = $repo->getListOfCardAccountsForUser('User_id');
```
#####Get a user's PayPal accounts
```php
$repo = new UserRepository();
$usersPayPalAccounts = $repo->getListOfPayPalAccountsForUser('User_id');
```

#####Get a user's bank accounts
```php
$repo = new UserRepository();
$usersBankAccounts = $repo->getListOfBankAccountsForUser('User_id');
```
#####Get a user's items
```php
$repo = new UserRepository();
$items = $repo->getListOfItemsForUser('User_id');
```
#####Set a user's disbursement account
```php
$repo = new UserRepository();
$repo->setDisbursementAccount('user_id', 'account_id');
```

##Item Actions

#####Make payment

```php
$repo = new ItemRepository();
$repo->makePayment('Item_id', 'Card_account_id')
```
#####Request payment
```php
$repo = new ItemRepository();
$requestPayment = $repo->requestPayment('Item_id');
```
#####Release payment
```php
$repo = new ItemRepository();
$releasePayment = $repo->releasePayment('Item_id', 'Release amount');
```
#####Request release
```php
$repo = new ItemRepository();
$requestRelease = $repo->requestRelease('Item_id', 'Release amount');
```
#####Cancel
```php
$repo = new ItemRepository();
$repo->cancelItem('Item_id');
```
#####Acknowledge wire
```php
$repo = new ItemRepository();
$acknowledgeWire = $repo->acknowledgeWire('Item_id');
```
#####Acknowledge PayPal
```php
$repo = new ItemRepository();
$acknowledgePayPal = $repo->acknowledgePayPal('Item_id');
```
#####Revert wire
```php
$repo = new ItemRepository();
$repo->revertWire('Item_id');
```
#####Request refund
```php
$repo = new ItemRepository();
$repo->requestRefund('Item_id', 'Refund amount', 'Refund message');
```
#####Refund
```php
$repo = new ItemRepository();
$repo = refund('Item id', 'Refund Amount', 'Refund message')
```

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
```php
$repo = new CardAccountRepository();
$card = $repo->getCardAccountById('Account_id')
```
#####Delete a card account
```php
$repo = new CardAccountRepository();
$repo->deleteCardAccount('Account_id')
```
#####Get a card account's users
```php
$repo = new CardAccountRepository();
$users = $repo->getUserForCardAccount('Card Account');
```

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
           	   'country'		=> 'AUS'))
$repo->createBankAccount($bankAccount)
```
#####Get a bank account
```php
$repo = new BankAccountRepository();
$bankAccount = $repo->getBankAccountById('Account_id');
```
#####Delete a bank account
```php
$repo = new BankAccountRepository();
$repo->deleteBankAccount('Account_id');
```
#####Get a bank account's users
```php
$repo = new BankAccountRepository();
$user = $repo->getUserForBankAccount('Account_id');
```

##PayPal Accounts
#####Create a PayPal account
```php
$repo  = new PayPalAccountRepository();
$params  = array(
    'user_id'=> 'User id',
    'active'=>'true',
    'paypal'=>array(
        'email'=>'User email'
        )
    );
$ppalAccount = new PayPalAccount($params);
$repo->createPayPalAccount($ppalAccount);
```
#####Get a PayPal account
```php
$repo = new PayPalAccountRepository();
$paypalAccount = $repo->getPayPalAccountById('account_id');
```
#####Delete a PayPal account
```php
$repo = new PayPalAccountRepository();
$repo->deletePayPalAccount('Account id')
```
#####Get a PayPal account's users
```php
$repo = new PayPalAccountRepository();
$users = $repo->getUserForPayPalAccount('Account id')
```

##Companies

#####Create a company
```php
$repo = new CompanyRepository();
$params = array(
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
$company = new Company($params);
$repo->createCompany($company);
```

#####Get a company
```php
$repo = new CompanyRepository();
$company = $repo->getCompanyById('company_id');
```

#####Get a list of companies
```php
$repo = new CompanyRepository();
$company = $repo->getListOfCompanies(20, 0); // limit, offset
```

#####Update a company
```php
$repo = new CompanyRepository();
$params = array(
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
$company = new Company($params);
$repo->updateCompany($company);
```

##Fees
#####Get a list of fees
```php
$repo = new FeeRepository();
$fees = $repo->getListOfFees(20, 0); // limit, offset
```
#####Get a fee
```php
$repo = new FeeRepository();
$fee = $repo->getFeeById('Fee id');
```
#####Create a fee
```php
$enum = new FeeType();
$repo = new FeeRepository();
$data = array(
    'id'=>'fee id',
    'amount'=>1000,
    'name'=>'fee name',
    'fee_type'=>$enum->Fixed,
    'cap'=>'1',
    'max'=>'3',
    'min'=>'2',
    'to'=>'buyer'
    );
$fee = new Fee($data);
$repo->createFee($fee);
```

##Transactions
#####Get a list of transactions
```php
$repo = new TransactionRepository();
$trans = $repo->getListOfTransactions(20, 0); // limit, offset
```
#####Get a transaction
```php
$repo = new TransactionRepository();
$transaction = $repo->getTransaction('transaction_id');
```
#####Get a transaction's users
```php
$repo = new TransactionRepository();
$users = $repo->getUserForTransaction('transaction id');
```
#####Get a transaction's fees
```php
$repo = new TransactionRepository();
$fees = $repo->getFeeForTransaction('transaction id');
```

#4. Contributing
	1. Fork it ( https://github.com/PromisePay/promisepay-php/fork )
	2. Create your feature branch (`git checkout -b my-new-feature`)
	3. Commit your changes (`git commit -am 'Add some feature'`)
	4. Push to the branch (`git push origin my-new-feature`)
	5. Create a new Pull Request

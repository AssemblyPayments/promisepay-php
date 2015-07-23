
#PHP SDK - PromisePay API

#1. Installation
Download the latest release from GitHub, then include the **init.php** file - see below.

	require init.php

#2. Configuration
Before interacting with PromisePay API, you need to generate an API token. See [http://docs.promisepay.com/v2.2/docs/request_token](http://docs.promisepay.com/v2.2/docs/request_token) for more information.

Once you have recorded your API token, configure the PHP package - see below.

Open the file **libs/promisepay-credentials.xml** and replace the existing credentials with the following:

		<?xml version='1.0'?>
 		<ApiCredentials>
    			<ApiUrl>https://test.api.promisepay.com/</ApiUrl>
    			<ApiLogin>user.name@yourdomain.com</ApiLogin>
    			<ApiPassword>Password</ApiPassword>
    			<ApiKey>APIToken</ApiKey>
		</ApiCredentials>
	
#3. Examples
**Create a user**

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
	
**Create a card account**

	$repo = new CardAccountRepository();
	$user = new CardAccount($arr = array(
            'user_id'       => id,
            'full_name'     => 'Bobby Buyer',
            'number'        => '4111111111111111',
            'expiry_month'  => '06'
            'expiry_year'   => '2016'
            'cvv' 			=> '123'));
	$repo->createCardAccount($user)
	
**Create an item**

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
	
**Make a payment**

	$repo = new ItemRepository();
	$repo->makePayment('External_item_id', 'Card_account_id', 'User_id')
	
**Create a bank account**

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

**Assign as payout account**

To be finished.



#4. Contributing
	#1. Fork it ( https://github.com/PromisePay/promisepay-php/fork )
	#2. Create your feature branch (`git checkout -b my-new-feature`)
	#3. Commit your changes (`git commit -am 'Add some feature'`)
	#4. Push to the branch (`git push origin my-new-feature`)
	#5. Create a new Pull Request

# promisepay-php
PHP package for integration with PromisePay API
1. Installation
download latest sources from GitHub, require init.php
2. Usage 
	Before interacting with Promispay API, you need to generate an access token.
	See http://docs.promisepay.com/v2.2/docs/request_token for more information.
3. Client
	3.1 Base Settings
		create promise-pay credetials config file
		<?xml version='1.0'?>
 		<ApiCredentials>
    			<ApiUrl>API URL</ApiUrl>
    			<ApiLogin>API User Name</ApiLogin>
    			<ApiPassword>Api password</ApiPassword>
    			<ApiKey>Api  Key</ApiKey>
		</ApiCredentials>
	Then require init.php in your app. 		
	3.2 Examples
		Creating user
	$repo = new UserRepository();
	$user = new User($arr =array(
            "id"            => id,
            "first_name"    => 'First Name',
            "last_name"     => 'Last Name',
            "email"         => 'email'
            "mobile"        => 'mobile phone'
            "address_line1" => 'a line 1',
            "address_line2" => 'a line 2',
            "state"         => 'state',
            "city"          => 'city',
            "zip"           => '90210',
            "country"       => 'AUS'//country code,));
	$repo->createUser($user)

4. Contibuting 
	1. Fork it ( https://github.com/PromisePay/promisepay-php/fork )
	2. Create your feature branch (`git checkout -b my-new-feature`)
	3. Commit your changes (`git commit -am 'Add some feature'`)
	4. Push to the branch (`git push origin my-new-feature`)
	5. Create a new Pull Request

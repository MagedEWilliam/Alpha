<?php
require 'vendor/autoload.php';

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

if($_SERVER['SERVER_NAME'] == 'localhost'){
	define('SITE_URL', 'http://localhost/ALPHA/');
}else{
	define('SITE_URL', 'http://i-alfa.com/');
}

$paypal = new ApiContext(
	new OAuthTokenCredential(
		'AQOO5DpkoNweiFb9DInGZRraH4Il8PNI1yatWf5hbaUHqa3JRiVIw6TkZkpHJRGQXEe0EcuVr-KLANus', 
		'EEVAa8eKexlLZW9rW8AY14mDed0KJlfuD4okPm3Y5gFob639WMTtMow3EBxjevHRX6xoFXssvjv6SpIj'
		)
	);
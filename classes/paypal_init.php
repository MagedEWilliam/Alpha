<?php
require 'vendor/autoload.php';

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

if($_SERVER['SERVER_NAME'] == 'localhost'){
	define('SITE_URL', 'http://localhost/ALPHA/');
}else{
	define('SITE_URL', 'http://i-alfa.info/');
}

$paypal = new ApiContext(
	new OAuthTokenCredential(
		'AWLU6Q5LPjcBGKN1aG7Q0W_F1DIL8ylhmt9tatgehL59Uc3MoCncFa6-kG5p4uD8DjB8_U0U2gcRVOF_', 
		'EHkMQmGFMM7-xgWfIzi1U00Zwq4pN2o5q4PYcJQ68vL3vARSoyUFPU7Xl0wNlaVML-W-sTElrTXamtKC'
		)
	);
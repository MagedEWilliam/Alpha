<?php
require 'vendor/autoload.php';

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

if($_SERVER['SERVER_NAME'] == 'localhost'){
	define('SITE_URL', 'http://localhost/ALPHA/');
}else{
	define('SITE_URL', 'http://alphalightingtech.com/');
}

$paypal = new ApiContext(
	new OAuthTokenCredential(
		'AcqhDIZyoyq349dm-dRUHTzxmldaUBMjQtzoNSNpdw4A4SmMYa22SWlZKt7CvkwlTaatN60uVzUBb3id', 
		'ENpep2V58zQ_voylN24wVFbc7h7aC88rHnnJDlIDlPj63pon4sxm2icM9fpCL8dn6nrTYs2-NCVemFvo'
		)
	);
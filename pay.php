<?php
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
require 'classes/paypal_init.php';

if(!isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID'])){
	die();
}

if( (bool)$_GET['success'] === false ){
	die();
}

$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];


$payment = Payment::get($paymentId, $paypal);

$exec = new PaymentExecution();
$exec->setPayerId($payerId);
echo '<pre>';
try{
	$result = $payment->execute($exec, $paypal);
	
	print_r(gettype($result) );

		print_r($payment );

	
}catch(Exception $e){
	$data = json_decode($e->getData());
	print_r( $data->message );
}
echo '</pre>';

//save to db.
//present user with signup with thier email pre-filled.
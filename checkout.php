<?php

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

echo '<pre>';
print_r($_POST);
echo '</pre>';

require 'classes/paypal_init.php';
if(!isset($_POST['qun'], $_POST['item_code']) ) {
	die('no items selected');
}

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$total = 0;
$i =0;
foreach ($_POST['item_code'] as $key => $value) {
	
	$product = $_POST['item_code'][$key];
	$price   = $_POST['qun'][$key];
	$total   += $price;

	$items[$i] = new Item();
	$items[$i]->setName($product)
	->setCurrency('USD')
	->setQuantity(1)
	->setPrice($price);
	$i++;

}


$itemList = new ItemList();
$itemList->setItems($items);

$details = new Details();
$details->setSubtotal($total);

$amount = new Amount();
$amount->setCurrency('USD')
->setTotal($total)
->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
->setItemList($itemList)
->setDescription('PayForSomething Payment')
->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl(SITE_URL . 'pay.php?success=true')
->setCancelUrl(SITE_URL . 'pay.php?success=false');

$payment = new Payment();
$payment->setIntent('sale')
->setPayer($payer)
->setRedirectUrls($redirectUrls)
->setTransactions([$transaction]);

try{
	$payment->create($paypal);
} catch (Exception $e) {
	echo '<pre>';
	print_r($e);
	echo '</pre>';
	die($e);
}

$approvalUrl = $payment->getApprovalLink();

header('Location: '. $approvalUrl);
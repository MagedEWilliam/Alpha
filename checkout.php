<?php
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

//echo '<pre>';
//print_r($_POST);
//echo '</pre>';

require 'classes/paypal_init.php';
require_once ('classes/class_database.php');


if(!isset($_POST['qun'], $_POST['item_code']) ) {
	die('no items selected');
}


class CartItem
{

	static public function getCards($itemCode){
		$db  = Database::getInstance();
		$mysqli = $db->getConnection();

		$sqlQuery = "
		SELECT DISTINCT
		`catproperty`.catID ,
		`catproperty`.categoryID,
		`catproperty`.propertyID,
		`catproperty`.valueID,

		`category`.`Name` As CatName,
		`category`.`Name` As CatNameAr,
		`category`.`Name` As CatNameCh,

		`subcategory`.`ID`     ,
		`subcategory`.`catID`  ,
		`subcategory`.`code`   ,
		`subcategory`.`Name`   ,
		`subcategory`.`NameAr` ,
		`subcategory`.`NameCh` ,
		`subcategory`.`image`  

		FROM `catproperty` 

		INNER JOIN `subcategory`
		ON `catproperty`.`categoryID` = `subcategory`.`ID`

		INNER JOIN `category`
		ON `category`.`ID` = `catproperty`.`catID`

		WHERE
		`subcategory`.`code` = '" . $itemCode . "'";

		$res = [];
		if ($result = $mysqli->query($sqlQuery)) {
			while ($row = $result->fetch_assoc()) {
				$temp = [];
				$sub = self::getProperty( $row['catID'], $row['categoryID'] );
				
				$temp['item'] = $row;
				$temp['Subcategory'] = $sub;
				if(self::isDistinct($res, $temp)){
					array_push($res, $temp);
				}
			}
		}

		echo mysqli_error($mysqli);
		return  self::distinctIt($res);
	}

	static public function isDistinct($sub, $orgin){
		foreach ($sub as $key => $value) {
			if( $value['item']['categoryID']  == $orgin['item']['categoryID'] ){
				return false;
			}
		}
		return true;
	}

	static public function distinctIt($data){
		$filtered = $data;
		$base = $data;

		if( isset($data) ){
			foreach ($filtered as $key => $value) {

				// print_r( $filtered[$key]['item']['catID'] );
				foreach ($filtered[$key]['Subcategory'] as $_key => $_value) {
					$isfirst = true;
					// var_dump( 'Compare me', $_value['ID'] );
					if(isset( $base[$key]['Subcategory'][$_key] )){
						$base[$key]['Subcategory'][$_key]['more']  = [];
					}
					foreach ($base[$key]['Subcategory'] as $__key => $__value) {
						if(isset( $__value['propertyID'] )){
							if($_value['ID'] == $__value['propertyID']){
								// var_dump( 'to', $__value['propertyID'] );
								if(!$isfirst){
									array_push($base[$key]['Subcategory'][$_key]['more'], $base[$key]['Subcategory'][$__key]);
									unset($base[$key]['Subcategory'][$__key]);
								}
								$isfirst = false;
							}
						}
					}
				}
			}
		}

		return $base;
	}

	static public function _locale($word){
		if($_GET['lang'] == 'en'){
			return $word;
		}elseif ($_GET['lang'] == 'ar') {
			return $word . 'Ar';
		}elseif ($_GET['lang'] == 'ch') {
			return $word . 'Ch';
		}
	}

	static public function getProperty($id, $sub)
	{
		$db  = Database::getInstance();
		$mysqli = $db->getConnection();

		$sqlQuery = "SELECT 
		`property`.ID, 
		`property`.Name, 
		`property`.NameAr, 
		`property`.NameCh,

		`value`.ID AS valueID, 
		`value`.propertyID, 
		`value`.value, 
		`value`.valueAr, 
		`value`.valueCh

		FROM `catproperty` 

		INNER JOIN property 
		ON `catproperty`.propertyID = `property`.ID

		INNER JOIN `value` 
		ON `catproperty`.valueID = `value`.ID

		WHERE (`catproperty`.catID = ".$id." AND `catproperty`.categoryID = ".$sub.") ";
		
		$res = [];
		if ($result = $mysqli->query($sqlQuery)) {
			while ($row = $result->fetch_assoc()) {
				array_push($res, $row);
			}
		}

		return $res;
	}

}


$payer = new Payer();
$payer->setPaymentMethod('paypal');

$total = 0;
$i =0;

require('classes/class_getCard.php');

$card = new Card;

$cartitem = new CartItem;
foreach ($_POST['item_code'] as $key => $value) {

	$thisitem = $card->getCard( array('exactID' => $_POST['item_code'][$key],'toArray' => 'toArray') );

	
	$itemFromDB = $cartitem->getCards($_POST['item_code'][$key]);

	$product = $itemFromDB[0]['item'][$cartitem->_locale('Name')];
	$subcat = $itemFromDB[0]['item'][$cartitem->_locale('CatName')];

	$qun     = $_POST['qun'][$key];

	if($thisitem[0]['item']['onsale'] == 1){
		$price   = $thisitem[0]['item']['priceafterdisc'];
	}else{
		$price   = $thisitem[0]['item']['price'];
		
	}
	$total   += $price * $qun;

	echo $price;
	echo '*';
	echo $qun;
	echo ', ';

	$discription = 'Item code: '.$_POST['item_code'][$key];
	$url = SITE_URL.'page/product_details?lang='.$_GET['lang'].'&product_id='.$_POST['item_code'][$key];

		//// echo '<pre>';
		// var_dump('url',$url,$product,'product', $discription,'discription',$subcat,'subcat', $qun,'qun', $price,'price',  $price * $qun,'total');
		//// echo '</pre>';

	$items[$i] = new Item();
	$items[$i]->setName($product)
	->setDescription($discription)
	->setUrl($url)
	->setCurrency('USD')
	->setQuantity($qun)
	->setPrice($price);
	$i++;
	
}
echo '= ';
echo $total;
// die();

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
$redirectUrls->setReturnUrl(SITE_URL . 'page/pay?success=true&lang='.$_GET['lang'])
->setCancelUrl(SITE_URL . 'page/pay?success=false&lang='.$_GET['lang']);

$payment = new Payment();
$payment->setIntent('sale')
->setPayer($payer)
->setRedirectUrls($redirectUrls)
->setTransactions([$transaction]);

try{
	$payment->create($paypal);
} catch (Exception $e) {
	//echo '<pre>';
	print_r($e);
	//echo '</pre>';
	echo '<script>setTimeout(function(){ location.reload(); }, 50);</script>';
	die($e);
}

$approvalUrl = $payment->getApprovalLink();

header('Location: '. $approvalUrl);
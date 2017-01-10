<?php 
require_once 'class_database.php';

/*
0 = new
1 = Placed
2 = Out for Delivery
3 = Returned
4 = Out for Delivery
5 = Delivered
*/

if(isset($_POST) ){
	if( 
		isset($_POST['fullname']) 
		|| isset($_POST['email']) 
		|| isset($_POST['phone']) 
		|| isset($_POST['address']) 
		){
		
		if( 
			trim($_POST['fullname'])     != '' 
			|| trim($_POST['email'])     != '' 
			|| trim($_POST['phone'])     != '' 
			|| trim($_POST['address'])   != ''  
			) {

			$setorder = new setOrder;
		$setorder->newGuestOrder($_POST);
		//send EMail...
		header("location: ../page/pay?success=true&lang=".$_GET['lang']."&paymentId=".$_GET['paymentId']."&token=".$_GET['token']."&PayerID=".$_GET['PayerID']."&order=new");
	}else{
		header("location: "  . $_SERVER['HTTP_REFERER']);
	}

}else{
	if (!headers_sent()) {
	 header("location: "  . $_SERVER['HTTP_REFERER']);
	}
}
}

Class setOrder{
	
	static public function newGuestOrder ($order){
		$db = Database::getInstance();
		$mysqli = $db->getConnection();
		
		$sqlQuery = "INSERT INTO guestorders (orderID, token, fullName, Email, Phone, Address, hashOrder)
		VALUES ('".$_GET['paymentId']."','".$_GET['token']."','".$order['fullname']."','".$order['email']."','".$order['phone']."','".$order['address']."','".$order['password']."') ";
		
		$result = $mysqli->query($sqlQuery);
		echo mysqli_error($mysqli);
		echo $sqlQuery;
	}

	static public function newUserOrder ($userID, $order){
		$db = Database::getInstance();
		$mysqli = $db->getConnection();
		
		$sqlQuery = "INSERT INTO userorders (userID, orderID, token)
		VALUES ('".$userID."', '".$_GET['paymentId']."','".$_GET['token']."') ";
		
		$result = $mysqli->query($sqlQuery);
		echo mysqli_error($mysqli);
		echo $sqlQuery;
	}

}
?>
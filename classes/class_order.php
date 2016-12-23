<?php 
require 'class_database.php';

/*
0 = new
1 = Placed
2 = Out for Delivery
3 = Returned
4 = Out for Delivery
5 = Delivered
*/

Class setOrder{

	static public function setNewOrder ($order){
		
		$db = Database::getInstance();
		$mysql = $db->getConnection();

		$sqlQuery = 'INSERT INTO order () VALUES ()';
		$result = $mysqli->query($sqlQuery);

	}

	static public function isOrderNew ($order){
	}

	static public function setDeepDetails ($order){
	}

}
?>
<?php 
// header('Content-Type: application/json; charset=utf-8');
require_once('class_database.php');

if( isset($_GET) ){
	$stock = new Stock;
	$goodtogo = false;
	if(isset($_GET['method'])){
		switch ($_GET['method']) {
			case "getQun" : 
			$stockval = $stock->getQun($_GET['id'])['qun'];
			$qun = $_GET['qun'];
			$goodtogo = $stock->combareQun($stockval, $qun);
			if($goodtogo){
				echo '{"allowstock":1}';
			}else{
				echo '{"allowstock":0}';
			}
			break;
		}
	}
}

Class Stock{

	static public function combareQun ($stock, $qun){
		$trial = $stock - $qun;
		if($trial < 0){
			return false;
		}
		return true;
	}

	static public function getQun ($id){
		$db = Database::getInstance();
		$mysqli = $db->getConnection();

		$sqlQuery = 'SELECT qun FROM subcategory WHERE ID = ' . $id;
		$result = $mysqli->query($sqlQuery);
		$row = $result->fetch_assoc();
		return $row;
	}
	static public function updateQun ($id, $qun){
		$db = Database::getInstance();
		$mysqli = $db->getConnection();

		$sqlQuery = 'UPDATE subcategory SET `qun` ='.$qun.' WHERE code = "'.$id.'"';
		$result = $mysqli->query($sqlQuery);
	}

	static public function downUpdateQun ($id, $qun){
		$db = Database::getInstance();
		$mysqli = $db->getConnection();

		$sqlQuery = 'UPDATE subcategory SET `qun` = `qun` - '.$qun.' WHERE code = "'.$id.'"';
		$result = $mysqli->query($sqlQuery);
		echo mysqli_error($mysqli);
		echo $sqlQuery;
	}

	static public function upUpdateQun ($id, $qun){
		$db = Database::getInstance();
		$mysqli = $db->getConnection();

		$sqlQuery = 'UPDATE subcategory SET `qun` = `qun` + '.$qun.' WHERE code = "'.$id.'"';
		$result = $mysqli->query($sqlQuery);
	}



}
?>
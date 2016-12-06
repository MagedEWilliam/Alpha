<?php
header('Content-Type: application/json; charset=utf-8');
require('class_database.php');

$card = new Card;
print_r($card->getCards());

class Card
{

	static public function getCards()
	{
		$db  = Database::getInstance();
		$mysqli = $db->getConnection();

		$sqlQuery = "SELECT DISTINCT
		`catproperty`.catID ,
		`catproperty`.categoryID,
		`catproperty`.propertyID,

		`subcategory`.`ID`     ,
		`subcategory`.`catID`  ,
		`subcategory`.`code`   

		FROM `catproperty` 

		INNER JOIN `subcategory`
		ON `catproperty`.`categoryID` = `subcategory`.`ID`
		";

		if(isset($_GET['cat'])){
			$sqlQuery .= " WHERE (`catproperty`.catID = " . $_GET['cat'];
		}
		if(isset($_GET['subcat'])){
			if(isset($_GET['cat'])){
				$sqlQuery .= " AND ";
			}
			$sqlQuery .= " `catproperty`.categoryID = ". $_GET['subcat'];
		}

		if(isset($_GET['cat'])){
			$sqlQuery .= ')' ;
		}

		$res = [];
		if ($result = $mysqli->query($sqlQuery)) {
			while ($row = $result->fetch_assoc()) {
				
				$prop = self::getProperty( $row['propertyID'] );
				if(count($prop) > 0){
					
					array_push($res, $prop);
				}
			}
		}
		echo mysqli_error($mysqli);
		return  json_encode($res);
	}

	static public function getProperty($id)
	{
		$db  = Database::getInstance();
		$mysqli = $db->getConnection();

		$sqlQuery = "SELECT * FROM `property` WHERE filterable = 1 AND ID =" .$id;

		$res = [];
		if ($result = $mysqli->query($sqlQuery)) {
			while ($row = $result->fetch_assoc()) {
				$temp = [];
				$sub = self::getValue( $id );
				
				$temp['Property'] = $row;
				$temp['Value'] = $sub;

				array_push($res, $temp);
			}
		}
		echo mysqli_error($mysqli);
		return  $res;
	}


	static public function getValue($id)
	{
		$db  = Database::getInstance();
		$mysqli = $db->getConnection();

		$sqlQuery = "SELECT * FROM `value` WHERE propertyID = ". $id;
		
		$res = [];
		if ($result = $mysqli->query($sqlQuery)) {
			while ($row = $result->fetch_assoc()) {
				array_push($res, $row);
			}
		}
		return  $res;
	}
}
?>
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
				$temp = [];
				$sub = self::getProperty( $row['catID'], $row['categoryID'] );
				
				$temp['item'] = $row;
				$temp['Subcategory'] = $sub;

				array_push($res, $temp);
			}
		}
		echo mysqli_error($mysqli);
		return  json_encode($res);
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

		`value`.ID, 
		`value`.propertyID, 
		`value`.value, 
		`value`.valueAr, 
		`value`.valueCh

		FROM `catproperty` 

		INNER JOIN property 
		ON `catproperty`.propertyID = `property`.ID

		INNER JOIN `value` 
		ON `catproperty`.valueID = `value`.ID

		WHERE (`catproperty`.catID = ".$id." AND `catproperty`.categoryID = ".$sub." AND `catproperty`.showquick = 1) ";
		
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
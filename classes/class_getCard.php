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

		$res = [];
		$sqlQuery = "
		SELECT 
		`subcategory`.`ID`,
		`subcategory`.`catID`,
		`subcategory`.`code`,

		`subcategory`.`image`,
		`category`.`Name`,
		`category`.`NameAr`,
		`category`.`NameCh`,

		`subcategory`.`Name`,
		`subcategory`.`NameAr`,
		`subcategory`.`NameCh` 

		FROM `subcategory`

		INNER JOIN `category`
		ON `subcategory`.`catID` = `category`.`ID`;
		";

		if ($result = $mysqli->query($sqlQuery)) {
			while ($row = $result->fetch_assoc()) {
				$getprop = self::getCatProperty($row['ID']);
				$multi = [];
				$row['properties'][] = $getprop;

				array_push($res, $row);
			}
		}
		echo mysqli_error($mysqli);
		return json_encode($res);
	}

	static public function getCatProperty($subcat)
	{
		$db  = Database::getInstance();
		$mysqli = $db->getConnection();

		$res = [];
		$sqlQuery = "SELECT 
					property.ID, property.Name, property.NameAr, property.NameCh,
					`value`.ID, `value`.propertyID, `value`.value, `value`.valueAr, `value`.valueCh
					FROM `catproperty` 

					INNER JOIN property 
					ON catproperty.propertyID = `property`.ID

					INNER JOIN `value` 
					ON catproperty.valueID = `value`.ID

					WHERE catproperty.categoryID = " . $subcat;

		if ($result = $mysqli->query($sqlQuery)) {
			while ($row = $result->fetch_assoc()) {
				array_push($res, $row);
			}
		}
		return $res;
	}

}
?>
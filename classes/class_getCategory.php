<?php
header('Content-Type: application/json; charset=utf-8');
require('class_database.php');

$category = new Category;
print_r($category->getCategories());

class Category
{
	
	static public function getCategories()
	{
		$db  = Database::getInstance();
		$mysqli = $db->getConnection();

		$res = [];
		$sqlQuery = "
		SELECT * FROM `category`
		";

		if ($result = $mysqli->query($sqlQuery)) {
			while ($row = $result->fetch_assoc()) {
				$getprop = self::getSubCategories($row['ID']);
				$multi = [];
				$row['subcategory'][] = $getprop;

				array_push($res, $row);
			}
		}
		echo mysqli_error($mysqli);
		return json_encode($res);
	}

	static public function getSubCategories($subcat)
	{
		$db  = Database::getInstance();
		$mysqli = $db->getConnection();

		$res = [];
		$sqlQuery = "SELECT * FROM `catproperty`

		 WHERE `categoryID`=" . $subcat;

		if ($result = $mysqli->query($sqlQuery)) {
			while ($row = $result->fetch_assoc()) {
				array_push($res, $row);
			}
		}
		return $res;
	}

}
?>
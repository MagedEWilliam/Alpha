<?php
header('Content-Type: application/json; charset=utf-8');
require('class_database.php');

$card = new Card;
// echo '<pre>';
print_r($card->getCards());
// echo '</pre>';
class Card
{

	static public function getCards()
	{
		$db  = Database::getInstance();
		$mysqli = $db->getConnection();

		$sqlQuery = "
		SELECT DISTINCT
		`catproperty`.catID ,
		`catproperty`.categoryID,
		`catproperty`.propertyID,
		`catproperty`.valueID,

		`subcategory`.`ID`     ,
		`subcategory`.`catID`  ,
		`subcategory`.`code`   ,
		`subcategory`.`Name`   ,
		`subcategory`.`NameAr` ,
		`subcategory`.`NameCh` ,
		`subcategory`.`image` ,
		`subcategory`.`price`  

		FROM `catproperty` 

		INNER JOIN `subcategory`
		ON `catproperty`.`categoryID` = `subcategory`.`ID`
		";

		if(count($_GET) > 0){
			$sqlQuery .= ' WHERE ';
		}

		foreach ($_GET as $key => $value) {
			$getcurval = explode('_', $key);
          
          if( isset($_GET['exactID']) ){
            if( $_GET['exactID'] != '' ){
              $sqlQuery .= ' `subcategory`.`code` = "' . $_GET['exactID'] . '"';
            }
          }
          
			if($getcurval[0] == 'filt' &&  $value != ''){
				$explodevalu = explode(',', $value);
				
				$sqlQuery .= " AND (`catproperty`.propertyID = " . $getcurval[1];
				for ($i=0; $i < count($explodevalu) ; $i++) {
					if($i > 0){
						$sqlQuery .= " OR `catproperty`.valueID = " . $explodevalu[$i];
					}else{
						$sqlQuery .= " AND `catproperty`.valueID = " . $explodevalu[$i];
					}
				}
				$sqlQuery .= ')';
				
			}else{
				if($key == 'cat'){
					$sqlQuery .= " (`catproperty`.catID = " . $_GET['cat'];
				}
				if($key == 'subcat'){
					$sqlQuery .= " AND (`catproperty`.valueID = ". $_GET['subcat'];
					$sqlQuery .= ')';
				}
				if($key == 'cat'){
					$sqlQuery .= ')';
				}
			}

		}

/* echo '<pre>';
 print_r($sqlQuery);
 echo '</pre>';*/
$sqlQuery .= ' ORDER BY `subcategory`.`ordering` ';
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
		return  json_encode( self::distinctIt($res) );
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
?>
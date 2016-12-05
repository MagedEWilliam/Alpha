<?php 
function geLocale(){
		$db        = Database::getInstance();
		$mysqli    = $db->getConnection();
		$sqlQuery  = "SELECT * FROM `locale`";
		$res = [];
		if ($result = $mysqli->query($sqlQuery)) {
			while ($row = $result->fetch_assoc()) {
				$res[] = $row;
			}
		}
		echo mysqli_error($mysqli);
		return json_encode($res);
	}

	function _geLocale(){
		$db        = Database::getInstance();
		$mysqli    = $db->getConnection();
		$sqlQuery  = "SELECT * FROM `locale`";
		$res = [];
		if ($result = $mysqli->query($sqlQuery)) {
			while ($row = $result->fetch_assoc()) {
				$res[] = $row;
			}
		}
		echo mysqli_error($mysqli);
		return $res;
	}

	function getFromLocale($word){
		$Glocale = _geLocale();
		foreach ($Glocale as $key => $value) {
			if($Glocale[$key]['key'] == $word){
				return $Glocale[$key][locale('value')];
			}
		}
	}

	function locale($word){
		if(isset($_GET)){
			if($_GET['lang'] == 'en'){
				return $word;
			}elseif ($_GET['lang'] == 'ar'){
				return $word . 'Ar';
			}elseif ($_GET['lang'] == 'ch'){
				return $word . 'Ch';
			}
		}
	}
?>
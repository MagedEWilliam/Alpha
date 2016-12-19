<?php
$json = file_get_contents('countriesToCities.json');


$world = json_decode($json, true);
$store = 0;
$countries = [];

foreach ($world as $key => $value) {

	if(isset( $_GET['countries']) ){
		if($_GET['countries'] == 'all'){
			$contval = [$store => $key];
			if($key == 'China'){
				$contval = ['0.0' => 'China'];
			}
			$countries[$store] = $contval;
		}
	}

	if (isset( $_GET['country']) ) {
		if($key == $_GET['country']){
			array_push($countries, [$key=>$value]);
		}
	}

	$store ++ ;
}

print_r( json_encode($countries) );
?>
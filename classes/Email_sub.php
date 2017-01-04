<?php 
require 'class_database.php';

if(isset($_POST)){
	if(isset($_POST['Email_sub'])){
		try{
			newsub($_POST['Email_sub']);
		}catch(Exception $e){
			print_r($e);
		}
		echo '<meta http-equiv="Location" content="'.$_SERVER['HTTP_REFERER'].'">';
		echo '<script>window.location.replace("'.$_SERVER['HTTP_REFERER'].'");</script>';
		header("location: "  . $_SERVER['HTTP_REFERER']);
	}
}

function newsub ($order){
	$db = Database::getInstance();
	$mysqli = $db->getConnection();
	$sqlQuery = 'INSERT INTO emailsub (email, already, unsub) VALUES ("'.$order.'",0,0)';
	$result = $mysqli->query($sqlQuery);
}


?>
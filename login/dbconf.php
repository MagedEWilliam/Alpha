<?php
//DATABASE CONNECTION VARIABLES
if($_SERVER['SERVER_NAME'] == 'localhost'){
	$host = "localhost"; // Host name
	$username = "root"; // Mysql username
	$password = ""; // Mysql password
	$db_name = "oauthing"; // Database name
}else{
	$host = "alphalightingtech.com"; // Host name
	$username = "ialphalightingte"; // Mysql username
	$password = "Alfa@1234"; // Mysql password
	$db_name = "authing"; // Database name
}

//DO NOT CHANGE BELOW THIS LINE UNLESS YOU CHANGE THE NAMES OF THE MEMBERS AND LOGINATTEMPTS TABLES

$tbl_prefix = ""; //***PLANNED FEATURE, LEAVE VALUE BLANK FOR NOW*** Prefix for all database tables
$tbl_members = $tbl_prefix."members";
$tbl_attempts = $tbl_prefix."loginAttempts";

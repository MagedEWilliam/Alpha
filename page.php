<?php
require_once('classes/class_database.php');
function get_current_route(){
	$query = $_SERVER['PHP_SELF'];
	$path  = pathinfo( $query );
	$what_you_want = $path['basename'];
	return $what_you_want;
}

function getContentOf(){
	$page      = get_current_route();
	$db        = Database::getInstance();
	$mysqli    = $db->getConnection();
	$sqlQuery  = "SELECT ";

	if( $_GET['lang'] == 'en' ){
		$sqlQuery .= "`content`.content AS content,";
	}else if( $_GET['lang'] == 'ar' ){
		$sqlQuery .=  " `content`.contentAr AS content,";
	}else if( $_GET['lang'] == 'ch' ){
		$sqlQuery .=  " `content`.contentCh AS content, ";
	}

	$sqlQuery .=  " `pages`.url, `pages`.Name, `pages`.NameAr, `pages`.NameCh
	FROM content
	INNER JOIN `pages` ON `content`.pageid = `pages`.ID
	WHERE `pages`.url = '" . $page . "'";

	if ($result = $mysqli->query($sqlQuery)) {
		echo mysqli_error($mysqli);
		$row = $result->fetch_assoc();
		return $row;
	}
}

$res = getContentOf();
global $active_nav_name;
$active_nav_name = $res['Name'];
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $active_nav_name ?></title>
	<link rel="icon" href="../assets/alpha2.png">
	<link rel="stylesheet" type="text/css" href="../libs/semantic/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="../libs/jquery.min.js"></script>
	<script type="text/javascript" src="../libs/jquery.flip.min.js"></script>
	<script type="text/javascript" src="../libs/jquery.query-object.min.js"></script>
	<script type="text/javascript" src="../libs/semantic/semantic.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../libs/amazonmenu/amazonmenu.css">
	<script src="../libs/amazonmenu/amazonmenu.min.js"></script>
	<script type="text/javascript" src="../js/components.js"></script>
</head>
<body id="example" class="layouts pushable">
	<?php include_once('pages/topnav/topnav.php'); ?>
	<div class="pusher">
		<div class="full height">
			<div class="article">
				<div class="ui container large">
					<div class="ui internally celled grid ui segment">
						<div class="row  ">
						<?php echo $res['content']; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>

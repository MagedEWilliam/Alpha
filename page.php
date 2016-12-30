<?php
require_once('classes/class_database.php');
function get_current_route(){
	$query = $_SERVER['PHP_SELF'];
	$path  = pathinfo( $query );
	$what_you_want = $path['basename'];
	return $what_you_want;
}

function _getContentOf(){
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

function getContentOf(){
	$page      = get_current_route();
	$db        = Database::getInstance();
	$mysqli    = $db->getConnection();

	$sqlQuery = "SELECT * FROM `composepage`";
	$sqlQuery .= " INNER JOIN `parts` on composepage.partid = parts.ID";
	$sqlQuery .= " Where `composepage`.`pageid` = " . getPageID(get_current_route())['ID'];

	$res = '';
	if ($result = $mysqli->query($sqlQuery)) {
		echo mysqli_error($mysqli);
		while ($row = $result->fetch_assoc()) {
			$res .= $row['content'];
		}
	}
	return $res;
}

function getPageID($page){
	$db        = Database::getInstance();
	$mysqli    = $db->getConnection();

	$sqlQuery = "SELECT * FROM `pages` WHERE url = '" . $page . "'";

	if ($result = $mysqli->query($sqlQuery)) {
		echo mysqli_error($mysqli);
		$row = $result->fetch_assoc();
		return $row;
	}
}

function _locale($word){
	if($_GET['lang'] == 'en'){
		return $word;
	}elseif ($_GET['lang'] == 'ar') {
		return $word . 'Ar';
	}elseif ($_GET['lang'] == 'ch') {
		return $word . 'Ch';
	}
}

$res = getContentOf();
global $active_nav_name;
$active_nav_name = $res;
?>
<!DOCTYPE html>
<!-- <html <?php //if( isset($_GET['lang']) &&  $_GET['lang'] == "ar" ) { echo ' dir="rtl" '; } ?>> -->
<html>
<head>
	<title><?php echo getPageID(get_current_route())[_locale('Name')] ?></title>
	<?php $_GET['__level']=1; include('pages/links.php') ?>
</head>
<body id="example" class="layouts pushable" style="overflow-y: scroll;">
	<?php include_once('pages/topnav/topnav.php'); ?>
	<div class="pusher">
		<div class="full height">
			<div class="article">
				<div class="ui container large">
					<div class="ui stackable grid segment topping" style="box-shadow: none;">
						<?php 
						switch (get_current_route()) {
							case "product_details":include_once('pages/products/product_details.php'); break;
							case "products":include_once('pages/products/products.php'); break;
							case "cart":include_once('pages/cart/cart.php'); break;
							case "pay":require_once('_pay.php'); break;
							default: echo $active_nav_name; break;
						}
							// case "Home":require_once('pages/home/home.php'); break;
						
						?>
				</div>
			</div>
				<?php include_once('pages/parts/footer_part.php'); ?>
		</div>
	</div>
</div>
</body>
</html>

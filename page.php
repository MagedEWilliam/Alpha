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
<html>
<head>
	<title><?php echo $active_nav_name[_locale('Name')] ?></title>
	<?php $_GET['__level']=1; include('pages/links.php') ?>
</head>
<body id="example" class="layouts pushable">
	<?php include_once('pages/topnav/topnav.php'); ?>
	<div class="pusher">
		<div class="full height">
			<div class="article">
				<div class="ui container large">
					<div class="ui internally stackable celled grid segment topping">
						<?php 
						if(get_current_route() == 'product_details'){	
							include_once('pages/products/product_details.php');
						}elseif(get_current_route() == 'products'){	
							include_once('pages/products/products.php');
						}elseif(get_current_route() == 'cart'){	
							include_once('pages/cart/cart.php');
						}else{
							echo $active_nav_name['content'];
						}
						?>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>

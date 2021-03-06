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

			if( $_GET['lang'] == 'en' ){
				$res .= $row['content'];
			}else if( $_GET['lang'] == 'ar' ){
				$res .= $row['contentAr'];
			}else if( $_GET['lang'] == 'ch' ){
				$res .= $row['contentCh'];
			}

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
<html>
<head>
	<input type="hidden" name="username" value="<?php if(isset($_SESSION['username'])) { echo $_SESSION['username']; } else { echo 'guest'; } ?>">
	<title><?php echo getPageID(get_current_route())[_locale('Name')] ?></title>
	<?php $_GET['__level']=1; include('pages/links.php') ?>
</head>
<body id="example" class="layouts pushable" style="overflow-y: scroll;">
	<?php include_once('pages/topnav/topnav.php'); ?>
	<div class="pusher">
		<div class="full height">
			<div class="article">
				<div class="bigboss ui container large">
					<div class="ui stackable grid segment topping" style="box-shadow: none;">
						<?php 
						switch (get_current_route()) {
							case "product_details":include_once('pages/products/product_details.php'); break;
							case "products":include_once('pages/products/products.php'); break;
							case "cart":include_once('pages/cart/cart.php'); break;
							case "pay":require_once('_pay.php'); break;
							default: echo $active_nav_name; break;
						}
						
						?>
					</div>
				</div>
				<?php include_once('pages/parts/footer_part.php'); ?>
			</div>
		</div>
	</div>
	<div id="product_detail" class="ui modal">

	</div>
	<script>
		langdrop();
		
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-90320158-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>

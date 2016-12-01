<?php
require_once('classes/class_database.php');
function get_current_route(){
	$query = $_SERVER['PHP_SELF'];
	$path = pathinfo( $query );
	$what_you_want = $path['basename'];
	return $what_you_want;
}

function getContentOf(){
	$page      = get_current_route();
	$db        = Database::getInstance();
	$mysqli    = $db->getConnection();
	$sqlQuery  = "SELECT ";

	if( $_GET['lang'] = 'en' ){
		$sqlQuery .= "`content`.content AS content,";
	}else if( $_GET['lang'] = 'ar' ){
		$sqlQuery .=  " `content`.contentAr AS content,";
	}else if( $_GET['lang'] = 'ch' ){
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
$pa = get_current_route();
if( $pa == 'products'){
	$res['Name'] = 'products';
	$res['content'] = 'products.php';
}else{
	$res = getContentOf();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $res['Name']?></title>
	<link rel="icon" href="../assets/alpha2.png">
	<link rel="stylesheet" type="text/css" href="../libs/semantic/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script type="text/javascript" src="../libs/jquery.min.js"></script>
	<script type="text/javascript" src="../libs/jquery.flip.min.js"></script>
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
							
							<?php 
							if($res['content'] = 'products.php'){
								echo '<div class="three wide column goodtimes"  id="sideNav">
								<p>Categories:</p>

								<div id="mysidebarmenu" class="amazonmenu">
									<ul id="sidebarmenu">
										
									</ul>
									<div class="shadowmore"></div>
									<div class="showmore">Show more</div>
								</div>
								<div class="filterArea" style="width: 100%;">
									
								</div>
							</div>
							<div class="thirteen wide column " id="product">
								<div class="ui grid">

									<div class="ten wide column" id="subcatmob">
										<div class="mobilefil">
											<a href="#" class="ui tiny button submenumob floatleft">≡Filter</a>
											<select class="floatright shideme topspace" id="mobilesubmenu">
												<option id="defuloptsub">Categories</option>
											</select>
										</div>

										<div class="ui breadcrumb">
											<a class="section" id="Home-crumb">
												<i class="ui home icon"></i>
											</a>
											<span class="divider">/</span>
											<div  class="section">Products</div>

										</div>
									</div>
									<div class="six wide column rtl searchresultcount" id="srchres">
										<p class="rtl">search result</p>
									</div>
								</div>
								<div class="ui divider"></div>
								<div id="products" class="ui cards">

								</div>
								<br>
								<div class="ui divider"></div>
								<div id="productfooter">
									<!-- <p>Products footer goes here</p> -->
								</div>
							</div>';
						}else{
							echo '<div class="column ">';
							echo $res['content']; 
							echo '</div>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>

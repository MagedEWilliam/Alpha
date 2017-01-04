<?php
function _cat($itemID){
	$db  = Database::getInstance();
	$mysqli = $db->getConnection();

	$some_Query = 'SELECT * FROM category WHERE ID = ' . $itemID;
	$result = $mysqli->query($some_Query);
	$row = $result->fetch_assoc();

	return $row;
}

function _subcat($itemID){
	$db  = Database::getInstance();
	$mysqli = $db->getConnection();

	$some_Query = 'SELECT * FROM value WHERE ID = ' . $itemID;
	$result = $mysqli->query($some_Query);
	$row = $result->fetch_assoc();

	return $row;
}
?>
<div class="row">
	<div class="three wide column goodtimes" id="sideNav">
		<p locale="categories"><i class="ui icon list layout"></i> @:</p>

		<div id="mysidebarmenu" class="amazonmenu">
			<ul id="sidebarmenu">
				
			</ul>
			<img src="../assets/shadowdown.png" style="width:100%;">
			<div class="shadowmore"></div>
			<div class="showmore" locale="showMore">@ <i class="ui icon angle down"></i></div>
		</div>
		<div class="filterArea" style="width: 100%;">
			
		</div>
		<br>
		<br>
		<br>
	</div>
	<div class="thirteen wide column " id="product">

		<div class="ui grid">
			<div class="row optman">
				<div class="sixteen wide column" id="">


					<div class="ui breadcrumb">
						<a class="section" id="Home-crumb">
							<i class="ui home icon"></i>
						</a>
						<span class="divider">/</span>
						<div class="section" locale="products">@</div>
						<?php 
						if( isset($_GET['cat']) ){
							if( $_GET['cat'] != '' ){
								echo '<span class="divider">/</span><div class="section">';
								echo _cat($_GET['cat'])[locale('Name')];
								echo '</div>';
							}
						}
						if( isset($_GET['subcat']) ){
							if( $_GET['subcat'] != '' ){
								echo '<span class="divider">/</span><div class="section">';
								echo _subcat($_GET['subcat'])[locale('value')];
								echo '</div>';
							}
						}
						?>

					</div>


					<div id="srchres" class="floatright">
						<p class="rtl">search result</p>
					</div>

					<select class="floatright subcatmob shideme topspace mobilefil" id="mobilesubmenu">
						<option id="defuloptsub" locale="categories">@</option>
					</select>
				</div>
			</div>
			<br>
			<div id="products" class="ui cards">

			</div>
			<br>

			<div id="productfooter">
			</div>
		</div>
	</div>
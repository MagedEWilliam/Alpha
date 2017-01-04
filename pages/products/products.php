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
						<a class="section" id="Home-crumb" href="Home?lang=<?php echo $_GET['lang']; ?>">
							<i class="ui home icon"></i>
						</a>
						<span class="divider">/</span>
						<a class="section" locale="products" href="products?lang=<?php echo $_GET['lang']; ?>">@</a>
						<?php 
						if( isset($_GET['cat']) ){
							if( $_GET['cat'] != '' ){
								echo '<span class="divider">/</span><a class="section" href="products?lang='.$_GET['lang'].'&cat='.$_GET['cat'].'">';
								echo _cat($_GET['cat'])[locale('Name')];
								echo '</a>';
							}
						}
						if( isset($_GET['subcat']) ){
							if( $_GET['subcat'] != '' ){
								echo '<span class="divider">/</span><a class="section" href="products?lang='.$_GET['lang'].'&cat='.$_GET['cat'].'&subcat='.$_GET['subcat'].'">';
								echo _subcat($_GET['subcat'])[locale('value')];
								echo '</a>';
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
	</div>
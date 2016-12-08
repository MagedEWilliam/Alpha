<?php
	function getNavItems($active_nav_name){
		$db        = Database::getInstance();
		$mysqli    = $db->getConnection();
		$sqlQuery  = "SELECT * FROM `pages` WHERE Available = 1 AND hascontent > 0.00 Order by OrderID Asc";
		$res = "";
		if ($result = $mysqli->query($sqlQuery)) {
			while ($row = $result->fetch_assoc()) {
				$res .= '<a href="'.$row['url'].'?lang='.$_GET['lang'].'" id="nav_'.$row['url'].'">';

				if( $_GET['lang'] == 'en' ){
					if(strtolower($active_nav_name['Name']) == strtolower($row['Name'])){
						$res .=  '<div id="activeNav"></div>';
						$res .= $row['Name'];
						$res .=  '</a>';
					}else{
						$res .= $row['Name'];
						$res .=  '</a>';
					}
				}else if( $_GET['lang'] == 'ar' ){
					if(strtolower($active_nav_name['Name']) == strtolower($row['Name'])){
						$res .=  '<div id="activeNav"></div>';
						$res .= $row['NameAr'];
						$res .=  '</a>';
					}else{
						$res .= $row['NameAr'];
						$res .=  '</a>';
					}
				}else if( $_GET['lang'] == 'ch' ){
					if(strtolower($active_nav_name['Name']) == strtolower($row['Name'])){
						$res .=  '<div id="activeNav"></div>';
						$res .= $row['NameCh'];
						$res .=  '</a>';
					}else{
						$res .= $row['NameCh'];
						$res .=  '</a>';
					}
				}

			}

		}
		echo mysqli_error($mysqli);
		return $res;
	}
	
	include_once('classes/class_getLocale.php');
?>
<script type="text/javascript">
	var Glocale = <?php print_r(geLocale()) ?>;
</script>
<div class="ui container large nopad" >
	
	<div class="ui internally celled grid nopad goodtimes" id="topnav">
		<div class="row nopad">
			<div class="five wide column nopad nobox logo">
				<div class="alpha">
					<a href="Home-nav" id="Home-nav" locale="alpha">@</a>
				</div>
				<div id="line0" locale="lightUpYourLife"><p>@</p></div>
				<img src="../assets/alpha2.png">
			</div>
			<div class="eight wide column nopad nobox top-nav-group">
				<div class="top-nav-sub-group"><?php echo getNavItems($active_nav_name); ?></div>
				<div id="line1"></div>
			</div>
			<div class="three wide column nopad nobox rtl top-nav-sub-group">
				<div class="top-tel-sub-group">

					<!-- <select class="lang smallfont hundredinwidth" id="mlang">
						<option value="ar">عربي</option>
						<option value="en">English</option>
						<option value="ch">中文</option>
					</select> -->
					<p style="float: right; height: 100%;width: 25%;"></p>

					<div class="ui instant dropdown lang smallfont hundredinwidth"  id="lang">
					<input type="hidden" name="language">
  					<i class="dropdown  icon farright"></i>
					<div class="default text"></div>
						<div class=" menu">
							<div class="item" data-value="ar">
							<i class="eg flag"></i>
								عربي
							</div>
							<div class="item" data-value="en">
								<i class="us flag"></i>
								English
							</div>
							<div class="item" data-value="ch">
								<i class="cn flag"></i>
								中文
							</div>
						</div>
					</div>

					<!-- <p class="tel-space smallfont" style="float: left">tel: +20 22 39 03 110</p> -->

				</div>
				<div id="line2"></div>
			</div>
		</div>
	</div>
</div>
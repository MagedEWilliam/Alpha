<?php
function getNavItems($active_nav_name){
	$db        = Database::getInstance();
	$mysqli    = $db->getConnection();
	$sqlQuery  = "SELECT * FROM `pages` WHERE Available = 1 AND hascontent > 0.00 Order by OrderID Asc";
	$res = "";
	if ($result = $mysqli->query($sqlQuery)) {
		while ($row = $result->fetch_assoc()) {
			$res .= '<a href="'.$row['url'].'?lang='.$_GET['lang'].'" id="nav_'.$row['url'].'" ';

			if( $_GET['lang'] == 'en' ){
				if(strtolower($active_nav_name['Name']) == strtolower($row['Name'])){
					$res .=  'class="imactive">';
					$res .= $row['Name'];
					$res .=  '</a>';
				}else{
					$res .=  '>';
					$res .= $row['Name'];
					$res .=  '</a>';
				}
			}else if( $_GET['lang'] == 'ar' ){
				if(strtolower($active_nav_name['Name']) == strtolower($row['Name'])){
					$res .=  'class="imactive">';
					$res .= $row['NameAr'];
					$res .=  '</a>';
				}else{
					$res .=  '>';
					$res .= $row['NameAr'];
					$res .=  '</a>';
				}
			}else if( $_GET['lang'] == 'ch' ){
				if(strtolower($active_nav_name['Name']) == strtolower($row['Name'])){
					$res .=  'class="imactive">';
					$res .= $row['NameCh'];
					$res .=  '</a>';
				}else{
					$res .=  '>';
					$res .= $row['NameCh'];
					$res .=  '</a>';
				}
			}

		}

	}
	echo mysqli_error($mysqli);
	return $res;
}
if(!isset($_SESSION) ){session_start();}
include_once('classes/class_getLocale.php');
?>
<script type="text/javascript">
	var Glocale = <?php print_r(geLocale()) ?>;
</script>
<div class="ui container large nopad" >
	
	<div class="ui internally celled grid nopad goodtimes" id="topnav">
		<div class="row nopad">
			<div class="sixteen wide column nopad nobox logo">
				<div class="alpha floatleft">
					<a href="Home-nav" id="Home-nav" locale="alpha">@</a>
					<img src="../assets/alpha2.png">
				</div>
				
				
				<div class="top-nav-sub-group floatleft">
					<center>
						<?php echo getNavItems( getPageID(get_current_route()) ); ?>
						<div id="activeNav"></div>
					</center>
				</div>
				
				
				<div class="top-tel-sub-group floatright">
					
					<p class="mrspace"></p>

					<div class="ui instant dropdown lang smallfont hundredinwidth"  id="lang">
						<input type="hidden" name="language">
						<i class="dropdown icon farright"></i>
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


					<a class="ui  image label carticon" style="padding-left: 0!important;padding-right: 0px;" href="cart?lang=<?php echo $_GET['lang']; ?>&active=cart">
						<div class="detail" style="margin-right: 0px;margin-left: 9px;border-radius:0;padding-bottom: 7px;height: 30px;padding-left: 7px;padding-right: 7px;">
							<p class="cnt" style="float:right;">0</p>
							<i class="ui cart icon"></i>
						</div>

						<?php
						if(false){
							if (isset($_SESSION['username'])) {
								echo'<div  class="detail floatright" style="margin-right: 0px;margin-left: 5px;border-radius:0;padding-bottom: 7px;height: 30px;padding-left: 7px;padding-right: 7px;">
								<i class="ui alarm icon" style="margin-left: 0px;margin-right: 0px;"></i>
								0
							</div>';
						}
					}
					?>

					<p locale="guest" style="float:right;margin-right: 5px;margin-left: 5px;">
						<?php if (isset($_SESSION['username'])) { echo $_SESSION['username']; } else { echo '@'; }?>
					</p>

					

				</a>

			</div>
			<div id="line0"><p locale="lightUpYourLife">@</p></div>
		</div>
	</div>
</div>
</div>
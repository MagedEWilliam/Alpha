<?php
function current_route(){
	$query = $_SERVER['PHP_SELF'];
	$path = pathinfo( $query );
	$what_you_want = $path['basename'];
	return $what_you_want;
}
?>
<div class="ui container large nopad" >
	
	<div class="ui internally celled grid nopad goodtimes" id="topnav">
		<div class="row nopad">
			<div class="four wide column nopad nobox logo">
				<div class="alpha">
					<a href="#" id="Home-nav">ALPHA</a>
				</div>
				<div id="line0"><p>Light up your life</p></div>
				<img src="../assets/alpha2.png">
			</div>
			<div class="eight wide column nopad nobox top-nav-group">
				<div class="top-nav-sub-group">
					<a href="#" id="Products-nav">Products</a>
					<a href="#" id="Media-nav">Media</a>
					<a href="#" id="About-nav">About</a>
					<a href="#" id="Why-nav">Contact Us</a>
				</div>
				<div id="line1"></div>
			</div>
			<div class="four wide column nopad nobox rtl top-nav-sub-group">
				<div class="top-tel-sub-group">
					<p class="tel-space smallfont" style="float: left">tel: +20 22 39 03 110</p>

					<select class="lang smallfont hundredinwidth" id="mlang">
						<option value="ar">Arabic</option>
						<option value="en">English</option>
						<option value="ch">Chinese</option>
					</select>

					<div class="ui inline selection instant dropdown lang smallfont hundredinwidth"  id="lang">
					<input type="hidden" name="language">
  					<i class="dropdown icon farright"></i>
					<div class="default text">Select Friend</div>
						<div class="menu">
							<div class="item" data-value="ar">
							<i class="icon translate"></i>
								Arabic
							</div>
							<div class="item" data-value="en">
								<i class="icon translate"></i>
								English
							</div>
							<div class="item" data-value="ch">
								<i class="icon translate"></i>
								Chinese
							</div>
						</div>
					</div>

				</div>
				<div id="line2"></div>
			</div>
		</div>
	</div>
</div>
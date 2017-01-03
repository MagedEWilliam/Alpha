<?php

if( isset($_GET['compo']) ){
	$level = '';
for ($i=0; $i < $_GET['__level'] ; $i++) { 
	$level .= '../';
}
require_once($level.'classes/class_database.php');
	echo '<!DOCTYPE html>
<html style="height: 100%;">
<head>';
	include('../links.php');
	echo '</head>
	<body style="height:100%;">
	<div class="ui " style="height: 100%;" >
					<div class="ui internally stackable nomarg celled grid ui segment" style="height:100%;">';
	
include_once($level.'classes/class_getLocale.php');
}
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8&appId=113072815862749";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript">
	var Glocale = <?php print_r(geLocale()) ?>;
</script>
<div class="row" action="checkout.php">
	<div class="eight wide column">
		<center>
			<img src="" class="bragimg">
		</center>

		<br>
		<center>
			<button class="ui blue button">
				<p class="goodtimes" locale="toCart">
					<i class="ui icon cart"></i>
					@
				</p>
			</button>
		</center>
	</div>
	<div class="eight wide column">
		<h4 class="goodtimes ">Product details</h4>
		<table class="ui very compact striped unstackable table" id="product_details">
			<tbody>

			</tbody>
		</table>
	<div class="fb-comments" data-href="https://i-alfa.info" data-width="400" data-numposts="5"></div>
<script>
    $(".fb-comments").attr("data-href", "https://i-alfa.info?product_id=" + $.query.get('product_id'));
</script>
	</div>

</div>
<?php
if( isset($_GET['compo']) ){
	echo '</div></div></body></html>';
}
?>
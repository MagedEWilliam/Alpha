<?php


if( isset($_GET['compo']) ){
require_once('../../classes/class_database.php');
	echo '<!DOCTYPE html>
<html><head>';
	$_GET['__level']=2;
	include('../links.php');
	echo '</head><body>';

	
include_once('../../classes/class_getLocale.php');
}
?>
<script type="text/javascript">
	var Glocale = <?php print_r(geLocale()) ?>;
</script>
<div class="row">
	<div class="eight wide column">

		<center>
			<img src="http://noorina.com/website-images/view/5497f0e01c4bf.jpg" class="bragimg">
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
	</div>

</div>
<?php
if( isset($_GET['compo']) ){
	echo '</body></html>';
}
?>
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
<script type="text/javascript">
	var Glocale = <?php print_r(geLocale()) ?>;
</script>
<div class="row">
	<div class="ten wide column">

		<h4 class="goodtimes ">Items details</h4>
		<table class="ui very compact striped unstackable table" id="product_details">
			<tbody>

			</tbody>
		</table>

	</div>
	<div class="six wide column">
		<h4 class="goodtimes ">total</h4>
		<table class="ui very compact striped unstackable table" id="product_details">
			<tbody>

			</tbody>
		</table>
	</div>

</div>
<?php
if( isset($_GET['compo']) ){
	echo '</div></div></body></html>';
}
?>
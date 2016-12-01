<?php
function get_current_route(){
	$query = $_SERVER['PHP_SELF'];
	$path = pathinfo( $query );
	$what_you_want = $path['basename'];
	print_r( $what_you_want );
}
echo get_current_route();

?>
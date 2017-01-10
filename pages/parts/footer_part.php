<br><br><br>
<div style="position: relative;">
	<img src="../assets/shadowdown.png" class="shadowdown">
	<div class="ui container large pagefooter">
		<?php 
		function getBaseContentOf($part){
			$db        = Database::getInstance();
			$mysqli    = $db->getConnection();

			$sqlQuery = "SELECT * FROM `parts`";
			$sqlQuery .= " Where `partid` = '" . $part . "'";

			if ($result = $mysqli->query($sqlQuery)) {
				echo mysqli_error($mysqli);
				return $row = $result->fetch_assoc()[_locale('content')];
			}
		}

		echo getBaseContentOf( 'Footer' );

		?>
		<br>
		<br>
	</div>
	<div class="ui grid" style="background-color: #0061a5;height: 50px;">
		<p style="color:#999; text-align: center;width: 100%;margin-top: 10px;">©2017 Alpha.com, All rights reserved.</p>
	</div>
</div>
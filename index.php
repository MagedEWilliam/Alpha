<?php 
echo '<meta http-equiv="Location" content="page/home?lang=ar">';
echo '<script>window.location.replace("page/home?lang=ar");</script>';
header("Location: page/home?lang=ar");
die();
?>

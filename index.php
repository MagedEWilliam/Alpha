<?php 
// die('coop');
echo '<meta http-equiv="Location" content="page/products?lang=ar">';
echo '<script>window.location.replace("page/products?lang=ar");</script>';
header("Location: page/Home?lang=ar");
die();
?>

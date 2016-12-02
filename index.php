<?php 
echo '<meta http-equiv="Location" content="page/products?lang=ar">';
echo '<script>window.location.replace("page/products?lang=ar");</script>';
header("Location: page/products?lang=ar");
die();
?>

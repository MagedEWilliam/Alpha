<?php 
$level = '';
for ($i=0; $i < $_GET['__level'] ; $i++) { 
	$level .= '../';
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="icon" href="<?php echo $level; ?>assets/alpha2.png">
<link rel="stylesheet" type="text/css" href="<?php echo $level; ?>libs/semantic/semantic.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $level; ?>css/style.css">
<script type="text/javascript" src="<?php echo $level; ?>libs/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $level; ?>libs/jquery.flip.min.js"></script>
<script type="text/javascript" src="<?php echo $level; ?>libs/jquery.query-object.min.js"></script>
<script type="text/javascript" src="<?php echo $level; ?>libs/semantic/semantic.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $level; ?>libs/amazonmenu/amazonmenu.css">
<script src="<?php echo $level; ?>libs/amazonmenu/amazonmenu.min.js"></script>
<script type="text/javascript" src="<?php echo $level; ?>js/components.js"></script>
<script type="text/javascript" src="<?php echo $level; ?>js/script.js"></script>
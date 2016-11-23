<!DOCTYPE html>
<html>
<head>
	<title>ALPHA - LIGHT UP YOUR LIFE</title>
	<link rel="stylesheet" type="text/css" href="libs/semantic/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="libs/jquery.min3.js"></script>
	<script type="text/javascript" src="libs/jquery.flip.min.js"></script>
	<script type="text/javascript" src="libs/semantic/semantic.min.js"></script>
	<script type="text/javascript" src="js/components.js"></script>
</head>
<body id="example" class="layouts pushable">
	<?php include_once('pages/topnav/topnav.php'); ?>
	<div class="pusher">
		<div class="full height">
			<div class="article">
				<div class="ui container large">
					
					<div class="ui internally celled grid ui segment">
						<div class="row  nopad">
							<div class="three wide column goodtimes"  id="sideNav">
								<p>Categories:</p>
							</div>
							<div class="thirteen wide column " id="product">
								<div class="ui grid">
									<div class="ten wide column">
										<div class="ui breadcrumb">
											<a class="section">
												<i class="ui home icon"></i>
											</a>
											<span class="divider">/</span>
											<div  class="section">Products</div>

										</div>
									</div>
									<div class="six wide column rtl searchresultcount"><p class="rtl">search result</p></div>
								</div>
								<div class="ui divider"></div>
								<div id="products" class="ui cards">
									
								</div>
								<br>
								<div class="ui divider"></div>
								<div id="productfooter">
									<p>Products footer goes here</p>
								</div>
							</div>
						</div>
					</div>

				</div>
				<br>
				<br>
			</div>
		</div>
	</div>
</div>
</body>
</html>
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
							<label style="font-size: 17px;margin-bottom: 11px;" id="dolla"></label>
							
							<br>
							<div class="ui tiny action input" id="Qun_<?php echo $_GET['product_id']; ?>" style="width:155px;height:25px;margin-bottom:5px;">
								<input type="number" value="1" style="width:60px;" lass="ui tiny">
								<div type="submit" class="ui tiny icon button minusOne"><i class="ui icon minus"></i></div>
								<div type="submit" class="ui tiny icon button addOne"><i class="ui icon plus"></i></div>
							</div>

							<br>
							<a class="ui blue button" id="cart_<?php echo $_GET['product_id']; ?>">
								<p class="goodtimes" locale="toCart">
									<i class="ui icon cart"></i>
									@
								</p>
							</a>
						</center>
					</div>
					<div class="eight wide column">
						<h4 class="goodtimes ">Product details</h4>
						<table class="ui very compact striped unstackable table" id="product_details">
							<tbody>

							</tbody>
						</table>
						<div class="fb-comments" data-href="https://i-alfa.info" data-width="100%" data-numposts="5"></div>
						<script>
							$(".fb-comments").attr("data-href", "https://i-alfa.info?product_id=" + $.query.get('product_id'));

							$('#cart_' + $.query.get('product_id')).on("click", function(event){
								tothecart($.query.get('product_id'), event);
							});

							$('div.minusOne').on('click', function(){
								R(true, $.query.get('product_id'));
							});

							$('div.addOne').on('click', function(){
								R(false, $.query.get('product_id'));
							});

							function R(isminuse, imtcod){
								var current = $( $('#Qun_'+imtcod+' input') ).val();
								if(isminuse){
									if(current > 1){
										$( $('#Qun_'+imtcod+' input') ).val(Number(current)-1);
									}
								}else{
									$( $('#Qun_'+imtcod+' input') ).val(Number(current)+1);
								}
								qunChanges(imtcod, $('#Qun_'+imtcod+' input') );
							}

						</script>
					</div>

				</div>
				<?php
				if( isset($_GET['compo']) ){
					echo '</div></div></body></html>';
				}
				?>
function card(target){
	$(target).append('\
	<div class="ui card longproduct">\
		<div class="ui move up reveal image longy" >\
			<div class="visible content fillitcontent">\
				<img src="assets/blank.jpg" >\
				<div class="fillitup"></div>\
			</div>\
			\
			<div class="hidden content heigh">\
				<div class="fastdetails">\
					<table class="ui very compact striped table " style="margin-bottom:0;">\
						<tbody>\
							\
							<tr>\
								<td class="rtl slpad rpad">\
									<img src="assets/blank.jpg" class="visible content">\
								</td>\
								<td  class="slpad">\
									<b>Elliot fu</b>\
									<br>\
									<p>Friend</p>\
								</td>\
						    </tr>\
					    	\
							<tr>\
								<td class="rtl slpad rpad">Wattage</td>\
								<td  class="slpad">\
									<div class="ui tiny label">12W</div>\
								</td>\
						    </tr>\
					    	\
							<tr>\
								<td class="rtl slpad rpad">Lifespan</td>\
								<td  class="slpad">\
									<div class="ui tiny label">25000Hrs</div>\
								</td>\
						    </tr>\
					    	\
							<tr>\
								<td class="rtl slpad rpad">Colors</td>\
								<td  class="slpad">'
									+tinylabel(2700)
									+tinylabel(3000)+
									+tinylabel(4000)+
									+tinylabel(5000)+
									+tinylabel('6500K')+
								'</td>\
						    </tr>\
					    	\
							<tr>\
								<td class="rtl slpad rpad">Luminosity</td>\
								<td  class="slpad">'
									+tinylabel('1050LM')+
								'</td>\
						    </tr>\
					    	\
							<tr>\
								<td class="rtl slpad rpad">Beam angle</td>\
								<td  class="slpad">'
									+tinylabel('240&deg;')+
								'</td>\
						    </tr>\
					    	\
							<tr>\
								<td class="rtl slpad rpad">Dimming</td>\
								<td  class="slpad">'
									+tinylabel('Standard')+
								'</td>\
						    </tr>\
					  	</tbody>\
					  	</table>\
					  	<table class="ui very compact ">\
								<center>Supported Bases:\
								<br>\
								<div class="ui tiny image label"><img src="assets/blank.jpg">E12</div>\
								<div class="ui tiny image label"><img src="assets/blank.jpg">E14</div>\
								<div class="ui tiny image label"><img src="assets/blank.jpg">E17</div>\
								<div class="ui tiny image label"><img src="assets/blank.jpg">B22</div>\
							</center>\
							<div class="gentleH"></div>\
					</table>\
					\
				</div>\
			</div>\
		</div>\
		<div class="content">\
			<div class="header">Elliot Fu</div>\
			<div class="meta">Friend</div>\
		</div>\
		<div class="extra content">\
			<center> \
				<div class="ui tiny buttons">\
					<button class="ui blue  small button"><p class="goodtimes">Details</p></button >\
					<div class="or"></div>\
					<button class="ui yellow small button"><p class="goodtimes">Buy Now</p></button >\
				</div>\
			</center>\
		</div>\
	</div>\
	');
}
function tinylabel(val){
	return '<div class="ui tiny label">'+val+'</div>';
}

$(document).ready(function(){
	card( $('#products') );
	card( $('#products') );
	card( $('#products') );
	card( $('#products') );
	card( $('#products') );
	card( $('#products') );
	card( $('#products') );
});
function card(target, ItemProp){
	$(target).append('\
		<div class="ui card card3d longproduct">\
			<div class="ui  image longy" >\
				<div class="front content fillitcontent">\
					<img src="'+ItemProp.image+'" class="fillitup">\
				</div>\
				\
				<div class=" back content heigh">\
					<div class="fastdetails">\
						<table class="ui very compact striped table " style="margin-bottom:0;">\
							<tbody>\
									\
									<tr>\
										<td class="rtl slpad rpad">\
											<img src="'+ItemProp.image+'"  width="50">\
										</td>\
										<td  class="slpad content">\
											<b>'+ItemProp.Name+'</b>\
											<br>\
											<p>'+ItemProp.code+'</p>\
										</td>\
								    </tr>'
										+trtd(ItemProp.properties[0])+
							  	'</tbody>\
						  	</table>\
					</div>\
				</div>\
			</div>\
				<div class="content parento">\
					<div class=" getdown">\
						<div class="ui header">'+ItemProp.Name+'</div>\
						<div class="meta">'+ItemProp.code+'</div>\
					</div>\
					<br>\
					\
					<div class=" getdown" style="bottom:14px;width: 287px;">\
						<div class="ui tiny buttons detailtable">\
							<button class="ui blue  small button"><p class="goodtimes">Details</p></button >\
							<div class="or"></div>\
							<button class="ui yellow small button"><p class="goodtimes">Buy Now</p></button >\
						</div>\
					</div>\
			</div>\
		</div>\
	</div>\
\
	');
}
function tinylabel(val){
	return '<div class="ui tiny label">'+val+'</div>';
}

function tinyimagelabel(val, src){
	return '<div class="ui tiny image label"><img src="'+src+'">'+val+'</div>';
}

function rtlSlpadrPad(cls, val){
	return '<td class="'+cls+'">'+val+'</td>';
}

function trtd(prop){
	var temp = "";
	for (var i = 0; i <= prop.length-1; i++) {
	console.log(prop[i].Name);
		temp += '<tr>'
					+rtlSlpadrPad('rtl slpad rpad', prop[i].Name)
					+rtlSlpadrPad('slpad', prop[i].value)+
				'</tr>';
	}
return temp;
}

$(document).ready(function(){

	$.ajax({
		url: "classes/class_getCard.php"
	}).done(function(data) {
		data = jQuery.parseJSON(data);
		for (var i = 0; i <= data.length-1; i++) {
			card( $('#products'), data[i] );
		}

		$('.searchresultcount').text('Showing ' + i + ' results');
		$('.card3d').flip({
			trigger: 'hover',
			speed: 300
		});
		console.log(data);
	});

});
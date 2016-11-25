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
											<b>'+ItemProp[locale('Name')]+'</b>\
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
						<div class="ui header">'+ItemProp[locale('Name')]+'</div>\
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

function locale(source){
	var local = getUrlParameter('lang');
	var ret   = "";
	if(local  == 'en'){
		ret   = source;
	}else if(local == 'ar'){
		ret   = source + "Ar";
	}else if(local == 'ch'){
		ret   = source + "Ch";		
	}
	return ret;
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
		temp += '<tr>'
					+rtlSlpadrPad('rtl Fixedtd slpad rpad ', prop[i][locale('Name')])
					+rtlSlpadrPad('slpad', prop[i][locale('value')])+
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
	});

	$('.lang').dropdown({
		on: 'hover',
		action: function(text, value) {
			console.log(value);
      		var newurl = window.location.href;
			var gotothis = newurl.replace(/lang=[^&]+/, 'lang='+ value );
			window.location.href = gotothis;
	  }
	});

	$('.lang').dropdown('set selected', getUrlParameter('lang'));

	$('#Home-nav')    .prop('href', "index.php?lang=ar");
	$('#Products-nav').prop('href', "products.php?lang=" + getUrlParameter('lang'));
	$('#Media-nav')   .prop('href', "index.php?lang=ar");
	$('#Why-nav')     .prop('href', "index.php?lang=ar");
});

var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = decodeURIComponent(window.location.search.substring(1)),
  sURLVariables = sPageURL.split('&'),
  sParameterName,
  i;

  for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split('=');

    if (sParameterName[0] === sParam) {
      return sParameterName[1] === undefined ? true : sParameterName[1];
    }
  }
};
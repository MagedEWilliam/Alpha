function card(target, ItemProp){
	$(target).append('\
		<div class="ui card card3d longproduct">\
			<div class="ui  image longy" >\
				<div class="front content fillitcontent">\
				<img src="'+ItemProp.item.image+'" class="fillitup">\
			</div>\
			\
			<div class=" back content heigh">\
				<div class="fastdetails">\
						<table class="ui very compact striped unstackable table " style="margin-bottom:0;">\
							<tbody>\
								\
								<tr>\
									<td class="rtl slpad rpad">\
										<img src="'+ItemProp.item.image+'"  width="50">\
									</td>\
									<td  class="slpad content">\
										<b>'+ItemProp.item[locale('Name')]+'</b>\
									<br>\
										<p>'+ItemProp.item.code+'</p>\
									</td>\
								</tr>'
								+trtd(ItemProp)
								+
							'</tbody>\
						</table>\
				</div>\
			</div>\
			</div>\
			<div class="content parento">\
				<div class=" getdown">\
				<div class="ui header">'+ItemProp.item[locale('Name')]+'</div>\
				<div class="meta">'+ItemProp.item.code+'</div>\
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
	console.log(prop.Subcategory);
	for (var i = 0; i <= prop.Subcategory.length-1; i++) {
		// if(prop.Subcategory[i]['Name'] != 'Subcategory'){
			temp += '<tr>'
			+rtlSlpadrPad('rtl Fixedtd slpad rpad ', prop.Subcategory[i][locale('Name')])
			+rtlSlpadrPad('slpad', prop.Subcategory[i][locale('value')])
			+'</tr>';
		// }
	}
	return temp;
}

function categorylist(text, url, i){
	var ret = 
	'<div class="item">\
		<div class="content">\
			<a class="header popupmeup_'+i+'" href="'+url+'">'+text+'</a>\
			<div class="ui fluid popup right center transition hidden tailcover">\
				<div class="ui grid" style="width: 400px;height:100px;z-index:800">\
					<div class="column">1</div>\
				</div>\
				<img class="tail" src="assets/tip.png"/>\
			</div>\
		</div>\
	</div>';
	return ret;
}

function folders(target, text, link, i, cls){
	$(target).append( '<li id="sub_'+i+'">\
		<a class="'+cls+'" href="'+link+'">'+text+'</a>\
		</li>');

	return '#sub_' + i;
}

function resizeClasses(){
	if (window.matchMedia('(min-width: 1200px)').matches) {
        $('#sideNav').removeClass('six wide column goodtimes');
		$('#sideNav').addClass('three wide column goodtimes');

        $('#product').removeClass('ten wide column ');
        $('#product').addClass('thirteen wide column ');
	}else if (window.matchMedia('(max-width: 1000px)').matches) {
        $('#sideNav').removeClass('three wide column goodtimes');
        $('#sideNav').addClass('six wide column goodtimes');

        $('#product').removeClass('thirteen wide column ');
        $('#product').addClass('ten wide column ');
    }
}

function populateSubmenu(data){
	for (var i = 0; i <= data.length-1; i++) {
		var link = '?lang=' + getUrlParameter('lang') + '&cat=' + data[i]['ID'];
		var nowfolder = folders('#sidebarmenu', data[i][locale('Name')], link, i, '');

		var subsub = data[i]['subcategory'][0];
		var subsubcount = subsub.length;

		if(subsubcount > 0){
			$(nowfolder).append('<ul id="sub__'+i+'">');
			for (var k = 0; k < subsubcount; k++) {
				if( subsub[k]['Name'] == "Subcategory"){
					var sublink = link + "&subcat=" + subsub[k]['categoryID'];
					folders('#' + 'sub__' + i, subsub[k][locale('value')], sublink, "sub_" + k, 'noshadows');
				}
			}
		}
	}
}
$(document).ready(function(){
	var local  =  getUrlParameter('lang');
	var cat    =  getUrlParameter('cat');
	var subcat =  getUrlParameter('subcat');

	resizeClasses();

	$(window).on('resize', resizeClasses);
	


	var getcardurl = "classes/class_getCard.php";
	if(cat != undefined){
		getcardurl += '?cat=' + cat;
	}
	if(subcat != undefined){
		getcardurl += '&subcat=' + subcat;
	}

	$.ajax({
		url: getcardurl
	}).done(function(data) {
		data = jQuery.parseJSON(data);
		console.log(data);
		for (var i = 0; i <= data.length-1; i++) {
			card( $('#products'), data[i]);
		}
		$('.searchresultcount').text('Showing ' + i + ' results');
		$('.card3d').flip({
			trigger: 'hover',
			speed: 300
		});
	});




	$.ajax({
		url: "classes/class_getCategory.php"
	}).done(function(data) {
		data = jQuery.parseJSON(data);

		populateSubmenu(data);
		amazonmenu.init({menuid: 'mysidebarmenu'});
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

	$('#Home-crumb')    .prop('href', "index.php?lang=ar");
	$('#Home-nav')      .prop('href', "index.php?lang=ar");
	$('#Products-nav')  .prop('href', "products.php?lang=" + getUrlParameter('lang'));
	$('#Media-nav')     .prop('href', "media.php?lang=ar");
	$('#About-nav')     .prop('href', "about.php?lang=ar");
	$('#Why-nav')       .prop('href', "contact.php?lang=ar");
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
function card(target, ItemProp, classes, isitlong){
	var cartnaming = '';
	if(classes == 'blue'){ cartnaming = getFromLocale('toCart');}
	else if(classes == 'out'){ cartnaming = getFromLocale('outOfStock'); }
	else { cartnaming = getFromLocale('added')  + ' ✓';}
	if(classes == 'out'){ classes = 'disabled'}
		var drawacard = '\
	<div class="ui card '+isitlong+'">\
	<div class="ui slide masked move up reveal image" >\
	<div class="content fillitcontent">\
	<img src="'+ItemProp.item.image+'" class="front visible content fillitup">\
	</div>\
	\
	<div class="back hidden content heigh" >\
	<div class="fastdetails">\
	<table class="ui striped unstackable table " style="margin-bottom:0;">\
	<tbody>\
	\
	<tr>\
	<td class="rtl slpad rpad">\
	<img src="'+ItemProp.item.image+'"  class="thumpimg">\
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
	<div class="visible content parento">\
	<div class=" getdown">\
	<div class="ui header">'+ItemProp.item[locale('Name')]+'</div>\
	<div class="meta">'+ItemProp.item.code+'</div>\
	</div>\
	';

	if(classes == 'blue'){
		drawacard += '<div class="ui tiny action input" id="Qun_'+ItemProp.item.code+'" style="float:right;width:145px;height:25px;margin-bottom:5px;">\
		<input type="number" value="1" style="width:50px;" lass="ui tiny">\
		<div type="submit" class="ui tiny icon button minusOne"><i class="ui icon minus"></i></div>\
		<div type="submit" class="ui tiny icon button addOne"><i class="ui icon plus"></i></div>\
		</div>';
	}

	if(Number(ItemProp.item.onsale) == 1){
		drawacard += '<label style="float:left;font-size: 17px;">$'+Number(ItemProp.item.priceafterdisc);
		drawacard +='<label class="ui tag orange tiny label" style="margin-left:20px;">-'+Number(ItemProp.item.discount)+'%</label>';
		drawacard +='</label>';
	}else{
		drawacard += '<label style="float:left;font-size: 17px;margin-bottom: 11px;">$'+Number(ItemProp.item.price);
		drawacard +='</label>';
	}
	drawacard += '\
	<div class=" getdown">\
	<div class="ui tiny buttons detailtable">\
	<a class="ui yellow small button" id="'+ItemProp.item.code+'" href="product_details?lang='+$.query.get('lang')+'&product_id='+ ItemProp.item.code +'"><p class="goodtimes">'+getFromLocale('details')+'</p></a>\
	<div class="or"></div>\
	<a class="ui '+classes+' small button"  id="cart_'+ItemProp.item.code+'" ><p class="goodtimes">'+ cartnaming +'</p></a>\
	</div>\
	</div>\
	</div>\
	</div>\
	</div>\
	';

	$(target).append(drawacard);

	$('#' + ItemProp.item.code).on("click", function(event){
		event.preventDefault();
		modaleinfo(ItemProp.item.code);
	});

	$('#cart_' + ItemProp.item.code).on("click", function(event){
		tothecart(ItemProp.item.code, event);
	});

	var imtcod = ItemProp.item.code;
	$('#Qun_'+imtcod+' div.minusOne').on('click', function(){
		P(true, imtcod);
	});

	$('#Qun_'+imtcod+' div.addOne').on('click', function(){
		P(false, imtcod);
	});
}

function P(isminuse, imtcod){
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

function modaltoopen(e){
	e.preventDefault();
}

function modaleinfo(item){
	$('#product_detail').html('');
	$('#product_detail').append('\
		<div class="header"><a class="ui small button" onclick="$(\'.modal\').modal(\'hide\')">\
		<i class="ui close icon"></i>\
		Close</a></div>\
		<div class="description">\
		<iframe class="ui iframe" frameborder="0" src="../pages/products/product_details.php?lang='+$.query.get('lang')+'&product_id='+ item +'&compo=1&__level=2">\
		</div>\
		\
		');
	$('#product_detail').modal({transition: 'fade up'});
	$('#product_detail').modal('show');
}

function getFromLocale(word){
	for (var i = 0; i <= Glocale.length; i++) {
		if( Glocale[i].key == word ){
			return Glocale[i][locale('value')];
		}
	}
}

function locale(source){
	var local = $.query.get('lang');
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

function trlSlpadrPad(id, cls){
	return '<tr id="'+id+'" class="'+cls+'"></tr>';
}

function rtlSlpadrPad(cls, val){
	return '<td  class="'+cls+'">'+val+'</td>';
}

function lblSlpadrPad(val){
	return '<b style="float:left;"">'+val+' </b>';
}

function trtd(prop){
	var temp = "";

	$.each(prop.Subcategory, function(i, value) {
		if(prop.Subcategory[i]['Name'] != "Subcategory"){
			temp += '<tr>'
			temp += rtlSlpadrPad('rtl Fixedtd slpad rpad', prop.Subcategory[i][locale('Name')]);
			temp += '<td class="slpad" style="padding-top:1px;padding-bottom:2px;">';
			temp += lblSlpadrPad( prop.Subcategory[i][locale('value')]);

			$.each(prop.Subcategory[i]['more'], function(x, value) {
				temp += lblSlpadrPad( ', ' + prop.Subcategory[i]['more'][x][locale('value')] );
			});

			temp += '</td>';
			temp += '</tr>';
		}
	});
	
	return temp;
}

function categorylist(text, url, i){
	var ret = 
	'<div class="item">\
	<div class="content">\
	<a class="header popupmeup_'+i+'" href="'+url+'">'+text+'</a>\
	<div class="ui fluid popup right center transition hidden tailcover">\
	<div class="ui grid" style="width: 400px;height:100px;z-index:800">\
	<div class="row">\
	<div class="column">1</div>\
	</div>\
	</div>\
	<img class="tail" src="assets/tip.png"/>\
	</div>\
	</div>\
	</div>';
	return ret;
}

function nfolders(target, text, link, i, cls){
	$(target).append( '<div id="suub_'+i+'">\
		<a class="'+cls+'" href="'+link+'">'+text+'</a>\
		</div>');

	return '#sub_' + i;
}

function mnfolders(target, text, link, i, cls){
	$(target).append( '<div class="four wide column catgor" id="sub_'+i+'">\
		<a class="'+cls+'" href="'+link+'">'+text+'</a>\
		</div>');

	return '#sub_' + i;
}

function folders(target, text, link, i, cls){
	$(target).append( '<li id="sub_'+i+'">\
		<a class="'+cls+'" href="'+link+'">'+text+'</a>\
		</li>');

	return '#sub_' + i;
}

function mfolders(target, text, link, i, cls){
	$(target).append( '<option id="sub_m'+i+'" value="'+link+'">'+text+'</option>');

	return '#sub_m' + i;
}

function nativeSelect(cls, id){
	var ret = '\
	<select class="'+cls+'" id="'+id+'">\
	<option value="ar">Arabic</option>\
	<option value="en">English</option>\
	<option value="ch">Chinese</option>\
	</select>\
	';
	return ret;
}

function resizeClasses(){
	var screenwid = Number( $('html').css('width').replace('px', '') );
	if (screenwid > 1200) {
		$('.move.up').addClass('.reveal');
		the3dcard(true);
		if(! $('.bigboss').hasClass( "container" ) ){
			$('.bigboss').addClass('container');
		}
		$('.top-nav-sub-group center').css('width', 'auto' );
	}
	if ( screenwid < 1000) {
		$('.move.up').addClass('.reveal');
		the3dcard(true);
		if(! $('.bigboss').hasClass( "container" ) ){
			$('.bigboss').addClass('container');
		}
		$('.top-nav-sub-group center').css('width', 'auto' );
	}
	if ( screenwid < 999 && screenwid > 565) {
		if( $('.bigboss').hasClass( "container" ) ){
			$('.bigboss').removeClass('container');
		}
		$('.top-nav-sub-group center').css('width', 'auto' );
	}
	if ( screenwid < 565) {
		$('.move.up').removeClass('.reveal');
		$('head [name=viewport]').remove();
		$('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">');
		the3dcard(false);
		mobilewidth();
		focusactive();

	}
}

function mobilewidth(){
	var potenWidth = 50;
	$('.top-nav-sub-group a').each(function(i, current){
		potenWidth += Number( $(current).css('width').replace('px', '') );
	});
	$('.top-nav-sub-group center').css('width', potenWidth + 'px' );
}

function focusactive(){
	if($('.imactive').length){
		$('.top-nav-sub-group').animate({scrollLeft: $('.imactive').position().left}, 800);
	}else{
		$('.top-nav-sub-group').animate({scrollLeft: $('.top-nav-sub-group a').first().position().left}, 800);
	}
}

function the3dcard(i){
	var haschi = $('.back.hidden').length;
	if(i){
		if(haschi == 0){
			$('.back').addClass('hidden content');
		}
		$('.front').show();
	}else{
		if(haschi > 0){
			$('.back').removeClass('hidden content');
		}
		$('.front').hide();
	}
}

function productalt(i){
	if(i == true){
		$('#product').removeClass('thirteen wide column ');
		$('#product').removeClass('ten');
		$('#product').removeClass('sixteen');
		$('#product').addClass('ten wide column');
	}else if(i == false){
		$('#product').removeClass('ten');
		$('#product').removeClass('ten wide column');
		$('#product').addClass('sixteen wide column');
	}else if(i == 3){
		$('#product').removeClass('ten wide column');
		$('#product').addClass('thirteen wide column');
	}
}

function sideNavalt(i){
	if(i){
		$('#sideNav').removeClass('.three .wide .column');
		$('#sideNav').addClass('.six .wide .column');
	}else{
		$('#sideNav').removeClass('.six .wide .column');
		$('#sideNav').addClass('.three .wide .column');
	}
}


function subcatmobalt(i){
	if(i){
		$('#subcatmob').removeClass('ten wide column');
		$('#subcatmob').addClass('sixteen wide column');
	}else{
		$('#subcatmob').removeClass('sixteen wide column');
		$('#subcatmob').addClass('ten wide column ');
	}
}

function langalt(i){
	if(i){
		$('#lang').hide();
		$('#mlang').show();
		var local  =  $.query.get('lang');
		$('#mlang').val(local);
		$('#mlang').on('change', function (value){
			var newurl = window.location.href;
			var val = $('#mlang').val();
			var gotothis = newurl.replace(/lang=[^&]+/, 'lang='+  val);
			window.location.href = gotothis;
		});
	}else{
		$('#mlang').hide();
		$('#lang').show();
	}
}

function minisubmenu(){

	$('#mobilesubmenu').on('change', function(){
		window.location.href = $('#mobilesubmenu').val();
	});
}

var subcatdups = [];

function populateSubmenu(data){
	var local = $.query.get('lang');
	for (var i = 0; i <= data.length-1; i++) {
		var link = '?lang=' + local + '&cat=' + data[i]['ID'];
		var nowfolder = folders('#sidebarmenu', data[i][locale('Name')], link, i, '');
		
		var subsub = data[i]['subcategory'][0];
		var subsubcount = subsub.length;

		$('#mobilesubmenu').append('<optgroup id="sub_m_'+i+'" label='+data[i][locale('Name')]+' ">');
		
		$(nowfolder).append('<ul id="sub__'+i+'">');
		

		folders ('#' + 'sub__' +  i, getFromLocale("all") + ' ' + data[i][locale('Name')], link, "sub_-1", 'noshadows');
		mfolders('#' + 'sub_m_' + i, getFromLocale("all") + ' ' + data[i][locale('Name')], link, "sub_m-1", '');

		if(subsubcount > 0){
			for (var k = 0; k < subsubcount; k++) {
				
				var issubdub = issubdubs( subcatdups, subsub[k]['valueID'], k );
				if( subsub[k]['Name'] == "Subcategory"){
					if(issubdub){
						var sublink = link + "&subcat=" + subsub[k]['valueID'];
						folders('#' + 'sub__' + i, subsub[k][locale('value')], sublink, "sub_" + k, 'noshadows');
						mfolders('#' + 'sub_m_' + i, subsub[k][locale('value')], sublink, "sub_m" + k, '');
					}
				}
			}
		}
	}

	var heighty = i * 30;
	$('#sidebarmenu').css({'height': heighty + 'px'});
	if(local != 'en'){$('#mysidebarmenu li').css({'font-size':'15px'});}
}

function populateMiniCategory(data){
	var local = $.query.get('lang');
	for (var i = 0; i <= data.length-1; i++) {
		var link;
		if(pageName() == 'Home'){
			link = 'products?lang=' + local + '&cat=' + data[i]['ID'];
		}else{
			link = '?lang=' + local + '&cat=' + data[i]['ID'];
		}
		var nowfolder = mnfolders('.minicategory', data[i][locale('Name')], link, i, '');
		
		var subsub = data[i]['subcategory'][0];
		var subsubcount = subsub.length;
		
		$(nowfolder).append('<li id="sub__'+i+'">');

		if(subsubcount > 0){
			for (var k = 0; k < subsubcount; k++) {
				
				var issubdub = issubdubs( subcatdups, subsub[k]['valueID'], k );
				if( subsub[k]['Name'] == "Subcategory"){
					if(issubdub){
						var sublink = link + "&subcat=" + subsub[k]['valueID'];
						nfolders('#' + 'sub__' + i, subsub[k][locale('value')], sublink, "sub_" + k, 'noshadows');
					}
				}
			}
		}
	}
}

function issubdubs(subcatdups, compa, k){
	var issubdubs = true;
	for (var d = 0; d < subcatdups.length; d++) {
		if(subcatdups[d] == compa){
			issubdubs = false;
		}
	}
	subcatdups[k] = compa;
	return issubdubs;
}

function refreshLocale(){
	var numbof = $('[locale]');
	for (var i = 0; i <= numbof.length -1; i++) {
		var current_Val = $(numbof[i]).html();
		var key = $(numbof[i]).attr('locale');
		var newVal = current_Val.replace('@', getFromLocale(key));
		$(numbof[i]).html( newVal );
	}
	refreshinlineLocale();
}

function refreshinlineLocale(){
	var numbof = $('[inlineLocale]');
	for (var i = 0; i <= numbof.length -1; i++) {
		var current_Val = $(numbof[i]).html();
		var key = $(numbof[i]).attr('inlineLocale');
		var tarprep = key.split(':');
		var target = tarprep[0];
		var val = getFromLocale(tarprep[1]);
		var newVal = $(numbof[i]).attr(target).replace('@', val);
		$(numbof[i]).attr(target, newVal);
	}
}

function isthere(cont, pram){
	if(cont == pram){
		return true;
	}
	return false;
}

function populateFliterFromUrl(){
	var filtlenght = $('.filterArea input').length;
	var cont = $('.filterArea input');
	for (var i = 0; i <= filtlenght -1; i++) {
		var filtname  = $(cont[i]).prop('name');
		var filtvalue  = $(cont[i]).val();
		var pramvalue = $.query.get(filtname);
		if(pramvalue != ''){
			if( filtvalue != pramvalue ){
				$(cont[i]).parent().dropdown('set selected', pramvalue.toString().split(','));
			}
		}
		$(cont[i]).parent().dropdown({
			'onChange': function(value, text, name){
				goto( 'products' + $.query.set($($(this)[0]).find('input').first().prop('name'), value).toString(), true );
			}
		});
	}
}

var goto = function goto(url, newpage){
	if(newpage){
		window.location.href = url;
	}else{
		window.open(url, '_blank');
	}
};
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
			<div class="content parento">\
				<div class=" getdown">\
				<div class="ui header">'+ItemProp.item[locale('Name')]+'</div>\
				<div class="meta">'+ItemProp.item.code+'</div>\
			</div>\
			<br>\
			\
			<div class=" getdown">\
				<div class="ui tiny buttons detailtable">\
					<a class="ui yellow small button" href="product_details?lang=ar&product_id='+ ItemProp.item.code +'"><p class="goodtimes">'+getFromLocale('details')+'</p></a>\
					<div class="or"></div>\
					<button class="ui blue   small button"><p class="goodtimes">'+getFromLocale('toCart')+'</p></button >\
				</div>\
			</div>\
			</div>\
			</div>\
		</div>\
		\
		');
	modaleinfo();
}

function modaleinfo(){
	$('#products').append('\
			<div id="product_details" class="ui small modal">\
			  <div class="header">Header</div>\
			  <div class="image content">\
			      <img class="image">\
			      <div class="description">\
			      <p></p>\
			    </div>\
			  </div>\
			</div>\
			\
		');
	$('#product_details').modal({transition: 'fade up'});
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
	return '<td class="'+cls+'">'+val+'</td>';
}

function lblSlpadrPad(val){
	return '<div class="ui label" style="float:left;">'+val+'</div>';
}

function trtd(prop){
	var temp = "";

	$.each(prop.Subcategory, function(i, value) {
		if(prop.Subcategory[i]['Name'] != "Subcategory"){
			temp += '<tr>'
			temp += rtlSlpadrPad('rtl Fixedtd slpad rpad', prop.Subcategory[i][locale('Name')]);
			temp += '<td class="slpad">';
			temp += lblSlpadrPad( prop.Subcategory[i][locale('value')]);

			$.each(prop.Subcategory[i]['more'], function(x, value) {
				temp += lblSlpadrPad( prop.Subcategory[i]['more'][x][locale('value')] );
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
	if (window.screen.width > 1200) {
		the3dcard(true);
        subcatmobalt(false);
	}
	if ( window.screen.width < 1000) {
		the3dcard(true);
        productalt(true);
        sideNavalt(true);
		subcatmobalt(false);
    }
    if ( window.screen.width > 1000) {
        productalt(3);
        sideNavalt(true);
    }
    if ( window.screen.width < 565) {
    	$('head [name=viewport]').remove();
    	$('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">');
    	subcatmobalt(true);
    	sideNavalt(false);
    	productalt(false);
		the3dcard(false);
	}

}

function the3dcard(i){
	if(i){
		$('#sideNav').show();
	    $('.card3d').flip({
			trigger: 'hover',
			speed: 300
		});
	    $('.card3d').flip(false);
    }else{
    	$('#sideNav').hide();
        $('.card3d').flip(true);
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
				if( subsub[k]['Name'] == "Subcategory"){
					var sublink = link + "&subcat=" + subsub[k]['categoryID'];
					folders('#' + 'sub__' + i, subsub[k][locale('value')], sublink, "sub_" + k, 'noshadows');
					mfolders('#' + 'sub_m_' + i, subsub[k][locale('value')], sublink, "sub_m" + k, '');
				}
			}
		}
	}

	var heighty = i * 30;
	$('#sidebarmenu').css({'height': heighty + 'px'});
	if(local != 'en'){$('#mysidebarmenu li').css({'font-size':'15px'});}
}

function refreshLocale(){
	var numbof = $('[locale]');
	for (var i = 0; i <= numbof.length -1; i++) {
	   var current_Val = $(numbof[i]).html();
	   var key = $(numbof[i]).attr('locale')
	   var newVal = current_Val.replace('@', getFromLocale(key));
	   $(numbof[i]).html( newVal );
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
				goto( 'products' + $.query.set($($(this)[0]).find('input').first().prop('name'), value).toString() );
			}
		});
	}
}

var goto = function goto(url){
	window.location.href = url;
};
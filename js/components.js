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
					<button class="ui blue  small button"><p class="goodtimes">Details</p></button >\
					<div class="or"></div>\
					<button class="ui yellow small button"><p class="goodtimes">To Cart</p></button >\
				</div>\
			</div>\
			</div>\
			</div>\
		</div>\
		\
		');
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

function rtlSlpadrPad(cls, val){
	return '<td class="'+cls+'">'+val+'</td>';
}

function trtd(prop){
	var temp = "";
	for (var i = 0; i <= prop.Subcategory.length-1; i++) {
		temp += '<tr>'
		+rtlSlpadrPad('rtl Fixedtd slpad rpad ', prop.Subcategory[i][locale('Name')])
		+rtlSlpadrPad('slpad', prop.Subcategory[i][locale('value')])
		+'</tr>';
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
		langalt(false);
	}
	if ( window.screen.width < 1000) {
		the3dcard(true);
        productalt(true);
        sideNavalt(true);
		subcatmobalt(false);
		langalt(false);
    }
    if ( window.screen.width < 565) {
    	$('head [name=viewport]').remove();
    	$('head').prepend('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">');
    	subcatmobalt(true);
    	sideNavalt(false);
    	langalt(true);
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
	if(i){
		$('#product').removeClass('thirteen wide column ');
        $('#product').removeClass('ten');
        $('#product').removeClass('sixteen');
        $('#product').addClass('ten wide column ');
	}else{
		$('#product').removeClass('ten');
    	$('#product').removeClass('ten wide column');
        $('#product').addClass('sixteen wide column ');
	}
}


function sideNavalt(i){
	if(i){
		$('#sideNav').removeClass('three wide column');
		$('#sideNav').addClass('six wide column');
	}else{
		$('#sideNav').removeClass('six wide column');
		$('#sideNav').addClass('three wide column');
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
		folders ('#' + 'sub__' +  i, "All " + data[i][locale('Name')], link, "sub_-1", 'noshadows');
		mfolders('#' + 'sub_m_' + i, "All " + data[i][locale('Name')], link, "sub_m-1", '');

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

	// minisubmenu();
	var heighty = i * 30;
	$('#sidebarmenu').css({'height': heighty + 'px'});
	if(local != 'en'){$('#mysidebarmenu li').css({'font-size':'15px'});}
}

$(document).ready(function(){
	var local  =  $.query.get('lang');
	var cat    =  $.query.get('cat');
	var subcat =  $.query.get('subcat');

	var getcardurl = "../classes/class_getCard.php";
	if(cat != ''){
		getcardurl += $.query.toString();
	}
	getcardurl = getcardurl.replace("lang=ar", "");
	getcardurl = getcardurl.replace("lang=en", "");
	getcardurl = getcardurl.replace("lang=ch", "");
	
	console.log(getcardurl);
	
	$.ajax({
		url: getcardurl
	}).done(function(data) {
		data = jQuery.parseJSON(data);
		for (var i = 0; i <= data.length-1; i++) {
			card( $('#products'), data[i]);
		}
		$('.searchresultcount').text('Showing ' + i + ' results');
		resizeClasses();
	});
	$(window).on('resize', resizeClasses);


	var getpropsurl = "../classes/class_getFilter.php";
	if(cat != ''){
		getpropsurl += '?cat=' + cat;
	}
	if(subcat != ''){
		getpropsurl += '&subcat=' + subcat;
	}
	
	$.ajax({
		url: getpropsurl
	}).done(function(data) {
		data = jQuery.parseJSON(data);
		$('.filterArea').append('<p class="filtr"><i class="ui icon filter"></i> Filters:</p>');
		for (var i = 0; i <= data.length-1; i++) {
			var propname = data[i][0].Property[locale('Name')];
			var propID = 'filt_'+data[i][0].Property.ID;
			var stri = '\
				<div class="ui sub header norm notopmarg">'+propname+'</div>\
					<div class="ui fluid normal dropdown selection multiple norm ">\
						<input type="hidden" name="'+propID+'" value="">\
						<i class="dropdown icon"></i>\
						<div class="default text">Filter by '+propname+'</div>\
						<div class="menu">\
			';

			for (var x = 0; x <= data[i][0].Value.length -1; x++) {
				stri += '<div class="item" data-value="'+data[i][0].Value[x].ID+'">'+data[i][0].Value[x][locale('value')]+'</div>';
			}

			stri += '</div>\
				</div>\
			</div>';
			$('.filterArea').append(stri);


		}
		populateFliterFromUrl();
	});




	$.ajax({
		url: "../classes/class_getCategory.php"
	}).done(function(data) {
		data = jQuery.parseJSON(data);
		 // for (var x = 0; x <= 5; x++) {
			populateSubmenu(data);
		 // }
		amazonmenu.init({menuid: 'mysidebarmenu'});
	});

	$('#lang').dropdown({
		on: 'hover',
		duration: 100,
		action: function(text, value) {
			var newurl = window.location.href;
			var gotothis = newurl.replace(/lang=[^&]+/, 'lang='+ value );
			window.location.href = gotothis;
		}
	});

	$('#lang').dropdown('set selected', $.query.get('lang'));
	$('#Home-nav')      .prop('href', "Home?lang="+ $.query.get('lang'));

	

	$('#mysidebarmenu').hover(function(){
		$('.showmore')     .animate({opacity: '0.0', 'bottom': -60}, 100);
		$('.shadowmore')   .animate({opacity: '0.0'}, 100);
		$('#mysidebarmenu').animate({ height: '400px' }, 100);

	}, function(){
		$('.showmore')     .animate({opacity: '1.0', 'bottom': 0}, 200);
		$('.shadowmore')   .animate({opacity: '1.0'}, 200);
		$('#mysidebarmenu').animate({ height: '150px' }, 100);

	});

});

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
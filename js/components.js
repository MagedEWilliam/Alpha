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
		var local  =  getUrlParameter('lang');
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
	var local = getUrlParameter('lang');
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

	minisubmenu();
	var heighty = i * 30;
	$('#sidebarmenu').css({'height': heighty + 'px'});
	if(local != 'en'){$('#mysidebarmenu li').css({'font-size':'15px'});}
}

$(document).ready(function(){
	var local  =  getUrlParameter('lang');
	var cat    =  getUrlParameter('cat');
	var subcat =  getUrlParameter('subcat');


	var getcardurl = "../classes/class_getCard.php";
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
		for (var i = 0; i <= data.length-1; i++) {
			card( $('#products'), data[i]);
		}
		$('.searchresultcount').text('Showing ' + i + ' results');
		resizeClasses();
	});
	$(window).on('resize', resizeClasses);



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

	$('#lang').dropdown('set selected', getUrlParameter('lang'));
	$('#Home-nav')      .prop('href', "Home?lang="+ getUrlParameter('lang'));

	sideplay();

	$('#sidebarmenu').hover(function(){
		$('.shadowmore').animate({opacity: 'toggle'}, 200);
		$('.showmore').animate({opacity: 'toggle', 'bottom': -60}, 200);
	}, function(){
		$('.shadowmore').animate({opacity: 'toggle'}, 200);
		$('.showmore').animate({opacity: 'toggle', 'bottom': 0}, 200);
	});

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

function sideplay(){
	$('#mysidebarmenu').on({
	    'mouseenter':function(){
	        setTimeout(function(){
				$('#mysidebarmenu').css({'overflow':  'visible'});
		}, 50);
	    },'mouseleave':function(){
	       		$('#mysidebarmenu').css({'overflow':  'hidden'});
	    }
	});

}
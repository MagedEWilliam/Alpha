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

	if(window.location.pathname == "/ALPHA/page/products" || window.location.pathname == "/page/products"){
		$.ajax({
			url: getcardurl
		}).done(function(data) {
			data = jQuery.parseJSON(data);
			for (var i = 0; i <= data.length-1; i++) {
				card( $('#products'), data[i]);
			}
			$('.searchresultcount').text( getFromLocale('showing') + ' ' + i + ' ' + getFromLocale('results') );
			resizeClasses();
			setTimeout(function() {resizeClasses();}, 5);
		});
	}

	if(window.location.pathname == "/ALPHA/page/product_details" || window.location.pathname == "/page/product_details"
	 || window.location.pathname == "/ALPHA/pages/products/produc_details.php"
		){
		if($.query.get('product_id') != ''){

			var themrurl = '';
			if($.query.get('compo') != '' ){
				themrurl = "../../classes/class_getDetails.php?product_id=" + $.query.get('product_id');
			}else{
				themrurl ="../classes/class_getDetails.php?product_id=" + $.query.get('product_id');
			}

			$.ajax({
				url: themrurl
			}).done(function(data) {
				data = jQuery.parseJSON(data);

				$('.bragimg').attr('src', data[0].item['image']);
				$('#product_details').append( trlSlpadrPad('tr_Name' , '') );
				$('#tr_Name').append(rtlSlpadrPad('rtl Fixedtd slpad rpad', 'Item Name')
					+ rtlSlpadrPad('slpad content', '<h4>' + data[0].item[locale('Name')] + '</h4')
					);
				$('#product_details').append( trlSlpadrPad('tr_ID' , '') );
				$('#tr_ID').append(

					rtlSlpadrPad('rtl Fixedtd slpad rpad', 'Item Code')
					+ rtlSlpadrPad('slpad content', '<b>' + data[0].item['code'] + '</b>')
					);

				var i = 0;

				$.each(data[0].Subcategory, function(x, value) {
					$('#product_details').append( trlSlpadrPad('tr_'+x , '') );

					$('#tr_'+x).append( rtlSlpadrPad('rtl Fixedtd slpad rpad', value[locale('Name')]) );
					var sometext = '<td class="slpad">';
					sometext += '<div class="ui label" style="float:left;">' +
						 value[locale('value')] + '</div>';
					$.each(data[0].Subcategory[x].more, function(y, _value) {
						sometext += '<div class="ui label" style="float:left;">' +
						 _value[locale('value')] + '</div>';
					});

					$('#tr_'+x).append(sometext );
					
				});
			});
		}
	}

	$(window).on('resize', resizeClasses);


	var getpropsurl = "../classes/class_getFilter.php";
	if(cat != ''){
		getpropsurl += '?cat=' + cat;
	}
	if(subcat != ''){
		getpropsurl += '&subcat=' + subcat;
	}
	
	if(cat != ''){
		$.ajax({
			url: getpropsurl
		}).done(function(data) {
			data = jQuery.parseJSON(data);
			$('.filterArea').append('<p class="filtr" locale="filters"><i class="ui icon filter"></i> @:</p>');
			for (var i = 0; i <= data.length-1; i++) {
				var propname = data[i][0].Property[locale('Name')];
				var propID = 'filt_'+data[i][0].Property.ID;
				var stri = '\
					<div class="ui sub header norm notopmarg">'+propname+'</div>\
						<div class="ui fluid normal dropdown selection multiple norm ">\
							<input type="hidden" name="'+propID+'" value="">\
							<i class="dropdown icon"></i>\
							<div class="default text">'+ getFromLocale('filterBy') + ' '+propname+'</div>\
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
			refreshLocale();
			populateFliterFromUrl();
		});
	}

	var themrurl = '';
	if($.query.get('compo') != '' ){
		themrurl = '../../classes/class_getCategory.php';
	}else{
		themrurl = '../classes/class_getCategory.php';

		$.ajax({
			url: themrurl
		}).done(function(data) {
			data = jQuery.parseJSON(data);
			 // for (var x = 0; x <= 5; x++) {
				populateSubmenu(data);
			 // }
			amazonmenu.init({menuid: 'mysidebarmenu'});
		});

		$('#lang').dropdown({
			on: 'hover',
			action: function(text, value) {
				var newurl = window.location.href;
				var gotothis = newurl.replace(/lang=[^&]+/, 'lang='+ value );
				window.location.href = gotothis;
			}
		});
	}

	if($.query.get('lang') == 'en'){
		$('#lang').find('.default.text').html('<i class="gb flag"></i>');
	}else if($.query.get('lang') == 'ar'){
		$('#lang').find('.default.text').html('<i class="eg flag"></i>');
	}else if($.query.get('lang') == 'ch'){
		$('#lang').find('.default.text').html('<i class="cn flag"></i>');
	}

	$('#Home-nav')      .prop('href', "Home?lang="+ $.query.get('lang'));
	

	$('#mysidebarmenu').hover(function(){
		$('.showmore')     .animate({opacity: '0.0', 'bottom': -60}, 150);
		$('.shadowmore')   .animate({opacity: '0.0'}, 150);
		$('#mysidebarmenu').animate({ height: '400px' }, 150);

	}, function(){
		$('.showmore')     .animate({opacity: '1.0', 'bottom': 0}, 200);
		$('.shadowmore')   .animate({opacity: '1.0'}, 200);
		$('#mysidebarmenu').animate({ height: '150px' }, 100);

	});

	
	refreshLocale();
});
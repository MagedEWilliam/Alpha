function rowofcartitem(item, i, target){
  var view = '<tr id="__'+item.code+'__">\
  <input type="hidden" value="'+item.code+'" id="'+item.code+'" name="item_code['+i+']">\
  <td class="collapsing">\
  <img src="'+item.image+'" width="100"></td>\
  <td>\
  <h3>'+item[locale('Name')]+'</h3>\
  <p>'+item.code+'</p>\
  </td>\
  <td class="collapsing paddingLefttozero paddingRighttozero">\
  $\
  </td>\
  <td class="collapsing paddingLefttozero">\
  '+Number(item.price)+'\
  <input type="hidden" name="price['+i+']" value='+Number(item.price)+'>\
  </td>\
  <td class="collapsing">\
'

  if(!item.allowstock){
    view +='<div class="ui red basic label" locale="outOfStock">@</div>';
  }

  view +='\
  \
  <div id="'+item.ID+'" ></div>\
  <div class="ui tiny action right input" style="width:180px;margin-bottom:5px;">\
  <input style="width: 100px;" name="qun['+i+']" type="number" value="'+ item.qun +'" min="0">\
  <a class="ui icon button minusOne"><i class="ui icon minus"></i></a>\
  <a class="ui icon button addOne"><i class="ui icon plus"></i></a>\
  </div>\
  \
  <a id="_'+item.code+'_" style="margin-left:10px;" class="ui icon button"><i class="ui icon trash"></i></a>\
  </td>\
  </tr>';
  $(target).append(view);
  
  $('#_'+item.code+'_').on('click', function(){
    $('#__'+item.code+'__').remove();
    cart.remove(item.code);
  });
  
  $('#_'+item.code+'_').hover(function(){
    $('#_'+item.code+'_').addClass    ('red');
  }, function(){
    $('#_'+item.code+'_').removeClass ('red');
  });

  $( $('#__'+item.code+'__ input')[2] ).on('change', function(e){
    qunChanges(item.code, e.currentTarget);
  });

  $('#__'+item.code+'__ .minusOne').on('click', function(){
    var current = $( $('#__'+item.code+'__ input')[2] ).val();
    if(current > 1){
      $( $('#__'+item.code+'__ input')[2] ).val(Number(current)-1);
    }
    qunChanges(item, $('#__'+item.code+'__ input')[2] );
  });

  $('#__'+item.code+'__ .addOne').on('click', function(){
    var current = $( $('#__'+item.code+'__ input')[2] ).val();
    $( $('#__'+item.code+'__ input')[2] ).val(Number(current)+1);
    qunChanges(item, $('#__'+item.code+'__ input')[2] );
  });

}


function qunChanges (targ, source){
  cart.updateQun( targ.code, $(source).val() );
  outofstock(targ.ID, source);
}

function echoCart(whichCart){
  var thecart = cart.get(whichCart);
  if(thecart != null){

    for(var i=0; i<= thecart.length-1 ; i++){
      rowofcartitem(thecart[i], i, '#product_details tbody');
    }
  }
}


function outofstock(ID, source){
  var isutstock = allowToDrawFromStock(ID, $(source).val() );
  if(isutstock){
    $('#' + ID).html('');
  }else{
    $('#' + ID).html('<div class="ui red basic label">'+getFromLocale('outOfStock')+'</div>');
  }
}

function updateSubtotal(){
  var subtotal = 0;

  $('#product_details tr').each(function(key, elm){
    var elem = $(elm).find('input');
    var price = $(elem[1]).val();
    var qun = $(elem[2]).val();
    subtotal += price * qun;

    $('#subtotal').text( '$' + subtotal );
  });

}

$(window).on('click keydown', updateSubtotal);

var iteminfo = {
  get: function(key){
    var lvl;
    if( $.query.get('compo') == '1' ){
      lvl = '../../';
    }else{
      lvl = '../';
    }
    theurl = lvl + 'classes/class_getCard.php?exactID=';
    return $.ajax({ url: theurl + key });
  },
  set: function(){},
  getAll: function(){},
  setAll: function(){}
};
var cart = {

  count:  function count (){
    if(localStorage.length > 0){
      var cart = localStorage.getItem('cart');
      var fomatted = JSON.parse(cart);
      return fomatted.length;
    }else{
      return 0;
    }
  },

  isset:  function isset (key){
    var getting = this.get('cart');
    var theval = true;
    if(getting != null){
      $.each( getting, function(_key, _value){ if(_value.code == key){ theval =  false; } });
    }
    return theval;
  },

  add:    function add   (item, mode){
    $.when( iteminfo.get(item) )
    .then(function( data ) {

      var data = JSON.parse(data);
      if( $('[name=username]').val() != 'guest' ){
        uptRemoteCart( $('[name=username]').val(), data[0].item.code, data[0].item.qun, data[0].item.price );
      }
      
      var isadded = cart.set('cart', data[0].item);

      if(isadded){
        if(mode == 'fromProduct'){
          $('.carticon .detail .cnt').text(cart.count());
          $('#cart_' + data[0].item.code + ' p').text( getFromLocale('added') + ' ✓' );

          $('#Qun_' + data[0].item.code ).hide();

          $('#cart_' + data[0].item.code).removeClass('blue');
          $('#cart_' + data[0].item.code).addClass('disabled');

          setTimeout(function (){ $('.carticon').removeClass('green'); } ,300);
        }
      }
    });
  },

  set:    function set   (key, item){
    var coutting = cart.count();
    if(coutting == 0){
      localStorage.setItem('cart', '[]');
    }
    
    if ( cart.isset(item.code) ){
      var getting = cart.get('cart');
      
      var initqun = $('#Qun_' + item.code + ' input').val();
      if(initqun < 1){
        item.qun = 1;
        $('#Qun_' + item.code + ' input').val(1);
      }else{
        item.qun = initqun;
      }

      item.allowstock = allowToDrawFromStock(item.ID, item.qun);

      getting.push( item );

      var gettingformatted = JSON.stringify(getting);
      localStorage.setItem(key, gettingformatted);

      return true;
    }else{
      return false;
    }
  },

  get:    function get   (item){
    var cart = localStorage.getItem(item);
    var fomatted = JSON.parse(cart);
    return fomatted;
  },

  getbycode:    function getbycode   (item, code){
    var _cart = localStorage.getItem(item);
    var fomatted = JSON.parse(_cart);
    var ret = null;
    $.each( fomatted, function(_key, _value){
      if(_value.code == code){
       ret = _value;
     }
   });
    return ret;
  },

  remove: function remove(key){
    var getting = this.get('cart');

    $.each( getting, function(_key, _value){
      try{ if(_value.code == key){ getting.splice(_key, 1); } }catch(e){}
      var gettingformatted = JSON.stringify( getting );
      localStorage.setItem('cart', gettingformatted );
    });
    $('.carticon .detail .cnt').text( cart.count() );
  },

  updateQun:   function updateQun(key, qun){
    var getting = this.get('cart');
    $.each( getting, function(_key, _value){
      if(_value.code == key){
        _value.qun = qun;
        var gettingformatted = JSON.stringify(getting);
        localStorage.setItem('cart', gettingformatted);
      }
    });
  },

  clear: function clear (){
    localStorage.clear();
  }

};

function uptRemoteCart(username, itemCode, itemQun, itemPrice){
  return $.ajax({
        type: "POST",
        url: "class_cart.php",
        data: "username=" + username + "&itemCode=" + itemCode + "&itemQun=" + itemQun + "&itemPrice=" + itemPrice,
        dataType: 'JSON',
    });
}

function tothecart(item, e){
  $('.carticon').addClass('green');
  cart.add(item, 'fromProduct');
}
if($.query.get('success') == "true" && $.query.get('paymentId') !='' && $.query.get('token') !='' && $.query.get('PayerID') !=''){
  cart.clear();
}

function allowToDrawFromStock(itemID, qun){
  var prams = "method=getQun&id=" + itemID + "&qun=" + qun;
  var isallowed = false;
  var lvl;
  if( $.query.get('compo') == '1' ){
    lvl = '../../';
  }else{
    lvl = '../';
  }

  $.ajax({
    dataType: "json",
    url: lvl + "classes/class_stock.php?"+ prams,
    async: false,
    success: function(data) {
      if(data.allowstock == 1){
        isallowed = true;
      }else{
        isallowed = false;
      }
    }
  });
  return isallowed;
}
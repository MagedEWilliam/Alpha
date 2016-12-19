function rowofcartitem(item, i, target){
  $(target).append('<tr id="__'+item.code+'__">\
  <input type="hidden" value="'+item.code+'" id="'+item.code+'" name="item_code['+i+']">\
  <td class="collapsing">\
    <img src="'+item.image+'" width="100"></td>\
  <td>\
    <h3>'+item[locale('Name')]+'</h3>\
    <p>'+item.code+'</p>\
  </td>\
  <td class="collapsing">\
    \
    <div class="ui tiny action right input" style="width:180px;margin-bottom:5px;">\
      <input style="width: 100px;" name="qun['+i+']" type="number" value="'+ item.qun +'" min="0">\
      <a class="ui icon button minusOne"><i class="ui icon minus"></i></a>\
      <a class="ui icon button addOne"><i class="ui icon plus"></i></a>\
    </div>\
    \
    <a id="_'+item.code+'_" style="margin-left:10px;" class="ui icon button"><i class="ui icon trash"></i></a>\
  </td>\
</tr>');
  
  $('#_'+item.code+'_').on('click', function(){
    $('#__'+item.code+'__').remove();
    cart.remove(item.code);
  });
  
  $('#_'+item.code+'_').hover(function(){
    $('#_'+item.code+'_').addClass    ('red');
  }, function(){
    $('#_'+item.code+'_').removeClass ('red');
  });

  $( $('#__'+item.code+'__ input')[1] ).on('change', function(e){
    qunChanges(item.code, e.currentTarget);
  });

  $('#__'+item.code+'__ .minusOne').on('click', function(){
    var current = $( $('#__'+item.code+'__ input')[1] ).val();
    if(current > 1){
      $( $('#__'+item.code+'__ input')[1] ).val(Number(current)-1);
      qunChanges(item.code, $('#__'+item.code+'__ input')[1] );
    }
  });

  $('#__'+item.code+'__ .addOne').on('click', function(){
    var current = $( $('#__'+item.code+'__ input')[1] ).val();
    $( $('#__'+item.code+'__ input')[1] ).val(Number(current)+1);
    qunChanges(item.code, $('#__'+item.code+'__ input')[1] );
  });

}
function qunChanges (targ, source){
  cart.updateQun( targ, $(source).val() );
}
function echoCart(){
  var thecart = cart.get('cart');
  for(var i=0; i<= thecart.length-1 ; i++){
    rowofcartitem(thecart[i], i, '#product_details tbody');
  }
}

var iteminfo = {
  get: function(key){
    theurl = '../classes/class_getCard.php?exactID=';
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
      var isadded = cart.set('cart', data[0].item);

      if(isadded){
        if(mode == 'fromProduct'){
          $('.carticon .detail').text(cart.count());
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

  remove: function remove(key){
    var getting = this.get('cart');

    $.each( getting, function(_key, _value){
      try{ if(_value.code == key){ getting.splice(_key, 1); } }catch(e){}
      var gettingformatted = JSON.stringify( getting );
      localStorage.setItem('cart', gettingformatted );
    });
    $('.carticon .detail').text( cart.count() );
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

function tothecart(item, e){
  $('.carticon').addClass('green');
  cart.add(item, 'fromProduct');
}

if($.query.get('success') == "true" && $.query.get('paymentId') !='' && $.query.get('token') !='' && $.query.get('PayerID') !=''){
  cart.clear();
}
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
      $.each( getting, function(_key, _value){
        if(_value.code == key){
          theval =  false;
        }
      });
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
  },

  clear: function clear (){
    localStorage.clear();
  }

};

function tothecart(item, e){
  $('.carticon').addClass('green');
  cart.add(item, 'fromProduct');
}


function rowofcartitem(item, i){
  return'<tr id="__'+item.code+'__">\
          <input type="hidden" id="'+item.code+'">\
          <td class="collapsing">\
            <img src="'+item.image+'" width="100"></td>\
          <td>\
            <h3>'+item[locale('Name')]+'</h3>\
            <p>'+item.code+'</p>\
          </td>\
          <td class="collapsing">\
            <a class="ui icon button"><i class="ui icon minus"></i></a>\
            <a class="ui icon button"><i class="ui icon plus"></i></a>\
            <input style="width: 100px;" name="qun['+i+']" type="number" value="1" min="0">\
          </td>\
          <td class="collapsing"><a id="_'+item.code+'_" class="ui icon button"><i class="ui icon trash"></i></a></td>\
        </tr>';
}

function echoCart(){
  var thecart = cart.get('cart');
  for(var i=0; i<= thecart.length-1 ; i++){
    $('#product_details tbody').append( rowofcartitem(thecart[i], i) );
  }
}
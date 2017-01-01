<?php
if( isset($_GET['compo']) ){
  $level = '';
  for ($i=0; $i < $_GET['__level'] ; $i++) { 
    $level .= '../';
  }
  require_once($level.'classes/class_database.php');
  echo '<!DOCTYPE html>
  <html style="height: 100%;">
  <head>';
    include('../links.php');
    echo '</head>
    <body style="height:100%;">
     <div class="ui " style="height: 100%;" >
       <div class="ui internally stackable nomarg celled grid ui segment"
       style="height:100%;">';

       include_once($level.'classes/class_getLocale.php');
     }
     ?>
     <script type="text/javascript">
      $('#product_detail').remove();
    </script>
    
    <form class="row" method="POST" action="<?php 
    if($_SERVER['SERVER_NAME'] == 'localhost'){
      echo "http://localhost/ALPHA/checkout.php?lang=" . $_GET['lang'];
    }else{
      echo "http://i-alfa.info/checkout.php?lang=" . $_GET['lang'];
    }
    ?>">
    <div class="eleven wide column">

      <h4 class="goodtimes " locale="itemsDetails">@</h4>
      <table class="ui very compact striped  table" id="product_details">
        <tbody>
          <script>echoCart();</script>
        </tbody>
      </table>

      <br>

    </div>
    <div class="five wide column" style="position: relative;">

      <div class="ui segment">


        <h4 class="floatleft notopmargin" locale="total">@:</h4>
        <h4 class="floatright notopmargin" id="subtotal">$0</h4>

        <br>
        <center>
          <button type="submit" class="ui massive button blue" id="checkdisout" locale="checkoutwithpaypal">
            <i class="ui icon paypal"></i>
            @
          </button>

        </center>
      </div>

      <!-- <div class="ui divider"></div> -->
      <div class="ui top attached tabular menu">

        <a class="item" data-tab="first">Login</a>
        <a class="item" data-tab="second">Sign up</a>
        <a class="item active" data-tab="third">Track order</a>
        
      </div>

      <div class="ui bottom attached tab segment" data-tab="first">
        <iframe style="width: 100%;" height="350" frameborder="0" src="../pages/parts/login_part.php"></iframe>
      </div>

      <div class="ui bottom attached tab segment" data-tab="second">
        <iframe style="width: 100%;" height="850" frameborder="0" src="../pages/parts/signup_part.php"></iframe>
      </div>

      <div class="ui bottom attached tab segment active" data-tab="third">
        <iframe style="width: 100%;" height="350" frameborder="0" src="../pages/parts/trackorder_part.php"></iframe>
      </div>

    </div>

  </form>
  <script type="text/javascript">
    if( cart.get('cart') == null ) {
      $('form').attr('action', '');
      $('#checkdisout').remove();
      $('[locale=itemsDetails]').remove();
      $('h4').parent().remove();
      $('.divider').remove();
      $('table').remove();
    }
    $('.menu .item').tab();
  </script> 

  <?php
  if( isset($_GET['compo']) ){
    echo '\
  </div>\
</div>\
</body>\
</html>';
}
?>
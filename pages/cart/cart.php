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
      var Glocale = <?php print_r(geLocale()) ?>;
    </script>
    <form class="row" method="POST" action="http://localhost/ALPHA/checkout.php?lang=<?php echo $_GET['lang']?>">
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
        <!-- <h4 class="goodtimes" locale="total">@</h4> -->
        <center>
          <button type="submit" class="ui massive button blue">
            <i class="ui icon paypal"></i>
            Checkout with Paypal
          </button>
        </center>

        <div class="ui divider"></div>

        <div class="ui top attached tabular menu">
          <a onclick="$('iframe').height(200);" class="item active" data-tab="first">Login</a>
          <a onclick="$('iframe').height(500);" class="item" data-tab="second">Sign up</a>
        </div>
        <div class="ui bottom attached tab segment active" data-tab="first">
          <iframe style="width: 100%;" height="200" frameborder="0" src="../pages/parts/login_part.php"></iframe>
        </div>

        <div class="ui bottom attached tab segment" data-tab="second">
          <iframe style="width: 100%;" height="500" frameborder="0" src="../pages/parts/signup_part.php"></iframe>
        </div>

        <script type="text/javascript">
          $('.menu .item').tab();
        </script>
      </div>

    </form>

    <?php
    if( isset($_GET['compo']) ){
      echo '\
    </div>\
  </div>\
</body>\
</html>';
}
?>
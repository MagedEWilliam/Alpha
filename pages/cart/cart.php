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
        <br>
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
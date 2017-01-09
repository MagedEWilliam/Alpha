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
     <div class="row">
       <div class="column" style="padding-left: 0px;padding-right: 0px;width: 100%;">

       <?php
      if( isset($_SESSION['username']) ) {
      echo'
        <div class="ui pointing secondary blue menu">
          <div>
          <a class="item ';

           if(isset($_GET['active']) && $_GET['active'] == 'cart' ){echo 'active';}

           echo' floatleft" data-tab="_first">Cart</a>
            <a class="item ';

             if(isset($_GET['active']) && $_GET['active'] == 'orders' ){echo 'active';}

            echo ' floatleft" data-tab="_second">Orders</a>
          </div>
        </div>';
      }
      ?>
        <div class="ui tab <?php if(isset($_GET['active']) && $_GET['active'] == 'cart' ){echo 'active';}?> stackable grid" data-tab="_first">
         <?php include_once "thecart.php"; ?>
       </div>

       <div class="ui tab <?php if(isset($_GET['active']) && $_GET['active'] == 'orders' ){echo 'active';}?> stackable grid" data-tab="_second">
        <p>_second</p>
      </div>

    </div>
  </div>

  <script>
    $('.secondary.menu .item').tab();
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
     <script type="text/javascript">
      $('#product_detail').remove();
    </script>

    <form class="row" method="POST" action="<?php if($_SERVER['SERVER_NAME'] == 'localhost'){echo "http://localhost/ALPHA/checkout.php?lang=" . $_GET['lang'];}else{echo "http://i-alfa.info/checkout.php?lang=" . $_GET['lang'];}?>">
      <div class="eleven wide column">

        <h4 class="goodtimes" locale="itemsDetails">@</h4>
        <table class="ui very compact stackable striped table" id="product_details">
          <tbody>
            <script>echoCart();</script>
          </tbody>
        </table>

        <br>

      </div>
      <div class="five wide column" style="position: relative;">

        <div class="ui reised segment">


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
        
          <?php 

          if (! isset($_SESSION['username']) ) {
            echo '<div class="ui top attached tabular menu">
            <a class="item" data-tab="first">Login</a><a class="item" data-tab="second">Sign up</a>
            <a class="item active" data-tab="third">Track order</a></div>';
          }else{
            echo '<div class="ui center aligned segment"><a class="ui button" href="../login/logout.php"><i class="ui icon sign out"></i>Logout</a></div>';
          }

        if (! isset($_SESSION['username']) ) {
          echo '<div class="ui bottom attached tab segment mrlogin" data-tab="first"></div>
          <div class="ui bottom attached tab segment mrsign" data-tab="second"></div>
          <div class="ui bottom attached tab segment active mrcheck" data-tab="third"></div></div>';
        }
        ?>
      </div>
    </form>
    <script type="text/javascript">
      $('.menu .item').tab();
      if( cart.get('cart') == null ) {
        $('form').attr('action', '');
        $('#checkdisout').remove();
        $('[locale=itemsDetails]').remove();
        $('h4').parent().remove();
        $('.divider').remove();
        $('table').remove();
      }

      $('div.tab.segment.mrsign').append('<form class="ui form mrsign" method="post" action="../login/createuser.php">\
        <input type="hidden" name="was" value="'+ window.location.href +'" >\
        <div class="field">\
          <label>Username:</label>\
          <input name="newuser" id="newuser" type="text" class="form-control" placeholder="Username" />\
        </div>\
        <div class="field">\
          <label>Email:</label>\
          <input name="email" id="email" type="text" class="form-control" placeholder="Email" />\
        </div>\
        <div class="ui divider"></div>\
        <div class="field">\
          <label>Password:</label>\
          <input name="password1" id="password1" type="password" class="form-control" placeholder="Password" />\
        </div>\
        <div class="field">\
          <label>Repeat Password:</label>\
          <input name="password2" id="password2" type="password" class="form-control" placeholder="Repeat Password" />\
        </div>\
        <div class="ui divider"></div>\
        <div class="field">\
          <label>Phone:</label>\
          <input name="phone" id="phone" type="text" class="form-control" placeholder="Phone" />\
        </div>\
        <div class="field">\
          <label>Address:</label>\
          <textarea name="address" id="address" class="form-control" placeholder="Address"></textarea>\
        </div>\
        <div id="message" style="margin-bottom: 10px;"></div>\
        <a name="Submit" id="submit" class="ui submit button">Sign up</a>\
      </form>');

      $(".mrsign .submit").click(function(){

        var username = $("#newuser").val();
        var password = $("#password1").val();
        var password2 = $("#password2").val();
        var email = $("#email").val();
        var address = $("#address").val();
        var phone = $("#phone").val();

        if((username == "") || (password == "") || (email == "") || (phone == "") || (address == "") ) {

          $(".mrsign #message").html("\
            <div class=\"ui icon error visible message\">\
                  <i class=\"privacy icon \"></i>\
                  <i class=\"ui icon close\"></i>\
                  <div class=\"content\">\
                    <div class=\"header\">  \
                    </div>\
                    <p>Please enter a username and a password</p>\
                </div>\
            </div>");
        }
        else {
          $.ajax({
            type: "POST",
            url: "../login/createuser.php?lang=" + $.query.get('lang'),
            data: "newuser="+username+"&password1="+password+"&password2="+password2+"&email="+email+"&phone="+phone+"&address="+address,
            success: function(html){

              var text = $(html).text();

              var response = text.substr(text.length - 4);

              if(response == "true"){

                $(".mrsign #message").html(html);
                $('.mrsign .submit').hide();
              }
              else {
                $(".mrsign #message").html(html);
                $('.mrsign .submit').show();
              }
            },
            beforeSend: function()
            {
              $(".mrsign #message").html('<div class="ui icon message">\
              <i class="notched circle loading icon"></i>\
              <div class="content">\
                <div class="header">\
                  Just one second\
                </div>\
                <p>We\'re fetching that content for you.</p>\
              </div>\
            </div>');
            }
          });
        }
        return false;
      });

      $('div.tab.segment.mrlogin').append('<form class="ui form mrLogin" method="post" action="../login/checklogin.php?lang=' + $.query.get('lang') + '">\
        <input type="hidden" name="was" value="'+ window.location.href +'" >\
        <div class="field">\
          <label>Username:</label>\
          <input type="text" name="myusername" id="myusername" placeholder="Username">\
        </div>\
        \
        <div class="field">\
          <label>Password:</label>\
          <input type="password" name="mypassword" id="mypassword" placeholder="Password">\
        </div>\
        <div id="message" style="margin-bottom: 10px;"></div>\
        <a class="ui submit button">\
          <i class="ui icon shipping"></i>\
          Login\
        </a>\
      </form>');

      $(".mrLogin .submit").click(function () {

        var username = $("#myusername").val(), password = $("#mypassword").val();

        if ((username === "") || (password === "")) {
          $(".mrLogin #message").html("\
            <div class=\"ui icon error visible message\">\
                  <i class=\"privacy icon \"></i>\
                  <i class=\"ui icon close\"></i>\
                  <div class=\"content\">\
                    <div class=\"header\">  \
                    </div>\
                    <p>Please enter a username and a password</p>\
                </div>\
            </div>");
        } else {
          $.ajax({
            type: "POST",
            url: "../login/checklogin.php?lang=" + $.query.get('lang'),
            data: "myusername=" + username + "&mypassword=" + password ,
            dataType: 'JSON',
            success: function (html) {
              if (html.response === 'true') {
               location.reload();
               return html.username;
             } else {
              $(".mrLogin #message").html(html.response);
            }
          },
          error: function (textStatus, errorThrown) {
            // console.log(textStatus);
            // console.log(errorThrown);
          },
          beforeSend: function () {
            $(".mrLogin #message").html('<div class="ui icon message">\
              <i class="notched circle loading icon"></i>\
              <div class="content">\
                <div class="header">\
                  Just one second\
                </div>\
                <p>We\'re fetching that content for you.</p>\
              </div>\
            </div>');
          }
        });
      }
      return false;
    });

    $('div.tab.segment.mrcheck').append('\
    <form method="post" action="#" class="ui form trackorder">\
      <input type="hidden" name="was" value="'+ window.location.href +'" >\
      <div class="field">\
        <label>Email:</label>\
        <input type="text" name="uname" value="">\
      </div>\
      \
      <div class="field">\
        <label>Order Number:</label>\
        <input type="password" name="orderName">\
      </div>\
      \
      <div id="message" style="margin-bottom: 10px;"></div>\
      \
      <a class="ui submit button" onclick="$(\'.trackorder\').submit()">\
        <i class="ui icon shipping"></i>\
        Track\
      </a>\
    </form>\
    ');
  </script> 
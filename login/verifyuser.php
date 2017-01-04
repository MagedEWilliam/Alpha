<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Verify User</title>
    <?php $_GET['__level']= 1; include'../pages/links.php';?>
  </head>
  <body>
<?php
require 'includes/functions.php';
include 'config.php';

//Pulls variables from url. Can pass 1 (verified) or 0 (unverified/blocked) into url
$uid = $_GET['uid'];
$verify = $_GET['v'];

$e = new SelectEmail;
$eresult = $e->emailPull($uid);

$email = $eresult['email'];
$username = $eresult['username'];

$v = new Verify;

if (isset($uid) && !empty(str_replace(' ', '', $uid)) && isset($verify) && !empty(str_replace(' ', '', $verify))) {

    //Updates the verify column on user
    $vresponse = $v->verifyUser($uid, $verify);

    //Success
    if ($vresponse == 'true') {
        echo '<div class="ui icon success visible message">
                  <i class="checkmark icon "></i>
                  <div class="content">
                    <div class="header">  
                    </div>
                    <p>'. $activemsg .'</p>
                </div>
            </div>
            <div id="returnVal" style="display:none;">true</div>';
        // echo $activemsg;

        //Send verification email
        $m = new MailSender;
        $m->sendMail($email, $username, $uid, 'Active');
    } else {
        //Echoes error from MySQL
        echo $vresponse;
    }
} else {
    //Validation error from empty form variables
    echo 'An error occurred... click <a href="' . $_SERVER['HTTP_REFERER'] .'">here</a> to go back.';
};

?>
</body>
</html>

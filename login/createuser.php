<?php
require 'includes/functions.php';
include_once 'config.php';

//Pull username, generate new ID and hash password
$newid = uniqid(rand(), false);
$newuser = $_POST['newuser'];
$newpw = password_hash($_POST['password1'], PASSWORD_DEFAULT);
$pw1 = $_POST['password1'];
$pw2 = $_POST['password2'];
$phone = $_POST['phone'];
$addr = $_POST['address'];

    //Enables moderator verification (overrides user self-verification emails)
if (isset($admin_email)) {

    $newemail = $admin_email;

} else {

    $newemail = $_POST['email'];

}

//Validation rules
if ($pw1 != $pw2) {

    echo '
    <div class="ui icon error visible message">
                  <i class="privacy icon "></i>
                  <i class="ui icon close"></i>
                  <div class="content">
                    <div class="header">  
                    </div>
                    <p>Password fields must match</p>
                </div>
            </div>
    <div id="returnVal" style="display:none;">false</div>
    ';

} elseif (strlen($pw1) < 4) {

    echo '
    <div class="ui icon error visible message">
                  <i class="privacy icon "></i>
                  <i class="ui icon close"></i>
                  <div class="content">
                    <div class="header">  
                    </div>
                    <p>Password must be at least 4 characters</p>
                </div>
            </div>
    <div id="returnVal" style="display:none;">false</div>
    ';

} elseif (!filter_var($newemail, FILTER_VALIDATE_EMAIL) == true) {

    echo '
        <div class="ui icon error visible message">
                  <i class="privacy icon "></i>
                  <i class="ui icon close"></i>
                  <div class="content">
                    <div class="header">  
                    </div>
                    <p>Must provide a valid email address</p>
                </div>
            </div>
    <div id="returnVal" style="display:none;">false</div>
    ';

} else {
    //Validation passed
    if (isset($_POST['newuser']) && !empty(str_replace(' ', '', $_POST['newuser'])) && isset($_POST['password1']) && !empty(str_replace(' ', '', $_POST['password1']))) {

        //Tries inserting into database and add response to variable

        $a = new NewUserForm;

        $response = $a->createUser($newuser, $newid, $newemail, $newpw, $phone, $addr);

        //Success
        if ($response == 'true') {

            echo '
                <div class="ui icon success visible message">
                  <i class="checkmark icon "></i>
                  <i class="ui icon close"></i>
                  <div class="content">
                    <div class="header">  
                    </div>
                    <p>'. $signupthanks .'</p>
                </div>
            </div>
            <div id="returnVal" style="display:none;">true</div>
            ';

            //Send verification email
            $m = new MailSender;
            $m->sendMail($newemail, $newuser, $newid, 'Verify');

        } else {
            //Failure
            mySqlErrors($response);

        }
    } else {
        //Validation error from empty form variables
        echo '
        <div class="ui icon error visible message">
                  <i class="bug icon "></i>
                  <i class="ui icon close"></i>
                  <div class="content">
                    <div class="header">  
                    An error occurred on the form
                    </div>
                    <p>try again</p>
                </div>
            </div>
            <div id="returnVal" style="display:none;">true</div>
            ';
    }
};

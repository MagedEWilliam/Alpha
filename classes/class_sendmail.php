<?php
class MailSender
{
    public function sendMail($email, $subject, $body)
    {
        $initmail = self::initMail();

        require_once('login/scripts/PHPMailer/PHPMailerAutoload.php');
        $mail = new PHPMailer;
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";
        $mail->WordWrap = 60;
        $mail->setFrom($initmail["from_email"], $initmail["from_name"]);
        $mail->AddReplyTo($initmail["from_email"], $initmail["from_name"]);

        $mail->addAddress($email, $email);

        $mail->Subject = $subject;
        // $mail->Body = $body;
//7.34
        // $mail->AltBody =  $body;
        $mail->MsgHTML($body);

        if ($initmail["mailServerType"] == 'smtp') {

            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = $initmail["smtp_server"];

            $mail->SMTPSecure = $initmail["smtp_security"];
            $mail->Port = $initmail["smtp_port"];

            $mail->Username = $initmail["smtp_user"];
            $mail->Password = $initmail["smtp_pw"];
            
            $mail->SMTPDebug = 0;

        }

        try {

            $mail->Send();

        } catch (phpmailerException $e) {

            echo $e->errorMessage();

        } catch (Exception $e) {

            echo $e->getMessage();

        }
    }
    public function initMail(){

        if($_SERVER['SERVER_NAME'] == 'localhost'){
            $host = "localhost";
            $username = "root";
            $password = "";
            $db_name = "oauthing";
        }else{
            $host = "alphalightingtech.com";
            $username = "ialphalightingte";
            $password = "Alfa@1234";
            $db_name = "authing";
        }

        $tbl_prefix = "";
        $tbl_members = $tbl_prefix."members";
        $tbl_attempts = $tbl_prefix."loginAttempts";

        $base_url = 'http://' . $_SERVER['SERVER_NAME'];
        $signin_url = substr($base_url . $_SERVER['PHP_SELF'],0,-(6 + strlen(basename($_SERVER['PHP_SELF']))));

        $ip_address = $_SERVER['REMOTE_ADDR'];

        if($_SERVER['SERVER_NAME'] == 'localhost'){
            $site_name = 'ALPHA';
        }else{
            $site_name = 'alphalightingtech';
        }

        $max_attempts = 200;

        $login_timeout = 300;

        $admin_email = '';

        $from_email = 'developer@alphalightingtech.com';
        $from_name = 'Alpha Developer';

        $mailServerType = 'smtp';

        $smtp_server = 'n3plcpnl0073.prod.ams3.secureserver.net';
        $smtp_user = 'developer@alphalightingtech.com';
        $smtp_pw = '^dev!migo1029384756/';
        $smtp_port = 465;
        $smtp_security = 'ssl';

        $verifymsg = 'Click this link to verify your new account!';
        $active_email = 'Your new account is now active! Click this link to log in!';

        $signupthanks = 'Thank you for signing up! You will receive an email shortly confirming the verification of your account.';
        $activemsg = 'Your account has been verified! You may now login at <br><a href="'.$signin_url.'">'.$signin_url.'</a>';

        if (trim($admin_email, ' ') == '') {
            unset($admin_email);
        } elseif (!filter_var($admin_email, FILTER_VALIDATE_EMAIL) == true) {
            unset($admin_email);
            echo $invalid_mod;
        };
        $invalid_mod = '$adminemail is not a valid email address';

        $timeout_minutes = round(($login_timeout / 60), 1);

        return array(
            "from_email"   =>$from_email,
            "from_name"    =>$from_name,
            "verifymsg"    =>$verifymsg,
            "smtp_server"  =>$smtp_server,
            "smtp_security"=>$smtp_security,
            "smtp_port"    =>$smtp_port,
            "smtp_user"    =>$smtp_user,
            "mailServerType"    =>$mailServerType,
            "smtp_pw"      =>$smtp_pw
            );
    }
}

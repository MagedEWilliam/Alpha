<?php
class MailSender
{
	public function sendMail($email, $subject, $body)
	{
		require 'login/scripts/PHPMailer/PHPMailerAutoload.php';
		include 'login/config.php';

		$finishedtext = $active_email;

		$mail = new PHPMailer;
		$mail->isHTML(true);
		$mail->CharSet = "Content-Type: text/html; charset=UTF-8;";
		$mail->WordWrap = 60;
		$mail->setFrom($from_email, $from_name);
		$mail->AddReplyTo($from_email, $from_name);

		$mail->addAddress($email, $email);

		$mail->Subject = $subject;
		$mail->Body = $body;

        $mail->AltBody  =  $verifymsg;

        if ($mailServerType == 'smtp') {

            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = $smtp_server;

            $mail->SMTPSecure = $smtp_security;
            $mail->Port = $smtp_port;

            $mail->Username = $smtp_user;
            $mail->Password = $smtp_pw;
            
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
}

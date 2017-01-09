<?php

if(!isset($payment)){
	$email = '';
	$phone = '';
	$line1 = '';
	$city  = '';
	$state = '';
}else{
	$email = $payment->payer->payer_info->email;
	$phone = $payment->payer->payer_info->phone;
	$line1 = $payment->payer->payer_info->shipping_address->line1;
	$city  = $payment->payer->payer_info->shipping_address->city;
	$state = $payment->payer->payer_info->shipping_address->state;
}

?>
<style>
	html, body{
		min-width: 200px !important;
	}
</style>
<form method="POST" action="../classes/class_order.php?<?php echo 'lang='.$_GET['lang'].'&success='.$_GET['success'].'&paymentId='.$_GET['paymentId'].'&token='.$_GET['token'].'&PayerID='.$_GET['PayerID'] ?>" class="ui form signup">
<h1 style="margin-bottom: 0px;">Order:</h1>
<h1 style="margin-top: 5px;"><?php  echo $payment->id; ?></h1>
<input type="hidden" name="transactionID" value="<?php echo $payment->id; ?>">
	<h4>Tell us about yourself:</h4>
	<p>Please fill this form in order to provide us with the order destination.</p>
	<div class="required field">
		<label>Full name</label>
		<input type="text" name="fullname" placeholder=" What's your full name?" value="" autofocus>
	</div>

	<div class="required field">
		<label>Email</label>
		<input type="email" name="email" placeholder=" Same as your PayPal Email" value="<?php echo $email; ?>">
	</div>


	<div class="required field">
		<label>Phone</label>
		<input type="tel" name="phone" placeholder=" Make sure it's direct to you" value="<?php echo $phone; ?>">
	</div>

	<div class="required field">
		<label>Shipping address</label>
		<textarea name="address" rows="4" placeholder=" Enter the shipping destination"><?php  if($line1 != ''){echo $line1 . ", " . $city . ", " . $state;} ?></textarea>
	</div>

	<?php
if(!isset($_SESSION['username']) ){
echo'
<div class="ui divider"></div>
	<div class="two fields">
		<div class="thirteen wide field">
			<label>Password</label>
			<input type="password" name="password" placeholder=" Type password, be a returning customer?" >
		</div>
		<div class="three wide field">
			<div class="ui checkbox">
			<label style="font-size:12px;top: 22px;">Show</label>
				<input type="checkbox" name="example" onchange="if($(this).prop(\'checked\')){$(\'[name=password]\').prop(\'type\', \'text\');}else{$(\'[name=password]\').prop(\'type\', \'password\');}">
			</div>
		</div>
	</div>
	';
}
?>

	<div class="ui error message"></div>
	<a class="ui submit big green button">
		<i class="ui icon payment alternate"></i>
		Place Order
	</a>
<br>
<br>
	<script>
	$('.checkbox').checkbox();

	$('.ui.form.signup').form({
		message   : '.ui.error.message',
		fields: {
			fullname : ['minLength[1]', 'empty'],
			email    : 'email',
			password : ['minLength[4]', 'empty'],
			phone    : ['minLength[8]', 'empty'],
			address  : ['minLength[8]', 'empty'],
		}
	});
    </script>

</form>

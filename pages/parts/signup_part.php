<?php include('links.html'); 

if(!isset($payment)){
	$email = '';
	$phone = '';
	$line1 = '';
	$city = '';
	$state = '';
}else{
	$email = $payment->payer->payer_info->email;
	$phone = $payment->payer->payer_info->phone;
	$line1 = $payment->payer->payer_info->shipping_address->line1;
	$city = $payment->payer->payer_info->shipping_address->city;
	$state = $payment->payer->payer_info->shipping_address->state;
}

?>
<style>
	html, body{
		min-width: 200px !important;
	}
</style>
<form method="POST" action="#" class="ui form signup">
	<h4>Tell us about yourself:</h4>
	<p>Please fill this form in order to provide us with the order destination.</p>
	<div class="required field">
		<label>Email</label>
		<input type="email" name="email" placeholder=" Same as your PayPal Email" value="<?php echo $email; ?>">
	</div>

	<div class="two fields">
		<div class="fourteen wide field">
			<label>Password</label>
			<input type="password" name="password" placeholder=" Type password, be a returning customer?" autofocus>
		</div>
		<div class="two wide field">
			<div class="ui checkbox">
			<label>Show Password</label>
				<input type="checkbox" name="example" onchange="if($(this).prop('checked')){$('[name=password]').prop('type', 'text');}else{$('[name=password]').prop('type', 'password');}">
			</div>
		</div>
	</div>

	<div class="required field">
		<label>Phone</label>
		<input type="tel" name="phone" placeholder=" Make sure it's direct to you" value="<?php echo $phone; ?>">
	</div>

	<div class="required field">
		<label>Shipping address</label>
		<textarea name="address" placeholder=" Enter the shipping destination"><?php  if($line1 != ''){echo $line1 . ", " . $city . ", " . $state;} ?></textarea>
	</div>
	<div class="ui error message"></div>
	<a class="ui submit button">
		<i class="ui icon unlock alternate"></i>
		Signup
	</a>

	<script>
	$('.checkbox').checkbox();

	$('.ui.form.signup').form({
		message   : '.ui.error.message',
		fields: {
			email    : 'email',
			password : ['minLength[4]', 'empty'],
			phone    : ['minLength[8]', 'empty'],
			address  : ['minLength[8]', 'empty'],
		}
	});
    </script>

</form>
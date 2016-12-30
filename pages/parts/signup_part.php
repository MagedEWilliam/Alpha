<form method="POST" action="#" class="ui segment form" style="max-width: 400px;margin-top:0px;">
	<h4>Tell us about yourself:</h4>
	<p>Please fill this form in order to provide us with the order destination.</p>
	<div class="required field">
		<label>Email</label>
		<input type="email" name="email" placeholder=" Same as your PayPal Email" value="<?php echo $payment->payer->payer_info->email; ?>">
	</div>

	<div class="two fields">
		<div class="fourteen wide field">
			<label>Password</label>
			<input type="password" name="password" placeholder=" Type password, be a returning customer?" autofocus>
		</div>
		<div class="two wide field">
			<label style="margin-top: 20px;">Show</label>
			<div class="ui checkbox">
				<input type="checkbox" name="example" onchange="if($(this).prop('checked')){$('[name=password]').prop('type', 'text');}else{$('[name=password]').prop('type', 'password');}">
			</div>
		</div>
	</div>

	<div class="required field">
		<label>Phone</label>
		<input type="tel" name="phone" placeholder=" Make sure it's direct to you" value="<?php echo $payment->payer->payer_info->phone; ?>">
	</div>

	<div class="required field">
		<label>Shipping address</label>
		<textarea name="address" placeholder=" Enter the shipping destination"><?php echo $payment->payer->payer_info->shipping_address->line1 . ", " . $payment->payer->payer_info->shipping_address->city . ", " . $payment->payer->payer_info->shipping_address->state; ?></textarea>
	</div>

<a class="ui button">
		<i class="ui icon unlock alternate"></i>
		Signup
	</a>

<script>$('.checkbox').checkbox();</script>

</form>
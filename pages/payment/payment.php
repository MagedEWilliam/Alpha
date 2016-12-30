<link rel="stylesheet" type="text/css" href="../../libs/semantic/semantic.min.css">
<link rel="stylesheet" type="text/css" href="../../css/style.css">
<script type="text/javascript" src="../../libs/jquery.min.js"></script>
<script type="text/javascript" src="../../libs/semantic/semantic.min.js"></script>

<form method="POST" action="#" class="ui segment form" style="max-width: 450px">
	<h4>Tell us about yourself:</h4>
	<p>Please fill this form in order to provide us with the order destination.</p>
	<div class="required field">
		<label>Email</label>
		<input type="email" name="email" placeholder=" Same as your PayPal Email">
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
		<label>phone</label>
		<input type="tel" name="phone" placeholder=" Make sure it's direct to you">
	</div>

	<div class="required field">
		<label>Address</label>
		<textarea name="address" placeholder=" Enter the shipping destination"></textarea>
	</div>

	<div class="field">
		<input type="submit" class="ui blue button" value="Done">
	</div>

</form>

<script>$('.checkbox').checkbox();</script>
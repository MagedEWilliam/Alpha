<?php include('links.html'); ?>

<form method="post" action="#" class="ui form trackorder">
	<div class="field">
		<label>Email:</label>
		<input type="text" name="uname">
	</div>

	<div class="field">
		<label>Order Number:</label>
		<input type="password" name="orderName">
	</div>
	
	<div class="ui error message"></div>
	
	<a class="ui submit button">
		<i class="ui icon shipping"></i>
		Track
	</button>
</form>

<script>
	$('.ui.form.trackorder').form({
		message   : '.ui.error.message',
		fields: {
			uname     : 'email',
			orderName : ['minLength[6]', 'empty']
		}
	});
</script>
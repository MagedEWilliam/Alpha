<?php include('links.html'); ?>
<form method="POST" action="#" class="ui form login">
	<div class="field">
		<label>Email:</label>
		<input type="text" name="Username">
	</div>

	<div class="field">
		<label>Password:</label>
		<input type="password" name="Password">
	</div>
	
	<div class="ui error message"></div>
	
	<a class="ui button submit">
		<i class="ui icon unlock alternate"></i>
		Login
	</a>
</form>
<script>
	$('.ui.form.login').form({
		message   : '.ui.error.message',
		fields: {
			Username   : 'email',
			Password   : ['minLength[4]', 'empty']
		}
	});
</script>
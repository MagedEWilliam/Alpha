<?php include('links.html'); ?>
<form method="POST" action="#" class="ui form login">
	<div class="field">
		<label>Email:</label>
		<input type="text" name="uname">
	</div>

	<div class="field">
		<label>Password:</label>
		<input type="password" name="pwd">
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
			uname : 'email',
			pwd   : ['minLength[4]', 'empty']
		}
	});
</script>
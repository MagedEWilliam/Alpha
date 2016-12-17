<link rel="stylesheet" type="text/css" href="../../libs/semantic/semantic.min.css">
<link rel="stylesheet" type="text/css" href="../../css/style.css">
<script type="text/javascript" src="../../libs/jquery.min.js"></script>
<script type="text/javascript" src="../../libs/semantic/semantic.min.js"></script>	

<form method="post" action="#" class="ui form">
	<div class="field">
		<label>Name:</label>
		<input type="text" name="uname">
	</div>

	<div class="field">
		<label>Email:</label>
		<input type="text" name="uname">
	</div>

	<div class="ten wide field" style="float: left;">
		<label>Password:</label>
		<input type="password" name="password">
	</div>


	<div class="ui checkbox">
		<input type="checkbox" onchange="if($(this).prop('checked')){$('[name=password]').prop('type', 'text');}else{$('[name=password]').prop('type', 'password');}">
		<label><small>
			Show password
		</small></label>
	</div>

	<div class="field">
		<label>Mobile:</label>
		<input type="text" name="uname">
	</div>

	
	<div class="field">
		<label>Address:</label>
		<input type="text">
	</div>

	<div class="field">
		<label>City:</label>
		<select></select>
	</div>


	<button class="ui button blue">
		<i class="ui icon unlock alternate"></i>
		Sign up
	</button>

</form>
<script type="text/javascript">$('.checkbox').checkbox();</script>
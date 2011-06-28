<div id="auth-form">
	<h3>Auth!</h3>
	<? if (isset($error)) {?>
			<h3>Email или пароль не верны</h3>
	<? } ?>
	<form action="" method="post">
		<label>Email:
			<input type="email" placeholder="example@example.com" name="email" />
		</label>
		<label>Password:
			<input type="password" autofocus placeholder="Password" name="password"/>
		</label>
		<input type="submit" id="submit-button" value="Auth" name="btnsubmit" />
	</form>
</div>

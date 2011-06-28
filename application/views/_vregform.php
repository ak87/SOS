<div id="auth-form">
	<h3>Reg!</h3>

	<? if (isset($regok)) { ?>
		<h3>Вы зарегистрировались</h3>
	<? } elseif (isset($errors)) { ?>
		<? foreach($errors as $item) { ?>
				<h3><?=$item?></h3>
			<? } ?>
	<? } ?>

	<form action="" method="post">
		<label>Email:
			<input type="email" placeholder="example@example.com" name="email" />
		</label>
		<label>Password:
			<input type="password" autofocus placeholder="Password" name="password"/>
		</label>
		<input type="submit" id="submit-button" value="Reg" name="btnsubmit" />
	</form>
</div>

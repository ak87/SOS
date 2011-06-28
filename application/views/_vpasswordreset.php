<div id="auth-form">
<h3>Введите адрес эл.почты.</h3>
<? if (isset($error)) { ?>
	<h3>Пароль обновить не удалось</h3>
<? } elseif (isset($ok)) { ?>
	<h3>Пароль обновлен!</h3>
<? } elseif (isset($oktoken)) { ?>
	<h3>Token и id существуют в базе!</h3>
<? } ?>

	<form action="" method="post">
		<label>Новый пароль:
			<input type="password" placeholder="password" name="password" />
		</label>
		<label>Повторите пароль:
			<input type="password" placeholder="password confirm" name="password_confirm" />
		</label>
		<input type="submit" id="submit-button" value="Обновить пароль" name="btnsubmit" />
	</form>

</div>


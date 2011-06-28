<div id="auth-form">
<h3>Введите адрес эл.почты.</h3>
<? if (isset($error)) { ?>
	<h3>Адрес эл.почты не найден</h3>
<? } elseif (isset($ok)) { ?>
	<h3>Проверьте вашу электронную почту</h3>
<? } ?>


	<form action="" method="post">
		<label>Email:
			<input type="email" placeholder="example@example.com" name="email" />
		</label>
		<input type="submit" id="submit-button" value="Отправить" name="btnsubmit" />
	</form>
</div>


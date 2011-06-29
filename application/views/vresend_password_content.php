		<div class="grid_16 content signup resend_password">
			<h1>Восстановление пароля</h1>
			<p>Пожалуйста, укажите e-mail, который Вы использовали для входа на сайт.</p>

			<? if (isset($ok)) { ?>
				<div class="success"><p>На указанный e-mail было отправленно письмо. Для востановления пароля перейдите по ссылке указанной в письме.</p></div>
			<? } elseif (isset($error)) { ?>
				<div class="error"><p>Не удалось отправить письмо.</p></div>
			<? } ?>

			<form action="" method="post">
				<table>
					<tr>
						<td><p>E-mail:</p></td>
						<td><input type="text" name="email" maxlength="127" value=""/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" name="submit_resend_password" class="submit-button" value="Отправить"/></td>
					</tr>
				</table>
			</form>
		</div>

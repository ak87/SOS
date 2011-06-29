		<div class="grid_16 content signup reset_password">
			<h1>Восстановление пароля</h1>

			<? if (!isset($token_error)) { ?>

				<p>Пожалуйста, укажите новый пароль. Ваш e-mail: <strong><?=$user_email?></strong>.</p>

				<? if (isset($update_ok)) { ?>
					<div class="success"><p>Пароль успешно обновлен.</p></div>
				<? } elseif (isset($update_error)) { ?>
					<div class="error"><p>Ошибка изменения пароля.</p></div>
				<? } ?>

				<form action="" method="post">
					<table>
						<tr>
							<td><p>Новый пароль:</p></td>
							<td><input type="password" name="password" maxlength="40" value=""/></td>
						</tr>
						<tr>
							<td><p>Повторите пароль:</p></td>
							<td><input type="password" name="password_confirm" maxlength="40" value=""/></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><input type="submit" name="submit_reset_password" class="submit-button" value="Изменить"/></td>
						</tr>
					</table>
				</form>

			<? } else { ?>
				<div class="error"><p>Извините, Вы перешли по не верной ссылки востановления пароля.</p></div>
			<? } ?>
		</div>

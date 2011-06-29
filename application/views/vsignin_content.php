		<div class="grid_16 content signup signin">
			<h1>Вход</h1>

				<? if (isset($error_login_or_password)) { ?>
					<div class="error"><p>Указан неверный логин или пароль.</p></div>
				<? } ?>
				<? if (isset($error_activation_user)) { ?>
					<div class="error"><p>Данная учетная запись не активированна. <a href="/signin/repeatactivation">Нажмите чтобы повторить отправку активационного письма.</a></p></div>
				<? } ?>
				<? if (isset($activation_on)) { ?>
					<div class="success"><p>Поздравляем! Ваша учетная запись успешно активированна.</p></div>
				<? } ?>
				<? if (isset($activation_error)) { ?>
					<div class="error"><p>Ошибка! Ссылка активации учетной записи не действительна.</p></div>
				<? } ?>

				<form action="" method="post">
					<table>
						<tr>
							<td><p>E-mail:</p></td>
							<td><input type="text" name="email" maxlength="127" value="<?=$email?>"/></td>
						</tr>

						<tr>
							<td><p>Пароль:</p></td>
							<td><input type="password" name="password" maxlength="40" value="" /></td>
						</tr>

						<tr>
							<td>&nbsp;</td>
							<td><p class="checkremember_me"><input type="checkbox" name="remember_me" class="check" value="TRUE"/> Запомнить меня</p></td>
						</tr>

						<tr>
							<td>&nbsp;</td>
							<td><input type="submit" name="submit_signin" class="submit-button" value="Вход"/></td>
						</tr>

						<tr>
							<td>&nbsp;</td>
							<td><p><a href="/resendpassword" class="linkresendpassword">Забыли пароль?</a></td>
						</tr>

					</table>
				</form>

		</div>

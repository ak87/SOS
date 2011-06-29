		<div class="grid_6 content signup">
			<h2>Регистрация</h2>

			<? if (isset($signup_ok)) { ?>
				<div class="success"><p>Вы успешно зарегистрировались! Вам отправленно письмо для подтверждения регистрации.</p></div>
			<? } elseif (isset($errors)) { ?>
				<? foreach($errors as $item) { ?>
					<div class="error"><p><?=$item?></p></div>
				<? } ?>
			<? } ?>

			<form action="" method="post">
				<table>
					<tr>
						<td><p>Имя:</p></td>
						<td><input type="text" name="first_name" maxlength="200" value=""/></td>
					</tr>
					<tr>
						<td><p>Фамилия:</p></td>
						<td><input type="text" name="last_name" maxlength="200" value=""/></td>
					</tr>
					<tr>
						<td><p>E-mail:</p></td>
						<td><input type="text" name="email" maxlength="127" value=""/></td>
					</tr>
					<tr>
						<td><p>Пароль:</p></td>
						<td><input type="password" name="password" maxlength="40" value=""/></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" name="submit_signup" class="submit-button" value="Регистрация"/></td>
					</tr>
				</table>
			</form>
		</div>

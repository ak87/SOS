		<div class="grid_6 header header_signin">
			<form action="/signin" method="post">
				<table>
					<tr>
						<td><p>E-mail</p></td>
						<td><p>Пароль</p></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td><input type="text" name="email" maxlength="127" value=""/></td>
						<td><input type="password" name="password" maxlength="40" value="" /></td>
						<td><input type="submit" name="submit_signin" class="submit-button" value="Войти"/></td>
					</tr>
					<tr>

						<td><input type="checkbox" name="remember_me" class="check" value="TRUE"/><p>Запомнить меня</p></td>
						<td><p><a href="/resendpassword">Забыли пароль?</a></td>
						<td>&nbsp;</td>
					</tr>
				</table>
			</form>
		</div>

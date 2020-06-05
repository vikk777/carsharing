<?php defined('COURSE') or exit('Acces denied');?>

<form action="" method="POST">
	<table>
		<tr>
			<td>name</td>
			<td>role</td>
		</tr>
		<?php foreach ($users as $user): ?>
			<tr>
				<td><?=$user['name']?></td>
				<td>
					<?php if ($user['role'] < 2): ?>
						<select name="<?=$user['name']?>">
							<option value="0" <?=($user['role'] == 0) ? 'selected' : '' ;?>>Admin</option>
							<option value="1" <?=($user['role'] == 1) ? 'selected' : '' ;?>>Manager</option>
						</select>
					<?php else: ?>
						client
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<input type="submit" value="Изменить">
</form>

<form action="?view=add_user" method="POST">
	<p><input type="text" name="name" placeholder="Логин" required></p>
	<p><input type="password" name="pass" placeholder="Пароль" required></p>
	<p>
		<select name="role">
			<option value="1">Manager</option>
			<option value="0">Admin</option>
		</select>
	</p>
	<input type="submit" value="Добавить пользователя">
</form>
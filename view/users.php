<?php defined('COURSE') or exit('Acces denied');?>

<h2>Пользователи</h2>
<div class="row">
	<div class="col-md-8">
		<form action="" method="POST">
			<table class="table table-hover">
				<thead>
					<th>name</th>
					<th>role</th>
					<th>banned</th>
				</thead>
				<tbody>
					<?php foreach ($users as $user): ?>
						<tr>
							<td><?=$user['name']?></td>
							<td class="form-group col-md-3">
								<?php if ($user['role'] < 2): ?>
									<select class="form-control"> name="<?=$user['name']?>">
										<option value="0" <?=($user['role'] == 0) ? 'selected' : '' ;?>>Admin</option>
										<option value="1" <?=($user['role'] == 1) ? 'selected' : '' ;?>>Manager</option>
									</select>
								<?php else: ?>
									client
								<?php endif; ?>
							</td>
						<td><?=($client['banned']) ? 'Да' : 'Нет'?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<input type="submit" class="btn btn-primary" value="Изменить">
		</form>
	</div>
</div>
<br><br>
<div class="row">
	<div class="col-md-3">
		<h4>Добавление пользователя</h4>
		<form action="?view=add_user" method="POST">
			<div class="form-group">
				<input class="form-control" type="text" name="name" placeholder="Логин" required></div>
			<div class="form-group">
				<input class="form-control" type="password" name="pass" placeholder="Пароль" required></div>
			<div class="form-group">
				<select class="form-control" name="role">
					<option value="1">Manager</option>
					<option value="0">Admin</option>
				</select>
			</div>
			<input type="submit" class="btn btn-primary" value="Добавить пользователя">
		</form>
	</div>
</div>
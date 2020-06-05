<?php defined('COURSE') or exit('Acces denied');?>

<form action="" method="POST">
	<div class="col-md-4 col-md-offset-3">
		<h2>Введите логин и пароль</h2>
		<div class="form-group">
			<input class="form-control" type="text" name="name" placeholder="Логин" value="<?=(isset($_POST['name']) ? $_POST['name'] : '')?>" required>
		</div>
		<div class="form-group">
			<input class="form-control" type="password" name="pass" placeholder="Пароль" required>
		</div>
		<input class="btn btn-primary form-control" type="submit" value="Войти">
	</div>
</form>
<?php defined('COURSE') or exit('Acces denied');?>

<form action="" method="POST">
	<div class="col-md-4 col-md-offset-3">
		<h2>Введите данные для регистрации</h2>
		<div class="form-group">
			<input class="form-control" type="text" name="name" placeholder="Логин" value="<?=(isset($_POST['name']) ? $_POST['name'] : '')?>" required>
		</div>
		<div class="form-group">
			<input class="form-control" type="password" name="pass" placeholder="Пароль" required>
		</div>
		<div class="form-group">
			<label for="phone">Серия и номер паспорта (10 цифр)
			<input class="form-control" type="text" name="license" placeholder="0000000000" pattern="[0-9]{10}" value="<?=$_POST['license']?>" required>
		</div>
		<div class="form-group">
			<label for="phone">Телефон в формате: +7xxxxxxxxxx
	</label>
			<input class="form-control" type="tel" name="phone" pattern="+7[0-9]{10}" placeholder="Номер телефона" value="+7" value="<?=(isset($_POST['phone']) ? $_POST['phone'] : '')?>" required>
		</div>
			<input class="btn btn-primary form-control" type="submit" value="Зарегистрироваться">
	</div>
</form>
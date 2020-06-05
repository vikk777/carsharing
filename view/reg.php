<?php defined('COURSE') or exit('Acces denied');?>

<p>Введите логин и пароль.</p>
<form action="" method="POST">
	<p><input type="text" name="name" placeholder="Логин" required></p>
	<p><input type="password" name="pass" placeholder="Пароль" required></p>
	<p><input type="text" name="license" placeholder="Серия и номер пасорта" pattern="[0-9]{10}" required></p>
	<p>Телефон в формате: +7xxxxxxxxxx</p>
	<p><input type="tel" name="phone" pattern="+7[0-9]{10}" placeholder="Номер телефона" value="+7" required></p>
	<input type="submit" placeholder="Зарегистрироваться">
</form>
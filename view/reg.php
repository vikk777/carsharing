<?php defined('COURSE') or exit('Acces denied');?>

<p>Введите логин и пароль.</p>
<form action="" method="POST">
	<p><input type="text" name="name" placeholder="Логин" required></p>
	<p><input type="password" name="pass" placeholder="Пароль" required></p>
	<input type="submit">
</form>

<?php if (!empty($_POST)): ?>
	<?php if (!isset($_SESSION['error'])): ?>
		<p>Пользователь успешно добавлен. Дождитесь, пока администратор проверит ваши данные.</p>
	<?php else: ?>
		<p><?=$_SESSION['error']?></p>
		<?php unset($_SESSION['error']); ?>
	<?php endif; ?>
<?php endif; ?>
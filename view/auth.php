<?php defined('COURSE') or exit('Acces denied');?>

<p>Введите логин и пароль</p>

<form method="POST">
	<p><input type="text" name="name" placeholder="Логин" required></p>
	<p><input type="password" name="pass" placeholder="Пароль" required></p>
	<input type="submit" value="login">
</form>

<?php if (!empty($_POST)): ?>
	<?php if (!isset($_SESSION['warning'])): ?>
		<p>Добро пожаловать, <?=$_SESSION['name']?></p>
	<?php else: ?>
		<p><?=$_SESSION['warning']?></p>
		<?php unset($_SESSION['warning']); ?>
	<?php endif; ?>
<?php endif; ?>
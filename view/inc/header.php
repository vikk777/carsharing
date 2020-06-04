<?php defined('COURSE') or exit('Acces denied');?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Title</title>
	<link rel="stylesheet" href="<?=VIEW?>css/style.css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
</head>
<body>
<div class="menu">
	<a href="?view=main">Главная</a>

	<?php if (!is_authorized()): ?>
		<a href="?view=auth">Авторизация</a>
		<a href="?view=reg">Регистрация</a>
	<?php endif; ?>

	<!-- Управление пользователями для администратора -->
	<?php if ($_SESSION['role'] == 0): ?>
		<a href="?view=users">Пользователи</a>
	<?php endif; ?>

	<!-- Управление магазином для управляющего -->
	<?php if ($_SESSION['role'] == 1): ?>
		<!-- <a href="?view=manager&obj=myshops">Магазины</a> -->
	<?php endif; ?>

	<!-- Выход -->
	<?php if (is_authorized()): ?>
		<a href="?view=cars">Автомобили</a>
		<a href="?view=out">Выйти</a>
	<?php endif; ?>
</div>
<div class="content">
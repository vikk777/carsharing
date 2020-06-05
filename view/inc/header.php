<?php defined('COURSE') or exit('Acces denied');?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Carsharing</title>
	<link rel="stylesheet" href="<?=VIEW?>css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
		<a href="?view=clients">Клиенты</a>
	<?php endif; ?>
	
	<!-- Для клиента -->
	<?php if (is_authorized() and $_SESSION['role'] == 2): ?>
		<a href="?view=cabinet">Кабинет</a>
	<?php endif; ?>

	<?php if (is_authorized()): ?>
		<a href="?view=cars">Автомобили</a>
		<a href="?view=requests">Заявки</a>
		<a href="?view=contracts">Договоры</a>
		<a href="?view=out">Выйти</a>
	<?php endif; ?>
</div>
<div class="content">
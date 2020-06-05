<?php defined('COURSE') or exit('Acces denied');?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Carsharing</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"></head>
	<link rel="stylesheet" href="<?=VIEW?>css/style.css">
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="?view=main">
					Carsharing
				</a>
			</div>
			<div class="collapse navbar-collapse" id="navbar">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<?php if (!is_authorized()): ?>
							<a href="?view=auth">Авторизация</a>
					</li>
					<li>
							<a href="?view=reg">Регистрация</a>
						<?php else: ?>
							<a href="?view=out">Выйти</a>
						<?php endif; ?>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="list-group sidebar col-md-2">
		<!-- Управление пользователями для администратора -->
		<?php if ($_SESSION['role'] == 0): ?>
			<a class="list-group-item" href="?view=users">Пользователи</a>
		<?php endif; ?>

		<!-- Управление магазином для управляющего -->
		<?php if ($_SESSION['role'] == 1): ?>
			<a class="list-group-item" href="?view=clients">Клиенты</a>
		<?php endif; ?>
		
		<!-- Для клиента -->
		<?php if (is_authorized() and $_SESSION['role'] == 2): ?>
			<a class="list-group-item" href="?view=cabinet">Кабинет</a>
		<?php endif; ?>

		<?php if (is_authorized()): ?>
			<a class="list-group-item" href="?view=cars">Автомобили</a>
			<a class="list-group-item" href="?view=requests">Заявки</a>
			<a class="list-group-item" href="?view=contracts">Договоры</a>
		<?php endif; ?>
		</div>
		<div class="content col-md-10">
<?php defined('COURSE') or exit('Acces denied');?>

<p>Добро пожаловать, <?=(isset($_SESSION['name'])) ? $_SESSION['name'] : 'Гость'?></p>

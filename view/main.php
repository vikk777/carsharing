<?php defined('COURSE') or exit('Acces denied');?>

<h2>Добро пожаловать, <?php echo (isset($_SESSION['name'])) ? $_SESSION['name'] : 'Гость'?></h2>

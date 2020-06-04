<?php  
	defined('COURSE') or exit('Acces denied');

	define('MODEL', 'model/model.php');
	define('CONTROLLER', 'controller/controller.php');
	define('VIEW', 'view/');


	$mysql = new mysqli("localhost", "root", "", "carsharing");

	if ($mysql->connect_errno) {
		echo "Не удалось подключиться. " . $mysql->connect_errno . " : " . $mysql->connect_error;
		exit;
	}
 ?>
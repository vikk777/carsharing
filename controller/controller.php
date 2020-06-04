<?php 
	defined('COURSE') or exit('Acces denied');

	// Константы

	define('BASES', 1);
	define('USERS', 2);
	define('DEPS', 3);

	session_start();

	if (!isset($_SESSION['role'])) {
		$_SESSION['role'] = 2;
	}

	require_once MODEL;

	require_once 'functions/functions.php';
	
	$view = empty($_GET['view']) ? 'main' : $_GET['view'];

	switch ($view) {
		case 'reg':
			// print_r($_SERVER);
			if (!empty($_POST)) {
				$name = $_POST['name'];
				$pass = $_POST['pass'];
				$role = (isset($_POST['role'])) ? $_POST['role'] : 2;
				$license = (isset($_POST['license'])) ? $_POST['license'] : '';
				$phone = (isset($_POST['phone'])) ? $_POST['phone'] : '';
				registration_user($name, $pass, $role, $license, $phone);
				redirect();
			}elseif (is_authorized()) {
				$view = 'main';
			}
			break;

		case 'auth':
			if (!empty($_POST)){
				$name = $_POST['name'];
				$pass = $_POST['pass'];
				authorization($name, $pass);
				// redirect();
			}elseif (is_authorized()) {
				$view = 'main';
			}
			break;
			
		case 'out':
			unset($_SESSION['name']);
			$_SESSION['role'] = 2;
			$view = 'main';
			break;

		case 'users':
			if ($_SESSION['role'] == 0){

				if (!empty($_POST)) {
					$new_roles = $_POST;
					change_roles($new_roles);
				}

				$users = show_users();
			}
			else{
				$_SESSION['error'] = "Только Администратор имеет доступ к этомй странице.";
			}
			break;

		case 'cars':
			if (!empty($_POST)) {
				$id = $_POST['id'];
				$type = $_POST['type'];
				$model = $_POST['model'];
				$color = $_POST['color'];
				$price = $_POST['price'];
				$aviable = $_POST['aviable'] ? 1 : 0;
				add_car($id, $type, $model, $color, $price, $aviable);
			}
			$cars = get_cars();
			break;

		default:
			$view = 'main';
			break;
	}

	require_once VIEW.'/index.php';
 ?>
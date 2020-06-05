<?php 
	defined('COURSE') or exit('Acces denied');

	// Константы

	define('BASES', 1);
	define('USERS', 2);
	define('DEPS', 3);

	session_start();

	if (!isset($_SESSION['role'])) {
		$_SESSION['role'] = 3;
	}

	require_once MODEL;

	require_once 'functions/functions.php';
	
	$view = empty($_GET['view']) ? 'main' : $_GET['view'];

	check_contracts();
	check_user();

	switch ($view) {
		case 'reg':
			// print_r($_SERVER);
			if (!empty($_POST)) {
				$name = $_POST['name'];
				$pass = $_POST['pass'];
				$role = 2;
				$license = (isset($_POST['license'])) ? $_POST['license'] : '';
				$phone = (isset($_POST['phone'])) ? $_POST['phone'] : '';
				registration_user($name, $pass, $role, $license, $phone);
				// redirect();
			}
			elseif (is_authorized()) {
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

		case 'add_user':
			if ($_SESSION['role'] == 0) {
				if (!empty($_POST)) {
					$name = $_POST['name'];
					$pass = $_POST['pass'];
					$role = $_POST['role'];

					registration_user($name, $pass, $role);
					redirect();
				}
			} else{
				$view = 'main';
			}
			break;

		case 'clients':
			if ($_SESSION['role'] == 1) {
				if (!empty($_POST)) {
					$name = $_POST['name'];
					change_user_status($name);
				}
				$clients = get_clients();
			}
			break;

		case 'cars':
			if (is_authorized()) {
				if (!empty($_POST)) {
					$id = $_POST['id'];
					$type = $_POST['type'];
					$model = $_POST['model'];
					$color = $_POST['color'];
					$price = $_POST['price'];
					$aviable = $_POST['aviable'] ? 1 : 0;
					$img = $_FILES['img'];
					add_car($id, $type, $model, $color, $price, $aviable, $img);
				}
				$cars = get_cars();
			}
			else{
				$view = 'main';
			}
			break;

		case 'add_request':
			if (is_authorized()) {
				if (!empty($_POST)) {
					$client = $_POST['client'];
					$car = $_POST['car'];
					if (add_request($client, $car))
						redirect('?view=requests');
					else redirect();
				}
				// $cars = get_cars();
			}
			else{
				$view = 'main';
			}
			break;

		case 'accept_request':
			if ($_SESSION['role'] == 1) {
				if (!empty($_POST)) {
					$id = $_POST['id'];
					$client = $_POST['client'];
					$employe = $_POST['employe'];
					$car = $_POST['car'];
					accept_request($id, $client, $employe, $car);
					redirect();
				}
			}
			else{
				$view = 'main';
			}
			break;

		case 'discard_request':
			if ($_SESSION['role'] == 1) {
				if (!empty($_POST)) {
					$id = $_POST['id'];
					discard_request($id);
					redirect();
				}
			}
			else{
				$view = 'main';
			}
			break;

		case 'requests':
			if (is_authorized()) {
				$requests = ($_SESSION['role'] == 2) ? requests($_SESSION['name']) : requests();
				}
			break;

		case 'contracts':
			if (is_authorized()) {
				$contracts = ($_SESSION['role'] == 2) ? contracts($_SESSION['name']) : contracts();
				}
			break;

		case 'cabinet':
			if ($_SESSION['role'] == 2) {
				$cabinet = cabinet();
			}
			else{
				$view = 'main';
			}
			break;

		case 'add_cash':
			if ($_SESSION['role'] == 2) {
				if (!empty($_POST)) {
					$cash = $_POST['cash'];
					add_cash($cash);
					redirect();
				}
			}
			else{
				$view = 'main';
			}
			break;

		default:
			$view = 'main';
			break;
	}

	require_once VIEW.'/index.php';
 ?>
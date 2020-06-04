<?php  
	defined('COURSE') or exit('Acces denied');

	require_once "model/math.php";

//Регистрация
	function registration_user($name, $pass, $role, $license, $phone)
	{
		global $mysql;

		$query = "SELECT name
					FROM users
					WHERE `name`='$name'";

		$res = $mysql->query($query);

		if ($res->num_rows > 0){
			$_SESSION['error'] = "Пользователь с именем '$name' уже существует.";
			return;
		}

		$query = "INSERT INTO users 
					VALUES ('$name', '" . hash('sha256', '$pass') . "', $role)";

		$res = $mysql->query($query);

		if (!$res){
			echo $mysql->errno . " : " . $mysql->error;
			exit;
		}

		if ($role == 2) {
			
		}

		if (!isset($_SESSION['name'])){
			$_SESSION['name'] = $name;
			$_SESSION['role'] = $role;
		}
	}

// Авторизация
	function authorization($name, $pass)	{
		global $mysql;
		$query = "SELECT name, password, role
					FROM users
					WHERE `name`='$name'";

		$res = $mysql->query($query);

		if (!$res){
			echo $mysql->errno . " : " . $mysql->error;
			return;
		}

		if ($res->num_rows > 0){
			$row = $res->fetch_assoc();

			if (hash('sha256', $pass) == $row['password']){
				$_SESSION['name'] = $row['name'];
				$_SESSION['role'] = $row['role'];
			}
			return;
		}

		$_SESSION['warning'] = "Не правильный пароль или имя пользователя.";
	}

// Показать таблицу пользователей
	function show_users(){
		global $mysql;

		$query = "SELECT name, role
					FROM users";

		$res = $mysql->query($query);

		if (!$res){
			echo $mysql->errno . " : " . $mysql->error;
			return;
		}

		$users = array();

		while ($row = $res->fetch_assoc()) {
			$users[] = $row;
		}

		return $users;
	}


	function change_roles($new_roles){
		global $mysql;

		$query = "SELECT id, role FROM users";

		$res = $mysql->query($query);

		if (!$res){
			echo $mysql->errno . " : " . $mysql->error;
			return;
		}

		while ($row = $res->fetch_assoc()) {
			$id = $row['id'];
			$role = $row['role'];

			if ($new_roles[$id] != $role) {
				$query = "UPDATE `users` SET `role` = '$new_roles[$id]' WHERE `users`.`id` = '$id';";

				$next = $mysql->query($query);

				if (!$next){
					echo $mysql->errno . " : " . $mysql->error;
					return;
				}
			}
		}

	}


	function get_cars()
	{
		global $mysql;

		$query = "SELECT *
					FROM cars";

		$res = $mysql->query($query);

		if (!$res){
			echo $mysql->errno . " : " . $mysql->error;
			return;
		}

		$cars = array();

		while ($row = $res->fetch_assoc()) {
			$cars[] = $row;
		}

		return $cars;
	}

	function add_car($id, $type, $model, $color, $price, $aviable)
	{
		global $mysql;

		$query = "SELECT id
					FROM cars
					WHERE `id` = '$id'";

		$res = $mysql->query($query);

		if (!$res){
			echo $mysql->errno . " : " . $mysql->error;
			return;
		}

		if ($res->num_rows > 0){
			$_SESSION['warning'] = "Автомобиль с таким номером уже существует.";
			return;
		}

		$query = "INSERT INTO cars
					VALUES ('$id', '$type', '$model', '$color', '$price', '$aviable')";

		$res = $mysql->query($query);

		if (!$res){
			echo $mysql->errno . " : " . $mysql->error;
			return;
		}
	}
 ?>
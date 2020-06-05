<?php  
	defined('COURSE') or exit('Acces denied');

	require_once "model/math.php";

//Регистрация
	function registration_user($name, $pass, $role, $license = '', $phone = '')
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
					VALUES ('$name', '" . hash('sha256', $pass) . "', $role)";

		$res = $mysql->query($query);

		if (!$res){
			echo $mysql->errno . " : " . $mysql->error;
			exit;
		}

		if ($role == 2) {
			$query = "INSERT INTO clients 
					VALUES ('$name', 'NULL', '$license', '$phone')";

			$res = $mysql->query($query);

			if (!$res){
				echo $mysql->errno . " : " . $mysql->error;
				exit;
			}
		}

		if (!isset($_SESSION['name'])){
			$_SESSION['name'] = $name;
			$_SESSION['role'] = $role;
			$_SESSION['success'] = 'Вы успешно зарегистрировались.';
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
				return;
			}
		}

		$_SESSION['warning'] = "Не правильный пароль или имя пользователя.";
	}

// Показать таблицу пользователей
	function show_users(){
		global $mysql;

		$query = "SELECT name, role
					FROM users
					ORDER BY role";

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

		$query = "SELECT name, role FROM users
					WHERE role < 2";

		$res = $mysql->query($query);

		if (!$res){
			echo $mysql->errno . " : " . $mysql->error;
			return;
		}

		while ($row = $res->fetch_assoc()) {
			$name = $row['name'];
			$role = $row['role'];

			if ($new_roles[$name] != $role) {
				$query = "UPDATE `users` SET `role` = '$new_roles[$name]' WHERE `users`.`name` = '$name';";

				$next = $mysql->query($query);

				if (!$next){
					echo $mysql->errno . " : " . $mysql->error;
					return;
				}
			}
		}

	}


	function get_clients()
	{
		global $mysql;

		$query = "SELECT *
					FROM clients";

		$res = $mysql->query($query);

		if (!$res){
			echo $mysql->errno . " : " . $mysql->error;
			return;
		}

		$clients = array();

		while ($row = $res->fetch_assoc()) {
			$clients[] = $row;
		}

		return $clients;
	}


	function get_cars()
	{
		global $mysql;

		$query = "SELECT *
					FROM cars
					WHERE aviable = 1";

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

	function add_car($id, $type, $model, $color, $price, $aviable, $img)
	{
		global $mysql;

		$uploaddir = VIEW.'img/';
		$uploadfile = $uploaddir . hash('sha256', basename($img['tmpname'])) . pathinfo($img['name'], PATHINFO_EXTENSION);

		echo "$uploadfile";
		echo $img['tmpname'];

		if (move_uploaded_file($img['tmp_name'], $uploadfile)) {
			echo "Файл корректен и был успешно загружен.";
		} elseif ($img['error'] == 2) {
			$_SESSION['warning'] = 'Файл слишком большой.';
			return;
		} else {
			$_SESSION['warning'] = 'Произошла ошибка при загрузке файла.';
			return;
		}

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
					VALUES ('$id', '$type', '$model', '$color', '$price', '$aviable', '$uploadfile')";

		$res = $mysql->query($query);

		if (!$res){
			echo $mysql->errno . " : " . $mysql->error;
			return;
		}

		$_SESSION['success'] = 'Автомобиль успешно добавлен.';
	}

	function requests($client='')
	{
		global $mysql;

		$query = "SELECT *
					FROM requests";
		$query .= (!empty($client)) ? " WHERE `client` = '$client'" : "";

		$res = $mysql->query($query);

		if (!$res){
			echo $mysql->errno . " : " . $mysql->error;
			return;
		}

		$requests = array();

		while ($row = $res->fetch_assoc()) {
			$requests[] = $row;
		}

		return $requests;
	}

	function add_request($client, $car)
	{
		global $mysql;

		$query = "SELECT id
					FROM requests
					WHERE client = '$client' AND
					car = '$car' AND status = 'wait'";

		$res = query($query);
		
		if ($res->num_rows > 0) {
			$_SESSION['warning'] = 'Вы уже подали заявку на данный автомобиль.';
			return false;
		}

		$query = "SELECT `clients`.`account`, `cars`.`price`
					FROM clients
					JOIN cars
					ON `clients`.`name` = '$client' AND
					`cars`.`id` = '$car'";

		$res = query($query);
		$row = $res->fetch_assoc();
		$date = strtotime('now');
		
		if (!empty($row)) {
			if ($row['account'] >= $row['price']) {
				$query = "INSERT INTO requests (`client`, `car`, `date`)
							VALUES ('$client', '$car', '$date')";

				$res = query($query);

				// $query = "UPDATE clients
				// 			SET account = ${row['account']} - ${row['price']}
				// 			WHERE name = '$client'";

				// $res = query($query);

				return true;
			}
			else{
				$_SESSION['warning'] = 'Не достаточно средств на счете.';
				return false;
			}
		}
	}

	function accept_request($id, $client, $employe, $car)
	{
		$query = "UPDATE requests
					SET status = 'accept'
					WHERE id = '$id'";

		$res = query($query);
		
		$date_begin = strtotime('now');
		$date_end = strtotime('now + 1 day');
		
		$query = "INSERT INTO contracts (`client`, `employe`, `date_begin`, `date_end`, `car`)
					VALUES ('$client', '$employe', '$date_begin', '$date_end', '$car')";

		$res = query($query);

		$query = "UPDATE cars
					SET aviable = 0
					WHERE id = '$car'";

		$res = query($query);

		$_SESSION['success'] = 'Заявка принята. Заключен новый договор.';
	}

	function discard_request($id)
	{
		$query = "UPDATE requests
					SET status = 'discard'
					WHERE id = '$id'";

		$res = query($query);
		$_SESSION['success'] = 'Заявка отвергнута.';
	}

	function contracts($client='')
	{
		global $mysql;

		$query = "SELECT *
					FROM contracts";
		$query .= (!empty($client)) ? " WHERE `client` = '$client'" : "";

		$res = $mysql->query($query);

		if (!$res){
			echo $mysql->errno . " : " . $mysql->error;
			return;
		}

		$contracts = array();

		while ($row = $res->fetch_assoc()) {
			$contracts[] = $row;
		}

		return $contracts;
	}

	function cabinet()
	{
		global $mysql;

		$query = "SELECT *
					FROM clients
					WHERE name = '${_SESSION['name']}'";

		$res = query($query);
		return $res->fetch_assoc();
	}

	function add_cash($cash)
	{
		global $mysql;

		$query = "UPDATE clients
					SET account = account + $cash
					WHERE name = '${_SESSION['name']}'";

		$res = query($query);
	}

 ?>
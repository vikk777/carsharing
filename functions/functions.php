<?php  
	defined('COURSE') or exit('Acces denied');

	function redirect($address='')
	{
		if (!empty($address)) {
			$redirect = $address;
		} else{
			$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		}
		// $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		header("Location: $redirect");
		exit;
	}

	function is_authorized()
	{
		return isset($_SESSION['name']);
	}

	function query($query)
	{
		global $mysql;
		
		$res = $mysql->query($query);

		if (!$res){
			echo $mysql->errno . " : " . $mysql->error;
			exit;
		}

		return $res;
	}

	function get_flashed()
	{
		if (isset($_SESSION['warning'])) {
			echo "<p>" . $_SESSION['warning'] . "</p>";
			unset($_SESSION['warning']);
		}
		if (isset($_SESSION['success'])) {
			echo "<p>" . $_SESSION['success'] . "</p>";
			unset($_SESSION['success']);
		}
	}

 ?>
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
 ?>
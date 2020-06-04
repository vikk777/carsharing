<?php 

	function get_rsa_keys($p, $q){
		$mod = $p*$q;
		$fi = ($p-1)*($q-1);

		for ($e=$fi-1; $e > 1; $e--) { 
			if (!is_simple($e)) continue;
			if (nod($e, $fi) != 1) continue;
			break;
		}

		if ($e == 1) {
			return 0;
		}

		$d = get_inverse($e, $fi);

		if ($d == $e) {
			$d++;

			while ((($d*$e) % $fi) != 1) {
				$d++;

				if ($d == $e) {
					$d++;
				}
			}
		}

		return array(
			'e'   => $e,
			'd'   => $d,
			'mod' => $mod);

	}

	function is_simple($num){
		for ($i=3; $i <= (int)($num/2); $i++) {
			if ($num % $i == 0) {
				return 0;
			}
		}
		return 1;
	}

	function nod($a, $b){
		while ($a * $b != 0) {
			if ($a > $b) {
				$a = $a % $b;
			}else{
				$b = $b % $a;
			}
		}

		return ($a == 0 ? $b : $a);
	}

	function get_inverse($a, $b){
		$fi = $b;
		$x = array(1 , 0);
		$y = array(0 , 1);

		while (($b != 1) && ($a != 1)) {
			if ($b > $a) {
				$x[1] -= ((int)($b/$a)) * $x[0];
				$y[1] -= ((int)($b/$a)) * $y[0];
				$b %= $a;
			}else{
				$x[0] -= ((int)($a/$b)) * $x[1];
				$y[0] -= ((int)($a/$b)) * $y[1];
				$a %= $b;
			}
		}

		return ($a == 1 ? ($x[0] > 0 ? $x[0] : $fi + $x[0]) : ($x[1] > 0 ? $x[1] : $fi + $x[1]));
	}

	function factor($num){
		$simples = array();
		$tmp = (int)($num);
		$i = 2;

		while ($tmp != 1) {
			if ($tmp % $i == 0) {
				$simples[$i]++;
				$tmp = $tmp / $i;
			} else {
				$i++;
			}
		}

		return $simples;
	}

	function is_smooth($num){
		if ($num == 1) {
			return "1";
		}

		if ($num == 0) {
			return "0";
		}

		$simples = factor($num);
		$str = "$num = ";
		// print_r($num);

		foreach ($simples as $key => $value) {
			// if (($key == 2) || ($key == 3) || ($key == 5) || ($key == 7)) {
			if (($key == 2) || ($key == 3) || ($key == 5)) {
			// if (($key == 2) || ($key == 3)) {
				$str .= $key . "<sup>" . $value . "</sup>" . " * ";
			}
			else{
				$str = NULL;
				break;
			}
		}

		if ($str != NULL) {
			$str[strlen($str) - 4] = 0;
		}

		return $str;
	}

	function pow_mod($number, $module, $power){
		$res = $number;
		for ($i=1; $i < $power; $i++) { 
			$res *= $number;
			$res %= $module;
		}

		return $res;
	}
 ?>
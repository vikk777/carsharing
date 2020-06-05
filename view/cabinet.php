<?php defined('COURSE') or exit('Acces denied');?>

<table>
	<tr>
		<td>name</td>
		<td>license</td>
		<td>account</td>
		<td>phone</td>
	</tr>
	<tr>
		<td><?=$cabinet['name']?></td>
		<td><?=$cabinet['license']?></td>
		<td><?=$cabinet['account']?></td>
		<td><?=$cabinet['phone']?></td>
	</tr>
</table>

<form action="?view=add_cash" method="POST">
	<input type="number" name="cash" min="0" max="500" step="50" value="250">
	<input type="submit" value="Пополнить счет">
</form>
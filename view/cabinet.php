<?php defined('COURSE') or exit('Acces denied');?>

<h2>Кабинет</h2>
<table class="table table-hover">
	<thead>
		<th>name</th>
		<th>license</th>
		<th>account</th>
		<th>phone</th>
	</thead>
	<tbody>
		<tr>
			<td><?=$cabinet['name']?></td>
			<td><?=$cabinet['license']?></td>
			<td><?=$cabinet['account']?></td>
			<td><?=$cabinet['phone']?></td>
		</tr>
	</tbody>
</table>

<form action="?view=add_cash" method="POST">
	<div class="form-group col-md-2">
		<input class="form-control" type="number" name="cash" min="0" max="500" step="50" value="250">
	</div>
	<input type="submit" class="btn btn-primary" value="Пополнить счет">
</form>
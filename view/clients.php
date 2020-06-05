<?php defined('COURSE') or exit('Acces denied');?>

<h2>Клиенты</h2>
<table class="table table-hover">
	<thead>
		<th>name</th>
		<th>license</th>
		<th>account</th>
		<th>phone</th>
		<th>banned</th>
	</thead>
	<tbody>
		<?php foreach ($clients as $client): ?>
			<tr>
				<td><?=$client['name']?></td>
				<td><?=$client['license']?></td>
				<td><?=$client['account']?></td>
				<td><?=$client['phone']?></td>
				<td><?=($client['banned']) ? 'Да' : 'Нет'?></td>
				<td>
					<form action="" method="POST">
						<input type="hidden" name="name" value="<?=$client['name']?>">
						<input type="submit" class="btn <?=($client['banned']) ? 'btn-primary' : 'btn-danger'?>" value="<?=($client['banned']) ? 'Разблокировать' : 'Заблокировать' ?>">
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
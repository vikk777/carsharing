<?php defined('COURSE') or exit('Acces denied');?>

<table>
	<tr>
		<td>name</td>
		<td>license</td>
		<td>account</td>
		<td>phone</td>
		<td>banned</td>
	</tr>
	<?php foreach ($clients as $client): ?>
		<tr>
			<td><?=$client['name']?></td>
			<td><?=$client['license']?></td>
			<td><?=$client['account']?></td>
			<td><?=$client['phone']?></td>
			<td><?=$client['banned']?></td>
			<td>
				<form action="" method="POST">
					<input type="hidden" name="name" value="<?=$client['name']?>">
					<input type="submit" value="<?=($client['banned']) ? 'Разблокировать' : 'Заблокировать' ?>">
				</form>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
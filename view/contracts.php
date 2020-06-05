<?php defined('COURSE') or exit('Acces denied');?>

<?php if (!empty($contracts)): ?>
	<table>
		<tr>
			<td>id</td>
			<td>client</td>
			<td>employe</td>
			<td>car</td>
			<td>begin date</td>
			<td>expire date</td>
			<td>expired</td>
		</tr>
		<?php foreach ($contracts as $contract): ?>
			<tr>
				<td><?=$contract['id']?></td>
				<td><?=$contract['client']?></td>
				<td><?=$contract['employe']?></td>
				<td><?=$contract['car']?></td>
				<td><?=strftime('%d-%m-%Y', $contract['date_begin'])?></td>
				<td><?=strftime('%d-%m-%Y', $contract['date_end'])?></td>
				<td><?=($contract['expired']) ? 'Да' : 'Нет' ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php else: ?>
	<h1>Нет договоров</h1>
<?php endif; ?>
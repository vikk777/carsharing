<?php defined('COURSE') or exit('Acces denied');?>

<h2>Договоры</h2>
<?php if (!empty($contracts)): ?>
	<table class="table table-hover">
		<thead>
			<th>id</th>
			<th>client</th>
			<th>employe</th>
			<th>car</th>
			<th>begin date</th>
			<th>expire date</th>
			<th>expired</th>
		</thead>
		<tbody>
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
		</tbody>
	</table>
<?php else: ?>
	<h1>Нет договоров</h1>
<?php endif; ?>
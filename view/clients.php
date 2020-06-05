<?php defined('COURSE') or exit('Acces denied');?>

<table>
	<tr>
		<td>name</td>
		<td>license</td>
		<td>account</td>
		<td>phone</td>
	</tr>
	<?php foreach ($clients as $client): ?>
		<tr>
			<td><?=$client['name']?></td>
			<td><?=$client['license']?></td>
			<td><?=$client['account']?></td>
			<td><?=$client['phone']?></td>
		</tr>
	<?php endforeach; ?>
</table>
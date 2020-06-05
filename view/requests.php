<?php defined('COURSE') or exit('Acces denied');?>

<?php if (!empty($requests)): ?>
	<table>
		<tr>
			<td>id</td>
			<td>client</td>
			<td>date</td>
			<td>car</td>
			<td>status</td>
		</tr>
		<?php foreach ($requests as $request): ?>
			<tr>
				<td><?=$request['id']?></td>
				<td><?=$request['client']?></td>
				<!-- <td><?=$request['date']?></td> -->
				<td><?=strftime('%d-%m-%Y %H:%m:%S', $request['date'])?></td>
				<td><?=$request['car']?></td>
				<td><?=$request['status']?></td>
				<?php if ($_SESSION['role'] == 1 and $request['status'] == 'wait'): ?>
					<td>
						<form action="?view=accept_request" method="POST">
							<input type="hidden" name="id" value="<?=$request['id']?>">
							<input type="hidden" name="client" value="<?=$request['client']?>">
							<input type="hidden" name="employe" value="<?=$_SESSION['name']?>">
							<input type="hidden" name="car" value="<?=$request['car']?>">
							<input type="submit" value="Принять">
					</form>
					</td>
					<td>
						<form action="?view=discard_request" method="POST">
							<input type="hidden" name="id" value="<?=$request['id']?>">
							<input type="submit" value="Отклонить">
						</form>
					</td>
				<?php endif ?>
			</tr>
		<?php endforeach; ?>
	</table>
<?php else: ?>
	<h1>Нет заявок</h1>
<?php endif; ?>
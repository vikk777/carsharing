<?php defined('COURSE') or exit('Acces denied');?>

<h2>Заявки</h2>
<?php if (!empty($requests)): ?>
	<table class="table table-hover">
		<thead>
			<th>id</th>
			<th>client</th>
			<th>date</th>
			<th>car</th>
			<th>status</th>
		</thead>
		<tbody>
			<?php foreach ($requests as $request): ?>
				<tr>
					<td><?=$request['id']?></td>
					<td><?=$request['client']?></td>
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
								<input type="submit" class="btn btn-primary" value="Принять">
						</form>
						</td>
						<td>
							<form action="?view=discard_request" method="POST">
								<input type="hidden" name="id" value="<?=$request['id']?>">
								<input type="submit" class="btn btn-danger" value="Отклонить">
							</form>
						</td>
					<?php else: ?>
						<td></td>
						<td></td>
					<?php endif ?>
				</tr>
		</tbody>
		<?php endforeach; ?>
	</table>
<?php else: ?>
	<h1>Нет заявок</h1>
<?php endif; ?>
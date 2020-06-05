<?php defined('COURSE') or exit('Acces denied');?>

<?php if (!empty($cars)): ?>
	<table>
		<tr>
			<td>id</td>
			<td>type</td>
			<td>model</td>
			<td>color</td>
			<td>price</td>
			<td>image</td>
			<?php if ($_SESSION['role'] == 1): ?>
				<td>aviable</td>
			<?php endif ?>
		</tr>
		<?php foreach ($cars as $car): ?>
			<tr>
				<td><?=$car['id']?></td>
				<td><?=$car['type']?></td>
				<td><?=$car['model']?></td>
				<td style="background: <?=$car['color']?>">&nbps;</td>
				<td><?=$car['price']?></td>
				<td>
					<img src="<?=$car['img']?>" alt="">
					<p></p>
				</td>
				<?php if ($_SESSION['role'] == 1): ?>
					<td><?=($car['aviable']) ? 'Да' : 'Нет'?></td>
				<?php endif ?>
				<?php if ($_SESSION['role'] == 2): ?>
					<td>
						<form action="?view=add_request" method="POST">
							<input type="hidden" name="client" value="<?=$_SESSION['name']?>">
							<input type="hidden" name="car" value="<?=$car['id']?>">
							<input type="submit" value="Подать заявку">
						</form>
					</td>
				<?php endif; ?>
			</tr>
		<?php endforeach; ?>
	</table>
<?php else: ?>
	<h1>Нет доступных автомобилей</h1>
<?php endif; ?>

<?php if ($_SESSION['role'] == 1): ?>
	<h2>Добавление автомобиля</h2>
	<form enctype="multipart/form-data" action="" method="POST">
		<p>
			<label for="id">Номер авто</label>
			<input type="text" name="id" placeholder="000000" required></p>
		<p>
			<label for="type">Тип</label>
			<select name="type">
				<?php foreach ($CAR_TYPES as $key => $value): ?>
					<option value="<?=$key?>"><?=$value?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label for="id">Модель</label>
			<input type="text" name="model" placeholder="BMW X5" required>
		</p>
		<p>
			<label for="color">Цвет</label>
			<input type="color" name="color" required>
		</p>
		<p>
			<label for="price">Цена, руб.</label>
			<input type="number" min="500" step="100" name="price" required value="500"></p>
		<p>
			<label for="aviable">Доступна</label>
			<input type="checkbox" name="aviable" id="aviable" checked="true">
		</p>
		<p>
			<label for="img">Изображение</label>
			<input type="hidden" name="MAX_FILE_SIZE" value="100000">
			<input name="img" type="file">
		</p>
		
		<input type="submit" value="Добавить авто">
	</form>
<?php endif; ?>
<?php defined('COURSE') or exit('Acces denied');?>

<?php if (!empty($cars)): ?>
	<table>
		<tr>
			<td>id</td>
			<td>type</td>
			<td>model</td>
			<td>color</td>
			<td>price</td>
			<td>aviable</td>
		</tr>
		<?php foreach ($cars as $car): ?>
			<tr>
				<td><?=$car['id']?></td>
				<td><?=$car['type']?></td>
				<td><?=$car['model']?></td>
				<td style="background: <?=$car['color']?>">&nbps;</td>
				<td><?=$car['price']?></td>
				<td><?=($car['aviable']) ? 'Да' : 'Нет'?></td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php else: ?>
	<h1>Нет доступных автомобилей</h1>
<?php endif; ?>

<?php if ($_SESSION['role'] == 1): ?>
	<h2>Добавление автомобиля</h2>
	<form action="" method="POST">
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
		<p><input type="text" name="model" placeholder="Модель" required></p>
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
		
		<input type="submit" value="Добавить авто">
	</form>

	<?php if (!empty($_POST)): ?>
		<?php if (!isset($_SESSION['warning'])): ?>
			<p>Автомобиль успешно добавлен.</p>
		<?php else: ?>
			<p><?=$_SESSION['warning']?></p>
			<?php unset($_SESSION['warning']); ?>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
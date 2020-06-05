<?php defined('COURSE') or exit('Acces denied');?>

<h2>Автомобили</h2>

<?php if (!empty($cars)): ?>
		<?php foreach ($cars as $car): ?>
			<div class="row">
				<div class="col-sm-3 col-md-4 col-xs-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4><?=$car['model']?></h4>
						</div>
						<div class="no-padding panel-body">
							<img src="<?=$car['img']?>" class="img-responsive" alt="">
						</div>
						<table class="table table-bordered">
							<tr>
								<td>id</td>
								<td><?=$car['id']?></td>
							</tr>
							<tr>
								<td>type</td>
								<td><?=$car['type']?></td>
							</tr>
							<tr>
								<td>price</td>
								<td><?=$car['price']?></td>
							</tr>
							<tr>
								<td>color</td>
								<td><div class="color-box" style="background: <?=$car['color']?>"></div></td>
							</tr>
							<?php if ($_SESSION['role'] == 1): ?>
								<tr>
									<td>aviable</td>
									<td><?=($car['aviable']) ? 'Да' : 'Нет'?></td>
								</tr>
							<?php endif ?>
						</table>
						<?php if ($_SESSION['role'] == 2): ?>
							<div class="panel-footer text-center">
								<form action="?view=add_request" method="POST">
									<input type="hidden" name="client" value="<?=$_SESSION['name']?>">
									<input type="hidden" name="car" value="<?=$car['id']?>">
									<input type="submit" class="btn btn-primary" value="Подать заявку">
								</form>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
<?php else: ?>
	<h3>Нет доступных автомобилей</h3>
<?php endif; ?>



<?php if ($_SESSION['role'] == 1): ?>
	<br><br>
	<h4>Добавление автомобиля</h4>
	<form class="col-sm-4" enctype="multipart/form-data" action="" method="POST">
		<div class="form-group">
			<label for="id">Номер авто</label>
			<input class="form-control" type="text" name="id" placeholder="000000" required></div>
		<div class="form-group">
			<label for="type">Тип</label>
			<select class="form-control" name="type">
				<?php foreach ($CAR_TYPES as $key => $value): ?>
					<option value="<?=$key?>"><?=$value?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="id">Модель</label>
			<input class="form-control" type="text" name="model" placeholder="BMW X5" required>
		</div>
		<div class="form-group">
			<label for="color">Цвет</label>
			<input class="form-control" type="color" name="color" required>
		</div>
		<div class="form-group">
			<label for="price">Цена, руб.</label>
			<input class="form-control" type="number" min="500" step="100" name="price" required value="500"></div>
		<div class="form-group">
			<label for="aviable">Доступна
				<input type="checkbox" name="aviable" id="aviable" checked="true">
			</label>
		</div>
		<div class="form-group">
			<label for="img">Изображение</label>
			<input class="form-control" type="hidden" name="MAX_FILE_SIZE" value="100000">
			<input class="form-control" name="img" type="file">
		</div>
		
		<input type="submit" class="btn btn-primary form-control" value="Добавить авто">
	</form>
<?php endif; ?>
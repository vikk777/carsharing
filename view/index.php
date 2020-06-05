<?php  
	defined('COURSE') or exit('Acces denied');

	require_once 'inc/header.php';
?>

<?php if (!isset($_SESSION['error'])): ?>

	<div class="row">
		<?include $view.'.php';?>
	</div>
	<br><br>
	<div class="row">
		<?php if (isset($_SESSION['warning'])): ?>
		<div class="col-md-6 col-md-offset-2">
			<p class="alert alert-danger"><?php get_flashed(); ?></p>
		</div>
		<?php endif ?>
	</div>

<?php else: ?>
	<div class="row">
		<p class="alert alert-danger"><?=$_SESSION['error']?></p>
	</div>
	<?php unset($_SESSION['error']); ?>
<?php endif; ?>

</div> <!-- content -->
</div> <!-- fluid -->
<script src="<?=VIEW.'js/bootstrap.min.js'?>" crossorigin="anonymous"></script>
</body>
</html>
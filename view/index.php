<?php  
	defined('COURSE') or exit('Acces denied');

	require_once 'inc/header.php';
?>

<?php if (!isset($_SESSION['error'])): ?>

	<?include $view.'.php';?>
	<?php get_flashed(); ?>

<?php else: ?>
	<p><?=$_SESSION['error']?></p>
	<?php unset($_SESSION['error']); ?>
<?php endif; ?>

</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
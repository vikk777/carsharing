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
</body>
</html>
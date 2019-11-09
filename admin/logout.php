<?php require_once('../include/include.php'); ?>
<?php 
	$session->logout();
	redirect_to('login.php');
 ?>

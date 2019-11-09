<?php require_once('../include/include.php'); ?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php"); } ?>
<?php include('../include/header.php'); ?>



	<div class="main">
		<?php
		$user = User::find_by_id(1);
			//$user->id = 82;
		  	$user->firstname ="tej";
			$user->lastname="dahal";
			$user->username ="tej";
			$user->password ="tej123";
			$user->update();
		

		?>
	</div>
<?php include('../include/footer.php'); ?>

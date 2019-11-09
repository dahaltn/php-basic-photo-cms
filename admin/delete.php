<?php require_once('../include/include.php'); ?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php"); } ?>
<?php include('../include/header.php'); ?>



	<div class="main">
		<?php
		$user = User::find_by_id(28);
		$user->delete();
		echo $user->firstname." record has been successfully deleted";
			
		

		?>
	</div>
<?php include('../include/footer.php'); ?>

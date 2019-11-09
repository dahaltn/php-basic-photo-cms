<?php require_once('../include/include.php'); ?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php"); } ?>
<?php include('../include/header.php'); ?>



	<div class="main">
		<?php
		$user = new User();
		$user->firstname = "tejtej";
		$user->lastname = "dahal";
		$user->username = "test";
		$user->password = "test2";
		if($user->create()){
			echo $user->firstname ."<br />";
		echo $user->lastname	."<br />";
		echo $user->username ."<br />";
		echo $user->password ."<br />";
		}
			

		?>
	</div>
<?php include('../include/footer.php'); ?>

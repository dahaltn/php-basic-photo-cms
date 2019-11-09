<?php require_once('../include/include.php'); ?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php"); } ?>
<?php if(!isset($_GET['delete'])){
	$session->set_message("No photograph was provided to delete");
	redirect_to("gallery.php");
	} 
	?>


		<?php
			$photo = Photograph::find_by_id($_GET['delete']);
			if($photo && $photo->destroy()){
				$session->set_message("The photograph has been successfully deleted");
				redirect_to("gallery.php");
			}else{
				$session->set_message("couldnt deleted the photograph");
				redirect_to("gallery.php");
			}
		

		?>
	
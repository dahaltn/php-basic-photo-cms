<?php require_once('../include/include.php'); ?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php"); } ?>
<?php if(empty($_GET['comment_id'])){
	$session->set_message("No Comment was provided to delete");
	redirect_to("gallery.php");
	} 
	?>


		<?php
			$comment = Comment::find_by_id($_GET['comment_id']);
			if($comment && $comment->delete()){
				$session->set_message("The comment has been successfully deleted");
				redirect_to("image_comments.php?id=".$comment->photograph_id);
			}else{
				$session->set_message("couldnt deleted the comment");
				redirect_to("image_comments.php?id=".$comment->photograph_id);
			}
		

		?>
	
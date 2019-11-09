<?php require_once('../include/include.php'); ?>
<?php include_template('header.php'); ?>
<?php if(!isset($_GET['id'])){
	$session->set_message("No valid photograph was provided to view comment");
		redirect_to("gallery.php");
	} ?>

	<div class="main">
		<header class="header">
			<h1>Comments</h1>
			
		</header>
		<sidebar class="left-side">
			<h2>sidebar</h2>			
		
		</sidebar>

		<section class="content">
			
			<?php 	
			$images= Photograph::find_by_id($_GET['id']); 
			if(!$images){
			 $session->set_message("Couldnot find the images by id");
			 redirect_to('gallery.php');
			}
			if(count($images->comments())<1){
				$message = "No comment found";
			}
			
			?>

		<p><a href="gallery.php">Go back to gallery</a></p>
	
		<h3>Comments list</h3>
		<hr />
		<p>	<?php output_message($message); ?> </p>

		<?php 
			$comments = $images->comments();
			foreach ($comments as $comment):?>
			<p><strong>Author:</strong> <?php echo htmlentities($comment->author); ?></p>
			<p><strong>Comment Date:</strong> <?php echo timedate_format($comment->created); ?></p>
			<p><strong>Comment:</strong> <?php echo strip_tags($comment->body, '<strong><p><em>'); ?></p><hr />
			<p><strong><a onclick="return confirm('are you sure?')"href="delete_comment.php?comment_id=<?php echo $comment->id; ?>">Delete</a></strong></p><hr />

			<?php endforeach; ?>
	

		</div>
		<div class="comment_list">
			
		</div>
		



		</section>
		<div class="clearfix"></div>
	</div>
<?php include_template('footer.php'); ?>

<?php require_once('include/include.php'); ?>
<?php include_template('header.php'); ?>
<?php if(!isset($_GET['id'])){
	$session->set_message("No valid photograph was provided to view");
		redirect_to("index.php");
	} ?>

	<div class="main">
		<header class="header">
			<h1>welcome to my phpoop cms</h1>
			
		</header>
		<sidebar class="left-side">
			<h2>sidebar</h2>	
					<p><a href="index.php">Go back to gallery</a></p>		
		
		</sidebar>

		<section class="content">
			
			<?php 	
			$images= Photograph::find_by_id($_GET['id']); 
			if(!$images){
			 $session->set_message("Couldnot find the images by id");
			 redirect_to('index.php');
			}
			if(isset($_POST['submit'])){
				$author = trim($_POST['author']);
				$body  = trim($_POST['body']);
				$photo_id = $images->id;
				$new_comments = Comment::make($images->id, $author, $body);
				if($new_comments && $new_comments->save()){
					$message="Your comment has been saved";
				}else{
					$message="couldnt save your comment something went wrong";
				}
			}
			?>

		<p><a href="index.php">Go back to gallery</a></p>
		<div style="width:auto; height: auto;">
			
				<img class="full_images" src="<?php echo "upload/".$images->image_path(); ?>">

				<p><?php echo $images->caption;  ?></p>
		<div style="clear:both"> </div>
		<h3>Comments</h3>
		<hr />
		<p><?php 
			$comments = $images->comments();
			foreach ($comments as $comment):?>
			<p><strong>Author:</strong> <?php echo htmlentities($comment->author); ?></p>
			<p><strong>Comment Date:</strong> <?php echo timedate_format($comment->created); ?></p>
			<p><strong>Comment:</strong> <?php echo strip_tags($comment->body, '<strong><p><em>'); ?></p><hr />
			
			<?php endforeach; ?>
		</p>

		</div>
		<div class="comment_list">
			
		</div>
			<?php output_message($message); ?> 
		<form action="full_photo.php?id=<?php echo $images->id; ?>" method="POST" accept-charset="utf-8">
		<P><label for="author">Author: </label> <input type="text" name="author" value=""></P>	
		<P><label for="body">Body: </label> <textarea name="body" id="" cols="4" rows="5"></textarea></P>	
		<P> <input type="submit" name="submit" value="Post Comment"></P>	
		</form>



		</section>
		<div class="clearfix"></div>
	</div>
<?php include_template('footer.php'); ?>

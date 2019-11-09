<?php require_once('../include/include.php'); ?>
<?php if(!$session->is_logged_in()){redirect_to("index.php"); } ?>
<?php include_template('admin_header.php'); ?>
<?php 
	if(isset($_POST['submit'])){
		$photograph = new Photograph();
		$photograph->caption = $_POST['caption'];
		$photograph->attach_file($_FILES['upload']);
		
		// var_dump($_FILES['upload']['error']);
		// var_dump($photograph->save());
		
		if($photograph->save()){
			$session->set_message("Successfully Uploaded {$upload_file_name}");
			redirect_to('gallery.php');		
		}else{
			$message = implode("<br />",$photograph->errors);
		}
	}

?>


<?php $max_file_size = 1000000; ?>

<div class="main">
		<header class="header">
			<h1>welcome gallery</h1>			
		</header>
		<sidebar class="left-side">
			<h2>sidebar</h2>	
			<ul>
				<li><a href="log.php">View Logs</a></li>
				<li><a href="gallery.php">Manage Gallery</a></li>
				<li><a href="upload.php">Upload Image</a></li>
				<li><a href="logout.php">Log Out</a></li>
				<hr />
				<li><a href="logout.php">Log Out</a></li>



			</ul>		
		
		</sidebar>

		<section class="content">
		<?php  output_message($message);  ?>
<form action="upload.php" enctype="multipart/form-data" method="POST">
	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>">
	<p><label for="upload" class="upload">Select Image:</label>
	<input type="file" name="upload"></p>
	
	<p><label for="caption">Caption: </label> <input type="text" name="caption"></p>

	<input type="submit" name="submit" value="Upload">

</form>
<ul>
		<li><a href="log.php">View Logs</a></li>
		<li><a href="logout.php">Log Out</a></li>
	</ul>

		</section>
		<div class="clearfix"></div>
	</div>
<hr/>
<?php include_template('admin_footer.php'); ?>

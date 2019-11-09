<?php require_once('../include/include.php'); ?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php"); } ?>
<?php include_template('admin_header.php'); ?>
<?php 	$log_file = ROOT."logs".DS."log.txt"; ?>
<?php if(isset($_GET['clear']) && $_GET['clear']==true){
		file_put_contents($log_file, '');
		log_entry($session->user_id, " log has been cleared\r\n");
		redirect_to('log.php');
	} ?>
	<div class="main">
		<header class="header">
			<h1>Log list</h1>			
		</header>
		<sidebar class="left-side">
			<h2>sidebar</h2>			
		<ul>
				<li><a href="log.php">View Logs</a></li>
				<li><a href="gallery.php">Manage Gallery</a></li>
				<li><a href="upload.php">Upload Image</a></li>
				<li><a href="logout.php">Log Out</a></li>
				<hr />
				<li><a href="../index.php">back to Public site</a></li>



			</ul>
		</sidebar>

		<section class="content">
				<h3>	Log file list</h3>
				<p><a href="index.php">Back to Admin page</a></p>
		<a href="log.php?clear=true" onclick="return confirm('are you sure you want to clear Log?')">Clear Log</a>
		<?php
		if(file_exists($log_file) && is_readable($log_file) && $handle=fopen($log_file, 'r')){
		 echo "<ul>";
		 while (!feof($handle)){
		 	$entry = fgets($handle);
		 	echo "<li>".$entry."</li>";
		 } 
		 echo "</ul>";
		}

		?>

		</section>
		<div class="clearfix"></div>
	</div>


<?php include_template('admin_footer.php'); ?>

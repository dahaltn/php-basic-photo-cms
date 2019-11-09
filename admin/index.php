<?php require_once('../include/include.php'); ?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php"); } ?>
<?php include_template('admin_header.php'); ?>
<?php //unset($_SESSION['u_id']); ?>


	<div class="main">
		<header class="header">
			<h1>welcome to my phpoop cms</h1>			
		</header>
		<sidebar class="left-side">
			<h2>sidebar</h2>
			<ul>
				<li><a href="log.php">View Logs</a></li>
				<li><a href="gallery.php">Manage Gallery</a></li>
				<li><a href="upload.php">Upload Image</a></li>
				<li><a href="logout.php">Log Out</a></li>
				<hr/>	
				<li><a href="../index.php">View Gallery</a></li>


			</ul>		
		
		</sidebar>

		<section class="content">
			
			<ul>
				<li><a href="log.php">View Logs</a></li>
				<li><a href="gallery.php">Manage Gallery</a></li>
				<li><a href="upload.php">Upload Image</a></li>
				<li><a href="logout.php">Log Out</a></li>


			</ul>			
		

		</section>
		<div class="clearfix"></div>
	</div>
<?php include_template('admin_footer.php'); ?>

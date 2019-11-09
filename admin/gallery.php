<?php require_once('../include/include.php'); ?>
<?php if(!$session->is_logged_in()){ redirect_to("login.php"); } ?>
<?php include_template('admin_header.php'); ?>
<?php //unset($_SESSION['u_id']); ?>
<?php 
//if no page is in url set page =1 
$page = !empty($_GET['page'])? (int)$_GET['page'] : 1;
//pagination number of record per page
$per_page = 2;

//count all the number of images
$total_count= Photograph::count_all();  
 
$pagination = new Pagination($page, $per_page, $total_count);
$sql = "SELECT * FROM Photographs ORDER BY id DESC ";
$sql .= "LIMIT {$per_page} ";
$sql .= " OFFSET {$pagination->offset()}";

$images = Photograph::find_by_sql($sql);
 

 ?>

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
				<li><a href="../index.php">back to Public site</a></li>



			</ul>
		</sidebar>

		<section class="content">
			<?php 
			output_message($message);			
			
			$html ="<table>";
			$html .="<tr><td>Image</td><td>type</td><td>Caption</td><td>size</td><td>Comments</td></tr>";
			foreach ($images as $value) {
					$html .= "<tr><td><img src=\"../upload/".$value->image_path()."\" style =\"width:100px; height:auto;\" alt=\"".$value->caption."\"></td>";
					$html .= "<td>".$value->type."</td>";
					$html .= "<td>".$value->caption."</td>";
					$html .= "<td>".$value->size_as_text()."</td>";
					$html .= "<td><a href=\"image_comments.php?id=".$value->id."\">".count($value->comments())." View Comment</a></td></tr>";
					$html .= "<td><a onclick=\"return confirm('Are you sure your want to delete?')\" href=\"delete_image.php?delete=".$value->id."\">Delete</a></td></tr>";
				}	
			$html .="</table>";	
			echo $html;	
			
			?>
	<?php  
		if($pagination->total_page()>1){
			if($pagination->has_previous_page()){
				echo "<a href=\"gallery.php?page=";
				echo $pagination->previous_page()."\">Previous..</a>";
				
			}
			
			$page_number="";
			for ($i=1; $i <=$pagination->total_page(); $i++) { 
			 $page_number .= " <a href=\"gallery.php?page=".$i."\" ";
			 $page_number .= $page==$i?"class=\"current\"":null;
			 $page_number .= " > ".$i." </a> ";
			}
			echo $page_number;

			if($pagination->has_next_page()){
				echo "<a href=\"gallery.php?page=";
				echo $pagination->next_page()."\">Next..</a>";

			}


		}


	?>

		</section>
		<div class="clearfix"></div>
	</div>
	<?php include_template('admin_footer.php'); ?>		

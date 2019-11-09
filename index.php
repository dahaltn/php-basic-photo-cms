<?php require_once('include/include.php'); ?>
<?php include_template('header.php'); ?>

<?php
//if no page is in url set page =1 
$page = !empty($_GET['page'])? (int)$_GET['page'] : 1;
//pagination number of record per page
$per_page = 6;

//count all the number of images
$total_count= Photograph::count_all();  
 
$pagination = new Pagination($page, $per_page, $total_count);
$sql = "SELECT * FROM photographs ORDER BY id DESC ";
$sql .= "LIMIT {$per_page}  ";
$sql .= " OFFSET {$pagination->offset()}";

$images = Photograph::find_by_sql($sql);
 

?>
	<div class="main">
		<header class="header">
			<h1>welcome to my phpoop cms</h1>
			
		</header>
		<sidebar class="left-side">
			<h2>sidebar</h2>
			<ul>
							<li><a href="admin/login.php">Go to Admin Page</a></li>
						</ul>			
		
		</sidebar>

		<section class="content">
			
			<?php 
			output_message($message);
			//$images= Photograph::find_all();  
			
			$html ="";
			//$html .="<tr><td>Image</td></tr>";
			$count =count($images);
			foreach ($images as $value):
				

					$html .= "<div style=\"width:200px; padding:10px; float: left; overflow:hidden;\"><a href=\"full_photo.php?id=".$value->id."\"><img src=\"upload/".$value->image_path()."\" style =\"width:180; height:200px;\" alt=\"".$value->caption."\"></a><p>".$value->caption."</p></div>";
				
				

		endforeach;
					
					
			echo $html;	

			?>

<div style="clear:both"> </div>
<?php  
		if($pagination->total_page()>1){
			if($pagination->has_previous_page()){
				echo "<a href=\"index.php?page=";
				echo $pagination->previous_page()."\">Previous..</a>";
				
			}
			$count_page = $pagination->total_page();
			$page_number="";
			for ($i=1; $i <=$count_page; $i++) { 
			 $page_number .= "<a href=\"index.php?page=".$i."\" ";
			 $page_number .= $page==$i?"class=\"current\"":null;
			 $page_number .= " > ".$i." </a>";
			}
			echo $page_number;

			if($pagination->has_next_page()){
				echo "<a href=\"index.php?page=";
				echo $pagination->next_page()."\">Next..</a>";

			}


		}


	?>




		</section>
		<div class="clearfix"></div>
	</div>
<?php include_template('footer.php'); ?>

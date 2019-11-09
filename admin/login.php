<?php require_once('../include/include.php'); ?>

<?php if($session->is_logged_in()){redirect_to("index.php"); } ?>
<?php include_template('header.php'); ?>

<?php 
if(isset($_POST['submit'])){
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	function validate($fields){
		$errors = array(); 
		foreach ($fields as $field_name => $field_rules) {
			foreach($field_rules as $field_rule=>$field_rule_value){
				if($field_rule==='required' && empty($_POST[$field_name])){
					$errors[] = ucfirst($field_name). " is required";
				}elseif(!empty($_POST[$field_name])){
					if($field_rule==='max'){
						if($_POST[$field_name]>$field_rule_value){
							$errors[] = ucfirst($field_name)." must be less than ".$field_rule_value;
						}
					}
				}
			}
		}
	return $errors;
	}

$fields = array(
	'username'=>array(
		'required'=>true,	
		'max'=>25,
		'min'=>2
		),
	'password'=>array(
		'required'=>true,	
		'max'=>30,
		'min'=>2
		)
	);	
$errors = validate($fields);
$errors_output = "";

if(empty($errors)){
	$found_user = User::authonicated($username, $password);
		if($found_user){
		$session->login($found_user);
		log_entry($found_user->username, " has been login from ".$_SERVER['REMOTE_ADDR']."\r\n");
		redirect_to("index.php");
	}else{
		$message = "Username or password did not matched, please try again";
	}
}else{
		foreach ($errors as $error) {
			$errors_output .= "<p>".$error."<p/>";
		}
}
	



}else{
	$username = "";
	$password = "";
	$message = "";
	$errors_output = "";

}

 ?>

	<div class="main">
		<header class="header">
			<h1>welcome to my phpoop cms</h1>
		</header>
		<sidebar class="left-side">
			<h2>sidebar</h2>
			<ul>
							<li><a href="../index.php">Go to Public page</a></li>
						</ul>			
		
		</sidebar>

		<section class="content">
			<?php echo output_message($message); ?>
			<?php echo	$errors_output; ?>		
		<table>
		<form action="login.php" method="post">
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username" value=""></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="password" value=""></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Login"></td>
			</form>
				</tr>
			</table>

		</section>
		<div class="clearfix"></div>
	</div>
<?php include_template('footer.php'); ?>

<?php require_once('../include/include.php'); ?>
<?php 


if(isset($_POST['submit'])):
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$email    = trim($_POST['email']);
$info	  = trim($_POST['info']);

$register = new register();
$register->create();


$fields = array(
		"username"=>array(
			"max"=>10,
			"min"=>4,
			"require"=>true,
			"unique"=>true

						),
		"password"=>array(
			"max"=>10,
			"min"=>2,
			"require"=>true
			),
		"email"=>array(
			"require"=>true,
			"preg_match"=>"email",
			"unique"=>true
			),
		"password2"=>array(
			"match"=>"password"
			
			),

		"info"=>array(
			"require"=>true
			)
		);


	$validation = new validation();
	$passed = $validation->form_validate($fields)->passed();
	if($passed):
		
	$fields = array("username"=>$username, "password"=>$password, "email"=>$email, "info"=>$info);
	echo $dBase->insert($fields)->result();

	else:

		$errors = $validation->formErrors();
		display_errors($errors);
		
		endif;


endif;



?>



<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<p><label for="email">Email: </label> <input type="text" name="email" value="" placeholder="please give your email"></p>
<p><label for="username">User Name: </label> <input type="text" name="username" value="" placeholder="please give your username"></p>
<p><label for="password">Password: </label> <input type="password" name="password" placeholder="please give your Password"></p>
<p><label for="password2">Re Password: </label> <input type="password" name="password2" placeholder="please retype your Password"></p>
<p><label for="info">Info: </label> <textarea name="info" id="info" cols="20" rows="10"></textarea>

<p><input type="submit" name="submit" value="Register"></p>
<p>&nbsp </p>
<p>are you already Registered? <a href="login.php">Click here to Login</a></p>	

</form>
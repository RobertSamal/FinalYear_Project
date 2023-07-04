<?php
session_start();
require_once('../class.user.php');

// Create an instance of the USER class
$user = new USER();


// If the user is already logged in, redirect to the admin page
if($user->is_loggedin()!="")
{
	$user->redirect('../admin/admin.php');
}

// Check if the 'btn-signup' button is clicked
if(isset($_POST['btn-signup']))
{
	// Get the values from the input fields and strip any HTML tags
	$uname = strip_tags($_POST['txt_uname']);
	$umail = strip_tags($_POST['txt_umail']);
	$upass = strip_tags($_POST['txt_upass']);
	$upass_confirm = strip_tags($_POST['txt_upass_confirm']);

	// Validate the input fields
	if($uname=="")	{
		$error[] = "<b><font color='red'>provide username !</font></b>";
	}
	else if($umail=="")	{
		$error[] = "<b><font color='red'>provide email id !";
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{  // name@example.com
	    $error[] = "<b><font color='red'>Please enter a valid email address !</font></b>";
	}
	else if($upass=="")	{
		$error[] = "<b><font color='red'>provide password !</font></b>";
	}
	else if(strlen($upass) < 8){
		$error[] = "<b><font color='red'>Password must be at least 8 characters</font></b>";
	}
	else if($upass != $upass_confirm){
		$error[] = "<b><font color='red'>Passwords do not match !</font></b>";
	}
	else if (is_numeric($uname) || ctype_punct($uname)) { //is_numeric() is a function that checks if the username is pure numbers and ctype_punct() is a function which checks if the username is pure symbols
		$error[] = "<b><font color='red'>Username cannot be pure numbers or symbols</font></b>";
	}
	else
	{
		try
		{
			// Prepare and execute a database query to check if the username or email is already taken
			$stmt = $user->runQuery("SELECT user_name, user_email FROM users WHERE user_name=:uname OR user_email=:umail");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);


			// If the username is already taken, display an error message
			if($row['user_name']==$uname) {
				$error[] = "<b><font color='red'>sorry username already taken !</font></b>";
			}


			// If the email is already taken, display an error message
			else if($row['user_email']==$umail) {
				$error[] = "<b><font color='red'>sorry email id already taken !</font></b>";
			}


			else
			{
				// Register the user and redirect to the sign-up page with a 'joined' parameter
				if($user->register($uname, $umail, $upass, $upass_confirm)){
					$user->redirect('sign-up.php?joined');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign up page</title>
<link rel="icon" href="../img/gymlogo.png" type="image/png">
<link rel="stylesheet" href="../style/style.css" type="text/css"  />
</head>
<body>

<div id="main2">


	<form method="post" >
		<h1>Sign up.</h1>
		<?php
		if(isset($error))
		{
			// If there are any errors, iterate through each error and display an alert box for each error
			foreach($error as $error)
			{
				?>
				<div class="alert alert-danger">
					<i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
				</div>
				<?php
			}
		}
		else if(isset($_GET['joined']))
		{
			?>
			<div class="alert alert-info">
				<i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='login.php'>login</a> here
			</div>
			<?php
		}
		?>

		<input type="text" class="form-control" name="txt_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>" />
		<input type="text" class="form-control" name="txt_umail" placeholder="Enter Email" value="<?php if(isset($error)){echo $umail;}?>"/>
		<input type="password" class="form-control" name="txt_upass" placeholder="Enter Password" />
		<input type="password" class="form-control" name="txt_upass_confirm" placeholder="Confirm Password" />
		<input value="SIGN UP" type="submit" class="button" name="btn-signup">


		<p>have an account ! <a href="login.php">SIGN IN</a> or go <a href="../index.php">HOME</a></p>
	</form>


</div>

</body>
</html>

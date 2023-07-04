<?php
    
	// Including necessary files and starting the session
	require_once("../session.php");
	require_once("../class.user.php");
	$auth_user = new USER();

    // Getting the user ID from the session
	$user_id = $_SESSION['user_session'];

    // Querying the database to fetch user information
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));

	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    $id = $userRow['user_id'];

	// Checking if the user ID is equal to 1 (admin)
	if ($id == 1){
		// Admin user, no action needed
	}

	else{
		// Redirecting non-admin users to the home page
		header("location: ../member/home.php");
	}

	// Checking if the user session is not set (user not logged in)
	if(!$_SESSION['user_session']){

        // Redirecting to the denied page
		header("location: ../login/denied.php");
	}

?>


<?php

// Including the database configuration file
include_once '../connection/dbconfig.php';

if(isset($_GET['uid']))
{
	$id = $_GET['uid']; // Getting the value of 'uid' from the GET request
	$stmt=$db_con->prepare("SELECT * FROM users WHERE user_id=:uid");
	$stmt->execute(array(':uid'=>$id)); // Executing the prepared statement by binding the value of 'uid'

	$row=$stmt->fetch(PDO::FETCH_ASSOC);// Fetching a single row and storing it in the 'row' variable
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Edit</title>
<link rel="icon" href="../img/gymlogo.png" type="image/png">
<link href="../style/style.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="main2">

	 <form method='post' action="uupdate.php">
    <table class='table table-bordered'>

<tr>
	    <td colspan="2"><h1>Edit User's Information </h1></td>
</tr>


	<input type='hidden' name='uid' value="<?php echo $row['user_id']; ?>" />

<tr>
				<td>Name</td>
				<td><input type='text' name='muname' value="<?php echo $row['user_name']; ?>" class='form-control' placeholder='' /></td>
		</tr>
		<tr>
				<td>Email</td>
				<td><input type='text' name='ue'  value="<?php echo $row['user_email']; ?>"  class='form-control' placeholder='' ></td>
		</tr>
		<tr>
				<td>Date</td>
				<td><input type='text' name='jd'  value="<?php echo $row['joining_date']; ?>"  class='form-control' placeholder='' ></td>
		</tr>

			<tr>

            <td></td><td>
            <button type="submit" name="uupdate" class="button" >UPDATE
			</button>

            </td>
        </tr>

    </table>
</form>
</div>
</body>
</html>

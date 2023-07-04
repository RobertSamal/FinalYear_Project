<?php
    
	// Include the necessary files
	require_once("../session.php");
	require_once("../class.user.php");

	// Create a new instance of the USER class
	$auth_user = new USER();

    // Get the user ID from the session
	$user_id = $_SESSION['user_session'];


	// Fetch the user details from the database
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
// Include the database configuration file
require_once '../connection/dbconfig.php';


	if(isset($_POST['name']))
	{
        // Get the form data
        $myid = $_POST['myid'];
		$name = $_POST['name'];
		$sts = $_POST['sts'];
		$email =  $_POST['email'];
		$cdate = $_POST['cdate'];
		$mobile = $_POST['mobile'];
	    $addr = $_POST['addr'];
	   $ordr = $_POST['ordr'];
	   $weight = $_POST['weight'];
       $height = $_POST['height'];
       $age = $_POST['age'];

       // Prepare the update query
	   $stmt = $db_con->prepare("UPDATE ordrs SET  name=:en,
sts=:st, email=:em,  cdate=:cd, mobile=:mb, addr=:ad, ordr=:rdr, weight=:wt, height=:ht, age=:ag WHERE myid=:myid");

        // Bind the parameters
		$stmt->bindParam(":en", $name);
		$stmt->bindParam(":st", $sts);
		$stmt->bindParam(":em", $email);
		$stmt->bindParam(":cd", $cdate);
		$stmt->bindParam(":ad", $addr);
		$stmt->bindParam(":rdr", $ordr);
		$stmt->bindParam(":mb", $mobile);
		$stmt->bindParam(":myid", $myid);
		$stmt->bindParam(":wt", $weight);
        $stmt->bindParam(":ht", $height);
        $stmt->bindParam(":ag", $age);


		if($stmt->execute())
		{
			echo "<p>Order Successfully updated<p>";
		}
		else{
			echo "Query Problem";
		}
	}

?>

<?php

	require_once("../session.php");

	require_once("../class.user.php");
	$auth_user = new USER();

    // Get the user ID from the session
	$user_id = $_SESSION['user_session'];
    
	// Fetch the user details from the database
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));

	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Access Denied</title>
<link rel="icon" href="../img/gymlogo.png" type="image/png">
<link rel="stylesheet" href="../style/style.css" type="text/css"  />
</head>
<body>



	<div id="main2">

		<h1><font color='green'>Congratulation!</font></h1>

     <p><b>Order Successfully Updated.</b></p>


		<p><a href="order.php" ><button class="button" >Back</button</a>
</p>
        </div>







</body>
</html>

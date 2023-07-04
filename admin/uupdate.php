
<?php

// Include the database configuration file
require_once '../connection/dbconfig.php';


	if(isset($_POST['uupdate']))
	{
        // Retrieve form data
        $uid = $_POST['uid'];
		$muname = $_POST['muname'];
		$ue = $_POST['ue'];
		$jd =  $_POST['jd'];

        // Prepare the SQL statement to update user data
		$stmt = $db_con->prepare("UPDATE users SET user_name=:mun,user_email=:ue, joining_date=:jd WHERE user_id=:uid");

    // Bind the form data to the prepared statement parameters
    $stmt->bindParam(":mun", $muname);
	$stmt->bindParam(":ue", $ue);
 	$stmt->bindParam(":jd", $jd);
	$stmt->bindParam(":uid", $uid);
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Update</title>
<link rel="icon" href="../img/gymlogo.png" type="image/png">
<link rel="stylesheet" href="../style/style.css" type="text/css"  />
</head>
<body> 

<?php
	if($stmt->execute()) //if the conditions above are correct, it is a success
	{
		echo '<div id="main2">

									<h1><font color="green">Congratulati on!</font></h1>

	               <p><b>User Successfully Updated.</b></p>


									<p><a href="user.php" ><button class="button" >Back</button</a>
	</p>
	        </div>';
	}
	else{
		echo "Query Problem";
	}
	}

	?>


</body>
</html>

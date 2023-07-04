<?php

	require_once("../session.php");// Include the session handling file.

	require_once("../class.user.php");// Include the session handling file.
	$auth_user = new USER(); // Create a new instance of the USER class.


	$user_id = $_SESSION['user_session'];// Get the user ID from the session.

	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id"); // Prepare a database query to fetch user details.

	$stmt->execute(array(":user_id"=>$user_id)); // Execute the query with the user ID parameter.

	$userRow=$stmt->fetch(PDO::FETCH_ASSOC); // Fetch the user details and store them in $userRow variable.
    $id = $userRow['user_id']; // Extract the user ID from $userRow

    // Check if the user ID is equal to 1 (admin)
	if ($id == 1){ 
		// If the condition is true, do nothing.
	}

	else{
		header("location: ../member/home.php"); // Redirect the user to the home page.
	}

	if(!$_SESSION['user_session']){ // Check if the user session is not set.

		header("location: ../login/denied.php");// Redirect the user to the denied login page.
	}

?>

<?php
include_once '../connection/dbconfig.php';

if(isset($_GET['pid'])) // Check if the 'pid' parameter is set in the GET request.

{
	$id = $_GET['pid']; // Get the value of 'pid' parameter.

	$stmt=$db_con->prepare("SELECT * FROM product WHERE pid=:pid"); // Prepare a database query to fetch product details.
	$stmt->execute(array(':pid'=>$id)); // Execute the query with the product ID parameter.
	$row=$stmt->fetch(PDO::FETCH_ASSOC); // Fetch the product details and store them in $row variable.
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Prdoduct Edit</title>
<link rel="icon" href="../img/gymlogo.png" type="image/png">
<link href="../style/style.css" rel="stylesheet" type="text/css">

</head>

<body>


    <div id="main2">
	 <form method='post' action="pupdate.php">

    <table class='table table-bordered'>


<tr>
	    <td colspan="2"><h1>Edit Information </h1></td>
</tr>
<tr>
<td>Product ID</td>
<td>
	<input type='text' name='pid' value="<?php echo $row['pid']; ?>" />

	<input type='hidden' name='img' value="<?php echo $row['img']; ?>" />


</td>


</tr>
<tr>
				<td>Name</td>
				<td><input type='text' name='name' value="<?php echo $row['name']; ?>" class='form-control' placeholder='' /></td>
		</tr>
		<tr>
				<td>Description</td>
				<td><input type='text' name='des'  value="<?php echo $row['des']; ?>"  class='form-control' placeholder='' ></td>
		</tr>
		<tr>
				<td>Price</td>
				<td><input type='text' name='pr'  value="<?php echo $row['pr']; ?>"  class='form-control' placeholder='' ></td>
		</tr>


		<tr>
				<td>Date</td>
				<td><input type='text' name='cdate' value="<?php echo $row['cdate']; ?>"  class='form-control' placeholder='' ></td>
		</tr>


			<tr>

            <td></td><td>
            <button type="submit" class="button" >Save Updates
			</button>

            </td>
        </tr>

    </table>
</form>
</div>
</body>
</html>

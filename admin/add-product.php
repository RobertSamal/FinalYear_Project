<?php

	require_once("../session.php");

	require_once("../class.user.php");
	$auth_user = new USER();

    // Getting the user ID from the session
	$user_id = $_SESSION['user_session'];


    // Running a database query to fetch user data based on the user ID
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));

	// Fetching the user data as an associative array
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
  $id = $userRow['user_id'];

    // Checking if the user ID is equal to 1 (ADMIN)
	if ($id == 1){
	}

	else{
		header("location: ../member/home.php");
	}

    //if not Admin then deny access
	if(!$_SESSION['user_session']){

		header("location: ../login/denied.php");
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add New Food</title>
<link rel="icon" href="../img/gymlogo.png" type="image/png">
<link rel="stylesheet" href="../style/style.css" type="text/css"  />
</head>
<body>

	<div id="main2">
	 <form method='post'  action="create.php"  enctype="multipart/form-data">

    <table class='table table-bordered'>

		<tr>
				<td colspan="2">	<h1> Add New Food</h1></td>
		</tr>


		<tr>
			    <td>Food Image</td>
				<td >  <input type="file" name="fileToUpload" id="fileToUpload"></td>
		</tr>



        <tr>
            <td>Name</td>
            <td><input type='text' name='name'  placeholder='' required /></td>
        </tr>

  <input type='hidden' name='cdate'  value="<?php echo date('Y-m-d'); ?>" class='form-control' placeholder='' >


		<tr>
						<td>Description</td>
						<td><textarea type='text' name='des' placeholder='Add Description' ></textarea></td>
				</tr>
				<tr>
						<td>Calories</td>
						<td><input type='text' name='pr' class='form-control' placeholder='Add Price'>
				</tr>

				<tr>
						<td>Question:

				    <?php

		                $a = rand(0, 9);
				        $b = rand(0, 9);

				    ?> &nbsp;<span class="red"><?php echo "$a + $b"; ?> =</span><br>
				    <input value="<?php echo $a ?>"  name="a" type="hidden">
				    <input value=" <?php echo $b ?>" name="b"  type="hidden"></td>

					<td> <input type="text"  placeholder='answer here' name="ans" /></td>

				</tr>


				<tr>
          <td></td><td>
			  <button type="submit" class="button" >
    ADD PRODUCT
			</button>
            </td>
        </tr>

    </table>
</form>

</div>

</div>
</body>
</html>

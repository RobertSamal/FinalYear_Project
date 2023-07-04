<?php

    //this code helps us to add a new product
	require_once("../session.php");

	require_once("../class.user.php");
	$auth_user = new USER();

    //this code below is for session protection
	$user_id = $_SESSION['user_session'];

	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));

	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
  $id = $userRow['user_id'];
	if ($id == 1){
	}

	else{
		header("location: ../member/home.php");
	}

	if(!$_SESSION['user_session']){

		header("location: ../login/denied.php");
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Item</title>
<link rel="icon" href="../img/gymlogo.png" type="image/png">
<link rel="stylesheet" href="../style/style.css" type="text/css"  />
</head>
<body>



	<?php
	require_once '../connection/dbconfig.php';
    
	//select everything from this table to display the latest one
	$stmt = $db_con->prepare("SELECT * FROM product ORDER BY pid DESC LIMIT 1");
	$stmt->execute();

	//whatever value which will be fetched is given to the row
    $row=$stmt->fetch(PDO::FETCH_ASSOC);

	//store this pid in the last ID
    $lid = $row['pid'];

	//this is where the image will be stored
    $target_dir = "../img/";

	//the image is given the name of the last PID and extension jpg
    $new = $lid.".jpg";

	//we are adding the above values in the target file
    $target_file = $target_dir . $new;

	//this is the functions that is run when one clicks upload
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);




?>

	<div id="main2">

	<h1><font color='Green'>Order Submitted</font></h1>

<?php
require_once '../connection/dbconfig.php';



			$a = $_POST['a'];
			$b = $_POST['b'];
			$ans = $_POST['ans'];
			$spam = $a + $b;
            if($ans == $spam)
            {

	        if($_POST)
	       {


		$name = $_POST['name'];

		$mg = "img/".$new;

		$ds = $_POST['des'];
		$pr = $_POST['pr'];
		$cdate = $_POST['cdate'];




		try{

			$stmt = $db_con->prepare("INSERT INTO product(name, img, des, pr, cdate)
			VALUES(:nm, :mg, :ds, :pr, :cd)");
			//we are binding the paremeters
			$stmt->bindParam(":nm", $name);
		    $stmt->bindParam(":mg", $mg);
			$stmt->bindParam(":ds", $ds);
			$stmt->bindParam(":pr", $pr);
			$stmt->bindParam(":cd", $cdate);





			if($stmt->execute())
			{
				echo "<p>Your Product Successfully Added</p>";
			}
			else{
				echo "Query Problem";
			}
		}
		//this is for handling any errors
		catch(PDOException $e){
			echo $e->getMessage();
		}
	     }


		//header("Location: track.php?myid");


?>

               <p><b><?php   }
			   
    else{

	echo '<p> Wrong Answer! <br/> Please calculate the number again and try  to give correct answer. </p>';



		} ?></b></p>


								<p><a href="product.php" ><button class="button" >Back</button</a>
</p>
        </div>







</body>
</html>

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

		//echo "Your are Admin";
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
<title>Admin</title>
<link rel="icon" href="../img/gymlogo.png" type="image/png">
<link href="../style/style1.css" rel="stylesheet" type="text/css">

<!-- Javascript goes in the document HEAD -->
<script type="text/javascript">

	// This function adds alternating colors to the rows of a table
function altRows(id){
	if(document.getElementsByTagName){

		// Get the table element using its ID
		var table = document.getElementById(id);

		// Get all the rows in the table
		var rows = table.getElementsByTagName("tr");

		// Loop through each row of the table
		for(i = 0; i < rows.length; i++){
			if(i % 2 == 0){// Check if the current row index is even or odd
				rows[i].className = "evenrowcolor";
			}else{// Set the row's color to an "odd" color
				rows[i].className = "oddrowcolor";
			}
		}
	}
}
// Call the "altRows" function when the window finishes loading
window.onload=function(){

	// Call the "altRows" function and pass the ID of the table
	altRows('alternatecolor');
}
</script>

<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
table.altrowstable {
	border-width: 1px;
	border-color:  #ddd;
	border-collapse: collapse;
}
table.altrowstable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #ddd;
}
table.altrowstable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #ddd;
}
.oddrowcolor{
	background-color:#fcfcfc;
}
.evenrowcolor{
	background-color:#e0dbdb;
}
</style>

<!-- Table goes in the document BODY -->



</head>

<body>



	<div id="main3">

		<div id="header"><a href="../index.php"><img width="130px"src="../img/gymlogo.png"></a></div>
<center>
	<div id="manu">
	<ul>
		
	<li><a href="admin.php"  style="background:#000000; color:#fff;">HOME</a></li>
	<li><a href="user.php" >USER</a></li>
	<li><a href="product.php" >FOOD</a></li>
	<li><a href="order.php" >ORDER</a></li>
	<li><a href="message.php" >MESSAGES</a></li>
	<li><a href="../login/logout.php?logout=true" onclick="return confirm('Are you sure you want to sign out?')">SIGN OUT</a></li>

	</ul>
	</div>
</center>
<div id="content">

<h1><button class="button">Welcome <?php echo $userRow['user_name']; ?></button></h1>

<p> In this web app admin can access rich features like below. </p>
<p>1. Add Edit Delete Products</p>
<p>2. Add Edit Delete Orders</p>
<p>3. Manage Users</p>
<p>4. Manage Messages</p>


</div>

</div>


<div id="footer3">
<center>
	<p>Home . Product . Contact Us . Services </p>

	<p>
        <a  href="https://www.instagram.com/samal_robert/" target="_blank"><img src="../img/ig.png"></a>
        <a  href="https://github.com/RobertSamal" target="_blank"><img src="../img/github.png"></a>
        <a  href="https://www.linkedin.com/in/robert-samal-0a9995210/" target="_blank"><img src="../img/linkedin.png"></a>
      </p>
</center>
<b>  Copyrights © 2023 Final Year Project. Design by Robert Samal</b>



    </div>

    </div>



</body>
</html>

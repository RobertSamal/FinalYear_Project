<?php

	require_once("../session.php");

	require_once("../class.user.php");
	$auth_user = new USER(); // Create a new instance of the USER class


	$user_id = $_SESSION['user_session']; // Get the user ID from the session


	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id"); // Prepare a SQL statement to select user data
	$stmt->execute(array(":user_id"=>$user_id)); // Execute the SQL statement with the user ID parameter


	$userRow=$stmt->fetch(PDO::FETCH_ASSOC); // Fetch the user data into an associative array
    $uid = $userRow['user_id'];// Get the user ID from the fetched data


	if(!$_SESSION['user_session']){  // If there is no active user session

		header("location: ../login/denied.php"); // Redirect the user to the denied.php page
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Insert, Update, Delete using jQuery, PHP and MySQL</title>
<link rel="icon" href="../img/gymlogo.png" type="image/png">
<link href="../style/style1.css" rel="stylesheet" type="text/css">


<!-- Javascript goes in the document HEAD -->
<script type="text/javascript">

	// Function to apply alternating row colors to the table
function altRows(id){
	if(document.getElementsByTagName){

		var table = document.getElementById(id);
		var rows = table.getElementsByTagName("tr");

		for(i = 0; i < rows.length; i++){
			if(i % 2 == 0){
				rows[i].className = "evenrowcolor";
			}else{
				rows[i].className = "oddrowcolor";
			}
		}
	}
}
window.onload=function(){
	altRows('alternatecolor');
}
</script>

<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
table.altrowstable {
	border-width: 1px;
	border-color:  #ddd;
	font-size: 14px;
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

ul.pagination {
    text-align:center;
    color:#1f447f;
}
ul.pagination li {
    display:inline;
    padding:0 3px;
}
ul.pagination a {
    color:#1f447f;
    display:inline-block;
    padding:5px 10px;
    border:1px solid #1f447f;
    text-decoration:none;
}
ul.pagination a:hover,
ul.pagination a.current {
    background:#1f447f;
    color:#fff;
}

</style>

<!-- Table goes in the document BODY -->

</head>

<body>

	<div id="main3">

		<div id="header"><img width=130px src="../img/gymlogo.png"></div>

	<div id="manu">
	<ul>
	<li><a href="home.php" style="background:#000000; color:#fff;" >HOME</a></li>
	<li><a  href="../index.php" > WORKOUT NOW</a></li>
	<li><a href="../login/logout.php?logout=true" onclick="return confirm('Are you sure you want to sign out?')">SIGN OUT</a></li>
	</ul>
	</div>
<br>
<div id="content">
	<h2><a class="button" href="../index.php">WORK OUT NOW</a>  [WORKOUT Detail] </h2>

<center>
    	<table class="altrowstable" id="alternatecolor">
        <thead>
        <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
		<th>Mobile</th>
		<th>Email</th>
		<th>Address</th>
		<th>Food</th>
		<th>Date</th>
		<th>Status</th>

        </tr>
        </thead>
        <tbody>
					<?php
					require_once '../connection/dbconfig.php';

					$stmt = $db_con->prepare("SELECT * FROM ordrs WHERE uid = $uid ORDER BY myid DESC");
					$stmt->execute();
					while($row=$stmt->fetch(PDO::FETCH_ASSOC))
					{
				?>
			<tr>
			<td><?php echo $row['myid']; ?></td>

			<td><img with="50" height="50" src="../<?php echo $row['img']; ?>"></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['mobile']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['addr']; ?></td>
			<td><?php echo $row['ordr']; ?></td>
			<td><?php echo $row['cdate']; ?></td>
			<td><?php echo $row['sts']; ?></td>


			</tr>
			<?php
		}
		?>

				</tbody>
				</table>
		</center>
				<br>
				<?php


				?>


<div id="footer3">
<center>
	<p>Home . Product . Contact Us . Services </p>

	<p>
        <a  href="https://www.instagram.com/samal_robert/" target="_blank"><img src="../img/ig.png"></a>
        <a  href="https://github.com/RobertSamal" target="_blank"><img src="../img/github.png"></a>
        <a  href="https://www.linkedin.com/in/robert-samal-0a9995210/" target="_blank"><img src="../img/linkedin.png"></a>
      </p>

</center>
<b> Copyrights © 2023 Final Year Project. Design by Robert Samal</b>

    </div>

</body>
</html>

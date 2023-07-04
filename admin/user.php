<?php

    // Include the necessary files
	require_once("../session.php");
	require_once("../class.user.php");

	// Create a new instance of the USER class
	$auth_user = new USER();


	$user_id = $_SESSION['user_session'];// Get the user ID from the session

	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));// Bind the parameter

	$userRow=$stmt->fetch(PDO::FETCH_ASSOC); // Fetch the user details from the database


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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User</title>
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
    color: #000000;
}
ul.pagination li {
    display:inline;
    padding:0 3px;
}
ul.pagination a {
    color: #000000;
    display:inline-block;
    padding:5px 10px;
    border:1px solid #000000;
    text-decoration:none;
}
ul.pagination a:hover,
ul.pagination a.current {
    background: #000000;
    color:#fff;
}


</style>

<!-- Table goes in the document BODY -->



</head>

<body>



	<div id="main3">

<div id="header"><a href="../index.php"><img width = "130px" src="../img/gymlogo.png"></a></div>
<center>
	<div id="manu">
	<ul>
	<li><a href="admin.php" >HOME</a></li>
	<li><a style="background:#000000; color:#fff;" href="user.php" >USER</a></li>
	<li><a  href="product.php" >FOOD</a></li>
	<li><a href="order.php" >ORDER</a></li>
	<li><a href="message.php" >MESSAGES</a></li>
	<li><a href="../login/logout.php?logout=true" onclick="return confirm('Are you sure you want to sign out?')">SIGN OUT</a></li>
	</ul>
	</div>

</center>
<br>
<div id="content">
	<h2><a class="button" href="../login/admin-add.php"> Add User</a> Admin Access Only [User Page] </h2>

<center>


        <table class="altrowstable" id="alternatecolor">
        <thead>
        <tr>
        <th>ID</th>
        <th>Name</th>
		<th>Email</th>
		<th>Password</th>
	    <th>Date</th>
        <th>Edit</th>
        <th>Delete</th>
        </tr>
        </thead>
        <tbody>
					<?php
					// Including necessary files and functions
					require_once '../connection/dbconfig.php';

					include_once('../connection/connectionz.php');
					include_once('../function/functionz.php');

					// Pagination variables
					$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]); // Get the current page number from the URL parameter, default to 1 if not set

					if ($page <= 0) $page = 1; // Make sure the page number is a positive integer

					$per_page = 5; // Set how many records do you want to display per page.

					$startpoint = ($page * $per_page) - $per_page;

					$statement = "`users` ORDER BY `user_id` ASC"; //fetch records from the "users" table, ordered by the "user_id" column in ascending order

					$results = mysqli_query($conDB,"SELECT * FROM {$statement} LIMIT {$startpoint} , {$per_page}"); //fetch the records

					if (mysqli_num_rows($results) != 0) {

							// displaying records.
							while($row = mysqli_fetch_array($results)){

				?>
			<tr>
			<td><?php echo $row['user_id']; ?></td>
		    <td><?php echo $row['user_name']; ?></td>
			<td><?php echo $row['user_email']; ?></td>
			<td><?php  echo "Member only"; ?></td>
			<td><?php echo $row['joining_date']; ?></td>

		<td align="center">
			<a   href="uedit.php?uid=<?php  echo $row['user_id']; ?>" title="Edit">
			<img src="../img/edit.png" width="20px" />
            </a>
		</td>

		<td align="center">
			<a   href="delete.php?uid=<?php echo $row['user_id']; ?>" title="Delete">
			<img src="../img/delete.png" width="20px" />
            </a>
		</td>
			</tr>

<?php

}
 ?>

        </tbody>
        </table>
				<br>

				<?php

}
else{

echo "No recond here";

}


								// displaying paginaiton.
							echo pagination($statement,$per_page,$page,$url='?');
								?>
</center>

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

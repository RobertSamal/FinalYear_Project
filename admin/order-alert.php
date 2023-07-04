<?php
require_once '../connection/dbconfig.php';

if ($_POST) {
	$a = $_POST['a'];// Get the value of 'a' from the form
	$b = $_POST['b'];// Get the value of 'b' from the form
	$ans = $_POST['ans'];// Get the value of 'ans' from the form
	$spam = $a + $b;// Calculate the sum of 'a' and 'b'

	if ($ans == $spam) { // Check if the user's answer matches the calculated sum

		//get the following values from the form
		$uid = $_POST['uid']; 
		$mg = $_POST['img'];
		$name = $_POST['name'];
		$mb = $_POST['mobile'];
		$em = $_POST['email'];
		$addr = $_POST['addr'];
		$cdate = $_POST['cdate'];
		$ordr = $_POST['ordr'];
		$pr = $_POST['pr'];

		// Set the status to "Pending"
		$sts = "Scheduled";

		try {

			// Prepare and execute the SQL query to insert the order details into the database
			$stmt = $db_con->prepare("INSERT INTO ordrs (myid, uid, img, name, mobile, email, addr, ordr, pr, sts, cdate, weight, height, age) VALUES (NULL, :uid, :mg, :name, :mb, :em, :addr, :ordr, :pr, :sts, :cdate, :weight, :height, :age)");

			//bind the following values to the corresponding parameter in the query
			$stmt->bindParam(":uid", $uid);
			$stmt->bindParam(":mg", $mg);
			$stmt->bindParam(":name", $name);
			$stmt->bindParam(":mb", $mb);
			$stmt->bindParam(":em", $em);
			$stmt->bindParam(":addr", $addr);
			$stmt->bindParam(":ordr", $ordr);
			$stmt->bindParam(":pr", $pr);
			$stmt->bindParam(":sts", $sts);
			$stmt->bindParam(":cdate", $cdate);
			$stmt->bindParam(":weight", $_POST['weight']); // Add the weight parameter from the form
			$stmt->bindParam(":height", $_POST['height']); // Add the height parameter from the form
			$stmt->bindParam(":age", $_POST['age']); // Add the age parameter from the form

			if ($stmt->execute()) {  // Execute the prepared statement and check if it was successful

				$lastInsertedId = $db_con->lastInsertId(); // Get the ID of the last inserted row
				header("Location: ../workouts.php?myid=$lastInsertedId"); // Redirect the user to the workouts page with the last inserted ID as a parameter in the URL
				exit;

			} 
			
			else {
				echo "Query Problem"; // Display an error message if there was a problem with the query execution
			}

		} catch (PDOException $e) {
			echo $e->getMessage(); // Display the error message from the exception
		}
	} else {
		echo '<p> Wrong Answer! <br/> Please calculate the number again and try to give the correct answer. </p>';
	}
}
?>
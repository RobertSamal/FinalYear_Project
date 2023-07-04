<?php
	require_once('../session.php');
	require_once('../class.user.php');
	$user_logout = new USER();

	// Create an instance of the user class for logout functionality
	if(isset($_GET['logout']) && $_GET['logout']=="true")
	{
		// Perform the logout operation
		$user_logout->doLogout();

		// Redirect the user to the ../index.php page
		$user_logout->redirect('../index.php');
	}

	?>

<?php

// Include database configuration file
require_once('connection/dbconfig.php');

class USER
{

	private $conn;

	public function __construct()
	{
		// Create a new instance of the Database class and establish a database connection
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	// Function to prepare and execute a database query
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
    
	// Function to register a new user
	public function register($uname,$umail,$upass)
	{
		try
		{
		     //the following is an inbuilt hashing function for passwowrds
			// Hash the password for security
			$new_password = password_hash($upass, PASSWORD_DEFAULT);

			// Prepare and execute the SQL statement to insert a new user into the database

			$stmt = $this->conn->prepare("INSERT INTO users(user_name,user_email,user_pass) VALUES(:uname, :umail, :upass)");

			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);

			$stmt->execute();

			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	// Function to authenticate a user during login
	public function doLogin($uname,$umail,$upass)
	{
		try
		{

			// Prepare and execute the SQL statement to retrieve user information based on username or email
			$stmt = $this->conn->prepare("SELECT user_id, user_name, user_email, user_pass FROM users WHERE user_name=:uname OR user_email=:umail ");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);


			if($stmt->rowCount() == 1)
			{
				// Verify the password entered by the user with the hashed password stored in the database
				if(password_verify($upass, $userRow['user_pass']))
				{
					// Set user session upon successful login
					$_SESSION['user_session'] = $userRow['user_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	// Function to check if a user is logged in
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}

	// Function to redirect the user to a specified URL
	public function redirect($url)
	{
		header("Location: $url");
	}

	// Function to log out a user
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>

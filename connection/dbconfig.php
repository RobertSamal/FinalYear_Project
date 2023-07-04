<?php
class Database
{
    private $host = "localhost";
    private $db_name = "finaldb";
    private $username = "root";
    private $password = "";
    public $conn; //database connection object

    public function dbConnection()
	{

	    $this->conn = null;
        try
		{
            // Create a new PDO connection to the MySQL database
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=8111;dbname=" . $this->db_name, $this->username, $this->password);

             // Set the error mode of the connection to throw exceptions
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Database Connected";

        }
		catch(PDOException $exception)
		{
            // If there is an error in the connection, display the error message
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn; // Return the database connection object
    }
}

$db_host = "localhost";
$db_name = "finaldb";
$db_user = "root";
$db_pass = "";

try{

  // Create a new PDO connection to the MySQL database sort of like instantiating the PDO class
  $db_con = new PDO("mysql:host={$db_host};port=8111;dbname={$db_name}",$db_user,$db_pass);

  // Makes easier for us to handle and debug any issues that occur during database operations.
  $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


}
catch(PDOException $e){
    // If there is an error in the connection, display the error message
  echo $e->getMessage();
}
?>

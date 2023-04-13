<?php
	// Replace with your own database connection details
	$servername = "localhost";
	$username = "yourusername";
	$password = "yourpassword";
	$dbname = "yourdatabase";

	// Create a new MySQLi object
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) 
	{
	  die("Connection failed: " . $conn->connect_error);
	}
?>

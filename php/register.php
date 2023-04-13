<?php
  // Include the database connection details
  require_once 'connect.php';

  // Handle incoming HTTP requests for user registration
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the data sent by the client
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate the data
    if (strlen($username) < 3 || strlen($username) > 16) {
      // Return an error response if the username is invalid
      http_response_code(400);
      echo json_encode(array('error' => 'Invalid username'));
      exit;
    }

    if (strlen($password) < 6 || strlen($password) > 32) {
      // Return an error response if the password is invalid
      http_response_code(400);
      echo json_encode(array('error' => 'Invalid password'));
      exit;
    }

    if ($password != $confirmPassword) {
      // Return an error response if the passwords don't match
      http_response_code(400);
      echo json_encode(array('error' => 'Passwords do not match'));
      exit;
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user into the database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
    if ($conn->query($sql) === TRUE) {
      // Return a success response
      http_response_code(200);
      echo json_encode(array('message' => 'Registration successful'));
      exit;
    } else {
      // Return an error response if the insert query fails
      http_response_code(500);
      echo json_encode(array('error' => 'Error inserting user into database'));
      exit;
    }
  }

  // Return an error response if the request method is not POST
  http_response_code(405);
  echo json_encode(array('error' => 'Method not allowed'));
  exit;

  // Close the MySQLi connection
  $conn->close();
?>

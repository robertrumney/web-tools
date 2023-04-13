<?php
  // Include the database connection details
  require_once 'connect.php';

  // Handle incoming HTTP requests for user login
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the data sent by the client
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve the user from the database
    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Verify the password
      $row = $result->fetch_assoc();
      if (password_verify($password, $row['password'])) {
        // Password is correct, log the user in
        // ... (your login code goes here)

        // Return a success response
        http_response_code(200);
        echo json_encode(array('message' => 'Login successful'));
        exit;
      } else {
        // Password is incorrect
        http_response_code(400);
        echo json_encode(array('error' => 'Incorrect password'));
        exit;
      }
    } else {
      // User not found
      http_response_code(400);
      echo json_encode(array('error' => 'User not found'));
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

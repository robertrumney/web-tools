<?php

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  // Include the database connection details
  require_once 'connect.php';

  // Handle incoming HTTP requests for password reset
  if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {
    // Retrieve the data sent by the client
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Retrieve the user from the database
    $sql = "SELECT id, username, email FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
      // Verify the email
      $row = $result->fetch_assoc();
      if ($email == $row['email']) 
      {
        // Email is correct, generate a verification code and send an email
        $verificationCode = generateVerificationCode();
        sendVerificationEmail($username, $email, $verificationCode);

        // Store the verification code in the database
        $sql = "UPDATE users SET verification_code = '$verificationCode' WHERE id = " . $row['id'];
        if ($conn->query($sql) === TRUE) 
        {
          // Return a success response
          http_response_code(200);
          echo json_encode(array('message' => 'Verification email sent'));
          exit;
        } 
        else 
        {
          // Return an error response if the update query fails
          http_response_code(500);
          echo json_encode(array('error' => 'Error updating verification code in database'));
          exit;
        }
      } 
      else 
      {
        // Email is incorrect
        http_response_code(400);
        echo json_encode(array('error' => 'Incorrect email'));
        exit;
      }
    } 
    else 
    {
      // User not found
      http_response_code(400);
      echo json_encode(array('error' => 'User not found'));
      exit;
    }
  }

  // Handle incoming HTTP requests for verifying the verification code
  if ($_SERVER['REQUEST_METHOD'] == 'GET') 
  {
    // Retrieve the data sent by the client
    $username = $_GET['username'];
    $verificationCode = $_GET['verification_code'];

    // Retrieve the user from the database
    $sql = "SELECT id, username, verification_code FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
      // Verify the verification code
      $row = $result->fetch_assoc();
      if ($verificationCode == $row['verification_code']) 
      {
        // Verification code is correct, generate a new password and update the database
        $newPassword = generatePassword();
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password = '$hashedPassword', verification_code = NULL WHERE id = " . $row['id'];
        if ($conn->query($sql) === TRUE) 
        {
          // Send the new password to the user's email
          sendNewPasswordEmail($username, $row['email'], $newPassword);

          // Return a success response
          http_response_code(200);
          echo json_encode(array('message' => 'Password reset successful'));
          exit;
        } else 
        {
          // Return an error response if the update query fails
          http_response_code(500);
          echo json_encode(array('error' => 'Error updating password in database'));
          exit;
        }
      } else 
      {
        // Verification code is incorrect
        http_response_code(400);
        echo json_encode(array('error' => 'Incorrect verification code'));
        exit;
      }
    } 
    else 
    {
      // User not found
      http_response_code(400);
      echo json_encode(array('error' => 'User not found'));
      exit;
    }
  }

  // Return an error response if the request method is not POST or GET
  http_response_code(405);
  echo json_encode(array('error' => 'Method not allowed'));
  exit;

  // Close the MySQLi connection
  $conn->close();

  // Generate a random verification code
  function generateVerificationCode() 
  {
    return bin2hex(random_bytes(16));
  }

  // Generate a random password
  function generatePassword() 
  {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    return substr(str_shuffle($chars), 0, 12);
  }

  // Send a verification email to the user
  function sendVerificationEmail($username, $email, $verificationCode) 
  {
    // ... (your email sending code goes here)
  }

  // Send the new password to the user's email
  function sendNewPasswordEmail($username, $email, $newPassword) 
  {
    // ... (your email sending code goes here)
  }
?>

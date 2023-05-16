# User Management Scripts

This repository contains PHP scripts for user management functionalities, including user login, registration, password reset, and database connectivity.

## Script 1: Database Connection

- File: `connect.php`

- Description: Establishes a connection to a MySQL database using the provided database connection details.

## Script 2: Password Reset

- File: `password_reset.php`

- Description: Handles HTTP requests for password reset functionality. It verifies the email and sends a verification code to the user. It also handles verification of the verification code and allows the user to reset their password.

## Script 3: User Login

- File: `user_login.php`

- Description: Handles HTTP requests for user login functionality. It validates the username and password, verifies the password against the hashed password stored in the database, and logs the user in if the credentials are correct.

## Script 4: User Registration

- File: `user_registration.php`

- Description: Handles HTTP requests for user registration functionality. It validates the username and password, checks for password confirmation, hashes the password for security, and inserts the user into the database.

Please refer to the individual script files for more detailed explanations and implementation specifics.

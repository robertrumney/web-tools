# Users Table

This repository contains the SQL schema definition for a MySQL table called `users`, which can be used to store user information in a database.

```
## Table Structure

The `users` table has the following columns:

- `id` (INT): The unique identifier for each user. It is set to auto-increment, ensuring each user has a unique ID.
- `username` (VARCHAR(16)): The username of the user. It is limited to a maximum of 16 characters.
- `password` (VARCHAR(255)): The password of the user. It is securely stored as a hashed value.
  
The table has a primary key defined on the `id` column, ensuring each row has a unique identifier. Additionally, a unique constraint is set on the `username` column to enforce username uniqueness.
```

## Usage

To use this table definition, you can execute the following SQL statement in your MySQL database:

```sql
CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(16) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
```

Make sure to replace any backticks (\`) with the appropriate syntax for your database system if needed.

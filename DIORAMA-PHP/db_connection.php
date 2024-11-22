<?php
// db_connection.php

// Database connection parameters
$servername = "localhost";
$username = "root";  // Default username for local development
$password = "";      // Default password for local development
$dbname = "dioramas"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Database connected successfully!"; // This will print if the connection is successful
}

?>
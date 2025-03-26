<?php
$servername = "localhost"; // Change if using a different host
$username = "root"; // Change according to your database credentials
$password = '8446'; // Change if your database has a password
$database = "career_counseling"; // Change to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
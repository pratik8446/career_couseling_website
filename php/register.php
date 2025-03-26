<?php
session_start();
include 'db_connect.php'; // Ensure this file contains the DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $qualification = $_POST['qualification'];

    // Check if the user already exists
    $checkUser = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkUser->bind_param("s", $email);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered! Try logging in.'); window.location.href='../login.html';</script>";
        exit();
    }

    // Insert user into database
    $sql = $conn->prepare("INSERT INTO users (name, email, password, age, gender, qualification) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssssss", $name, $email, $password, $age, $gender, $qualification);

    if ($sql->execute()) {
        // Redirect to login page
        echo "<script>
                alert('Registration successful! Please login.');
                window.location.href='../login.html';
              </script>";
        exit();
    } else {
        echo "<script>alert('Error in registration. Please try again.'); window.history.back();</script>";
    }
}
?>
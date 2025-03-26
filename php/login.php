<?php
session_start();
include("db_connect.php"); // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check user in database
    $query = "SELECT user_id, name, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $name, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['name'] = $name;
        echo "<script>alert('Login successful!'); window.location.href='dashboard.html';</script>";
    } else {
        echo "<script>alert('Invalid email or password!'); window.location.href='login.html';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.html");
    exit();
}
?>
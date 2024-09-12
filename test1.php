<?php
session_start();

// Include database connection
include 'conn.php';

// Retrieve form data
$email = $_POST['email'];
$password = $_POST['password'];
$table = $_POST['user'];

// Query database for user with the provided email
$sql = "SELECT * FROM $table WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    // Verify password
    if ($password == $user['password']) {
        // Password is correct, set session variables and redirect to appropriate page
        $_SESSION['email'] = $user['email'];
        $_SESSION['user'] = $table; // Set user role in session for future use
        if ($table == "admin") {
            header("Location: adminpage.html");
            exit();
        } elseif ($table == "users") {
            header("Location: userPage.html");
            exit();
        } elseif ($table == "candidate") {
            header("Location: candidatePage.html");
            exit();
        }
    } else {
        // Password is incorrect
        echo "Invalid email or password. Please try again.";
    }
} else {
    // User with provided email not found
    echo "<script>alert('User not found. Please register.'); window.location.href = 'index.html';</script>";
}


?>

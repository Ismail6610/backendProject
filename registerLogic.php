<?php
include 'config.php';

if (isset($_GET['submit'])) {
    $name = $_GET['name'];
    $username = $_GET['username'];
    $surname = $_GET['surname'];
    $email = $_GET['email'];
    $password = $_GET['password'];

    if (empty($name) || empty($username) || empty($password) || empty($surname) || empty($email)) {
        echo "All fields are required!";
        exit;
    }

    $check_user = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $check_user->bind_param("ss", $username, $email);
    $check_user->execute();
    $user_exists = $check_user->get_result();

    if ($user_exists->num_rows > 0) {
        echo "Username or email already exists!";
        $check_user->close();
        exit;
    }

    $check_user->close();
    $stmt = $conn->prepare("INSERT INTO users (name, username, surname, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $username, $surname, $email, $password);
    
    if ($stmt->execute()) {
        header("Location: login.html");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    mysqli_close($conn);
}
?>

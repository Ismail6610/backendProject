<?php
include 'config.php'; 


if (isset($_GET['submit'])) {

    $name = $_GET['name'];
    $username = $_GET['username'];
    $password = $_GET['password'];


    if (empty($name) || empty($username) || empty($password)) {
        echo "All fields are required!";
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE name = ? AND username = ? AND password = ?");
    $stmt->bind_param("sss", $name, $username, $password);
    
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: index.php");
        exit;
    } else {
        echo "Invalid login credentials!";
    }

    $stmt->close();
    mysqli_close($conn);
}
?>

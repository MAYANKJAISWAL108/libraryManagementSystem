<?php
session_start();
require '../include/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $role = 'user'; // default user

    // 1. Check empty fields
    if (empty($username) || empty($email) || empty($password) || empty($phone) || empty($address)) {
        header('Location: /library/index.php?register_error1=empty_fields&register_modal=1');
        exit();
    }

    // 2. Check if username or email already exists
    $check_sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($result) > 0) {
        header('Location: /library/index.php?register_error2=alreadyExist&register_modal=1');
        exit();
    }

    // 3. Directly insert without hashing
    $insert_sql = "INSERT INTO users (username, email, phone,address, password, role) 
                   VALUES ('$username', '$email', '$phone', '$address' ,'$password', '$role')";

    if (mysqli_query($conn, $insert_sql)) {
        header('Location: /library/index.php?register_success=success&register_modal=1');
        exit();
    } else {
        header('Location: /library/index.php?server_error=database_error&register_modal=1');
        exit();
    }
}
?>
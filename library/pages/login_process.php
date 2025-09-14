<?php
session_start();
require '../include/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login_input = trim($_POST['login_input']); // can be username or email
    $password = trim($_POST['password']);

    if (empty($login_input) || empty($password)) {
        header("Location: /library/index.php?login_error=empty_fields&login_modal=1");
        exit();
    }

        // check both username OR email
    $sql = "SELECT * FROM users WHERE (username='$login_input' OR email='$login_input') AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $sql);

     if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] = $user['user_id'];

        // redirect based on role
        if ($user['role'] == 'admin') {
            header("Location: /library/admin_portal/admin_dashboard.php");
        } else {
            header("Location: /library/index.php?login_success=1");
        }
        exit();
    } else {
        header("Location: /library/index.php?login_error=invalid&login_modal=1");
        exit();
    }
}
?>

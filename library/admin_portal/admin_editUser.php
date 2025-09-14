<?php
include '../include/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Check if user is admin
    $check = mysqli_query($conn, "SELECT role FROM users WHERE user_id=$id");
    $user = mysqli_fetch_assoc($check);

        // Normal users can have their role updated
        $sql = "UPDATE users SET username='$username', email='$email', role='$role' WHERE user_id=$id";


    if (mysqli_query($conn, $sql)) {
        header("Location: admin_manageUser.php?update_success=1");
    } else {
        header("Location: admin_manageUser.php?update_error=1&msg=" . urlencode(mysqli_error($conn)));
    }
}
?>

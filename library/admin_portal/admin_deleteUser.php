<?php
include '../include/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Check role of the user first
    $check = mysqli_query($conn, "SELECT role FROM users WHERE user_id=$id");
    if ($check && mysqli_num_rows($check) > 0) {
        $user = mysqli_fetch_assoc($check);

        if ($user['role'] === 'admin') {
            // Prevent deletion
            header("Location: admin_manageUser.php?delete_error=1&msg=Admin accounts cannot be deleted");
            exit();
        }

        // Delete if not admin
        $sql = "DELETE FROM users WHERE user_id=$id";
        if (mysqli_query($conn, $sql)) {
            header("Location: admin_manageUser.php?delete_success=1");
        } else {
            header("Location: admin_manageUser.php?delete_error=1&msg=" . urlencode(mysqli_error($conn)));
        }
    } else {
        header("Location: admin_manageUser.php?delete_error=1&msg=User not found");
    }
} else {
    header("Location: admin_manageUser.php?delete_error=1&msg=No user ID provided");
}
exit();
?>

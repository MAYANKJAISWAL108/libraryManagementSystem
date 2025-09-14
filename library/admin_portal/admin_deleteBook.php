<?php
include '../include/db.php';

// Check if ID parameter exists
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete the book from database
    $sql = "DELETE FROM books WHERE book_id='$id'";
    
    if(mysqli_query($conn, $sql)) {
        // Redirect back to book management page with success message
        header("Location: admin_manageBook.php?delete_success=1");
    } else {
        // Redirect back with error message
        header("Location: admin_manageBook.php?delete_error=1&message=" . urlencode(mysqli_error($conn)));
    }
} else {
    // Redirect back if no ID provided
    header("Location: admin_manageBook.php?delete_error=1&message=No book ID provided");
}

exit();
?>
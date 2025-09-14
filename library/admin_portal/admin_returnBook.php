<?php
session_start();
require '../include/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    exit("Unauthorized access");
}

if (isset($_GET['borrow_id'])) {
    $borrow_id = intval($_GET['borrow_id']);

    // Fetch book_id from borrow record
    $res = mysqli_query($conn, "SELECT book_id FROM borrow_records WHERE borrow_id = $borrow_id");
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $book_id = $row['book_id'];

        // Update borrow record to returned
        $updateBorrow = "UPDATE borrow_records 
                         SET status = 'returned', return_date = CURDATE() 
                         WHERE borrow_id = $borrow_id";
        mysqli_query($conn, $updateBorrow);

        // Update book copies
        $updateBook = "UPDATE books 
                       SET available_copies = available_copies + 1 
                       WHERE book_id = $book_id";
        mysqli_query($conn, $updateBook);

        header("Location: admin_borrowRecord.php?return_success=1");
        exit();
    } else {
        header("Location: admin_borrowRecord.php?return_error=BookNotFound");
        exit();
    }
} else {
    header("Location: admin_borrowRecord.php?return_error=InvalidID");
    exit();
}

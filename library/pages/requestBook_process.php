
<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: /library/index.php?login_error=not_logged_in");
    exit();
}

require '../include/db.php';

$user_id = $_SESSION['user_id'];
$book_id = intval($_POST['book_id']);

// Insert into borrow_records as pending request
$sql = "INSERT INTO borrow_records (user_id, book_id, status) VALUES ($user_id, $book_id, 'pending')";
if(mysqli_query($conn, $sql)) {
    // Notify admin (user_id=1)
    $msg = "User {$_SESSION['username']} requested book ID: $book_id";
    mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES (1, '$msg')");

    header("Location: allBook.php?request_success=1");
} else {
    header("Location: allBook.php?request_error=1");
}
exit();
?>
































<!--<?php
// session_start();
// if(!isset($_SESSION['user_id'])) { exit("Not logged in"); }
// require '../include/db.php';

// $user_id = $_SESSION['user_id'];
// $book_id = intval($_POST['book_id']);

// // get book title
// $res = mysqli_query($conn,"SELECT title FROM books WHERE book_id=$book_id");
// if(!$res || mysqli_num_rows($res)==0) exit("Book not found");
// //$title = mysqli_fetch_assoc($res)['title'];

// // send notification to ADMIN
// // (assuming admin has user_id = 1, else you can query users where role='admin')
// //$msg = "User {$_SESSION['username']} requested the book "$res['title']"";
// mysqli_query($conn,"INSERT INTO notifications (user_id,message) VALUES (1,'$msg')");

// header("Location: demo_allBook.php?request_sent=1");

?> -->


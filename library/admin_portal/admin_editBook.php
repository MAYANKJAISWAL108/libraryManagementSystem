<?php
include '../include/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $category = $_POST['category'];
    $total_copies = intval($_POST['total_copies']);
    $available_copies = intval($_POST['available_copies']);
    $imageName = null;

    // Handle image upload if provided
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = "../assets/uploads/";
        $imageName = time() . "_" . basename($_FILES['image']['name']);
        $uploadFile = $uploadDir . $imageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            header("Location: admin_manageBook.php?edit_error=image_upload");
            exit();
        }
    }

    // Update query
    if ($imageName) {
        $sql = "UPDATE books 
                SET title='$title', author='$author', isbn='$isbn', category='$category',
                    total_copies='$total_copies', available_copies='$available_copies', image='$imageName'
                WHERE book_id=$id";
    } else {
        $sql = "UPDATE books 
                SET title='$title', author='$author', isbn='$isbn', category='$category',
                    total_copies='$total_copies', available_copies='$available_copies'
                WHERE book_id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: admin_manageBook.php?edit_success=1");
    } else {
        header("Location: admin_manageBook.php?edit_error=1&message=" . urlencode(mysqli_error($conn)));
    }
    exit();
}
?>

<?php
require '../include/db.php';
session_start();
$id = $_SESSION['id'] ?? null;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $category = $_POST['category'];
    $total_copies = $_POST['total_copies'];
    $available_copies = $_POST['available_copies'];

    $imageName = "";
    if(!empty($_FILES['image']['name'])){
        $imageName = time() ."_". $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmpName, "../assets/uploads/" . $imageName);
    }

    if($title != ""){
        $query = "INSERT INTO books (title, author, isbn, category, total_copies, available_copies, image)
                  VALUES ('$title', '$author', '$isbn', '$category', $total_copies, $available_copies, '$imageName')";

        if(mysqli_query($conn, $query)){
            header('Location: admin_dashboard.php?add_success=BookAdded&AddBook_modal=1');
            exit();
        }
        else{
            header('Location: admin_dashboard.php?add_error=NotAdded&AddBook_modal=1');
            exit();
        }
    }
    else{
        header('Location: admin_dashboard.php?server_error=TitleRequired&AddBook_modal=1');
        exit();
    }
}
?>
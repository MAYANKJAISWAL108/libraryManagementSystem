<?php
include '../include/bootstrap.php';
session_start();

// Prevent cached pages from being shown after logout
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    // Redirect if not logged in OR not an admin
    header('Location: /library/index.php?login_error=invalid&login_modal=1');
    exit();
}

include '../include/db.php';

// Fetching statistics
$user_count_sql = "SELECT COUNT(*) AS total_users FROM users";
$book_count_sql = "SELECT COUNT(*) AS total_books FROM books";
$borrow_count_sql = "SELECT COUNT(*) AS total_borrowed FROM borrow_records WHERE status = 'borrowed'";
$overdue_count_sql = "SELECT COUNT(*) AS total_overdue FROM borrow_records WHERE status = 'overdue'";

// Storing result of above queries
$user_count_result = mysqli_query($conn, $user_count_sql);
$user_count = mysqli_fetch_assoc($user_count_result)['total_users'];

$book_count_result = mysqli_query($conn, $book_count_sql);
$book_count = mysqli_fetch_assoc($book_count_result)['total_books'];

$borrow_count_result = mysqli_query($conn, $borrow_count_sql);
$borrow_count = mysqli_fetch_assoc($borrow_count_result)['total_borrowed'];

$overdue_count_result = mysqli_query($conn, $overdue_count_sql);
$overdue_count = mysqli_fetch_assoc($overdue_count_result)['total_overdue'];

// Getting all users to display in admin page
$sql = "SELECT * FROM users ORDER BY created_at DESC LIMIT 5";
$result1 = mysqli_query($conn, $sql);

// Getting recent borrow records
$borrow_sql = "SELECT br.*, u.username, b.title 
               FROM borrow_records br 
               JOIN users u ON br.user_id = u.user_id 
               JOIN books b ON br.book_id = b.book_id 
               ORDER BY br.borrow_date DESC 
               LIMIT 5";
$borrow_result = mysqli_query($conn, $borrow_sql);
$recent_borrows = mysqli_fetch_all($borrow_result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Literature Oasis</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #db3434;
            --success-color: #1cc88a;
            --danger-color: #e74a3b;
            --warning-color: #f6c23e;
            --light-bg: #f8f9fc;
            --dark-bg: #2e59d9;
        }

        .welcome-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .dashboard-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .card-icon {
            font-size: 2rem;
            opacity: 0.7;
        }

        .user-table,
        .borrow-table {
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .user-table .table,
        .borrow-table .table {
            table-layout: fixed;
            width: 100%;
        }

        .user-table .table th,
        .borrow-table .table th {
            background: var(--primary-color);
            color: #f8f9fc;
            padding: 15px;
        }

        .table th {
            background: var(--primary-color);
            color: #f8f9fc;
            padding: 15px;
        }

        .table td {
            padding: 15px;
            vertical-align: middle;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .bg-borrowed {
            background-color: #007bff;
            color: white;
        }

        .bg-returned {
            background-color: #28a745;
            color: white;
        }

        .bg-overdue {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <?php include "../include/admin_sidebar.php" ?>

    <div class="main-content">

        <!-- Welcome Header -->
        <div class="welcome-header">
            <div class="row align-items-center">
                <div class="col">
                    <h2>Welcome,
                        <?php echo $_SESSION['username']; ?>!
                    </h2>
                    <p>Literature Oasis Library Management Dashboard</p>
                </div>
                <div class="col text-end">
                    <a href="#addBookModal" data-bs-toggle="modal" class="btn btn-light btn-lg">
                        <i class="fas fa-book"></i> Add New Book
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card border-left-primary">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $user_count; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-primary card-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card border-left-success">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Books</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $book_count; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-success card-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card border-left-warning">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Books Borrowed</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $borrow_count; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exchange-alt fa-2x text-warning card-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card border-left-danger">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Overdue Books</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $overdue_count; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exclamation-triangle fa-2x text-danger card-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Users Table -->
            <div class="col-md-6 mb-4">
                <div class="card user-table">
                    <div class="card-header bg-white">
                        <h3 class="mb-0 text-center"><i class="fas fa-users me-2"></i>Recent Users</h3>
                    </div>
                    <div class="card-body">
                        <?php if(mysqli_num_rows($result1) > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = mysqli_fetch_assoc($result1)): ?>
                                    <tr>
                                        <td><strong>#
                                                <?php echo $row['user_id']; ?>
                                            </strong></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                                    style="width: 35px; height: 35px;">
                                                    <?php echo strtoupper(substr($row['username'], 0, 1)); ?>
                                                </div>
                                                <div class="ms-3">
                                                    <strong>
                                                        <?php echo $row['username']; ?>
                                                    </strong>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div
                                                class="badge bg-<?php echo $row['role'] == 'admin' ? 'danger' : 'success'; ?>">
                                                <?php echo ucfirst($row['role']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No users found</h5>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Recent Borrows Table -->
            <div class="col-md-6 mb-4">
                <div class="card borrow-table">
                    <div class="card-header bg-white">
                        <h3 class="mb-0 text-center"><i class="fas fa-exchange-alt me-2"></i>Recent Borrows</h3>
                    </div>
                    <div class="card-body">
                        <?php if(!empty($recent_borrows)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Book</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($recent_borrows as $borrow): ?>
                                    <tr>
                                        <td>
                                            <?php echo $borrow['username']; ?>
                                        </td>
                                        <td>
                                            <?php echo $borrow['title']; ?>
                                        </td>
                                        <td>
                                            <span class="status-badge bg-<?php echo $borrow['status']; ?>">
                                                <?php echo ucfirst($borrow['status']); ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-exchange-alt fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No recent borrows</h5>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--Add new book modal-->
    <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addBookModalLabel"><i class="fas fa-book me-2"></i>Add New Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data" action="addNewBook_process.php">
                        <!-- Display error/success messages -->
                        <?php if(isset($_GET['add_error'])): ?>
                        <div class="alert alert-danger">Book Not Added!</div>
                        <!-- <?php elseif(isset($_GET['error2'])): ?>
                        <div class="alert alert-danger">ISBN Already Exists!</div> -->
                        <?php elseif(isset($_GET['server_error'])): ?>
                        <div class="alert alert-danger">Server Error! Please try again.</div>
                        <?php elseif(isset($_GET['add_success'])): ?>
                        <div class="alert alert-success">Book Added Successfully!</div>
                        <?php endif; ?>

                        <div class="row">
                            <!-- Title -->
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter book title" required>
                            </div>

                            <!-- Author -->
                            <div class="col-md-6 mb-3">
                                <label for="author" class="form-label">Author <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="author" name="author"
                                    placeholder="Enter author name" required>
                            </div>
                        </div>

                        <div class="row">
                            <!-- ISBN -->
                            <div class="col-md-6 mb-3">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Enter ISBN">
                            </div>

                            <!-- Category -->
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select" id="category" name="category">
                                    <option value="">Select Category</option>
                                    <option value="Fiction">Fiction</option>
                                    <option value="Non-Fiction">Non-Fiction</option>
                                    <option value="Science">Science</option>
                                    <option value="Technology">Technology</option>
                                    <option value="History">History</option>
                                    <option value="Biography">Biography</option>
                                    <option value="Children">Children</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Total Copies -->
                            <div class="col-md-6 mb-3">
                                <label for="total_copies" class="form-label">Total Copies</label>
                                <input type="number" class="form-control" id="total_copies" name="total_copies"
                                    value="1" min="1">
                            </div>

                            <!-- Available Copies -->
                            <div class="col-md-6 mb-3">
                                <label for="available_copies" class="form-label">Available Copies</label>
                                <input type="number" class="form-control" id="available_copies" name="available_copies"
                                    value="1" min="0">
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Book Cover Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <div class="form-text">Upload a cover image for the book (JPEG, PNG, etc.)</div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Book</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    <script>
        // Simple validation for copies fields in add new book modal
        document.addEventListener('DOMContentLoaded', function () {
            const totalCopies = document.getElementById('total_copies');
            const availableCopies = document.getElementById('available_copies');

            totalCopies.addEventListener('change', function () {
                if (parseInt(availableCopies.value) > parseInt(totalCopies.value)) {
                    availableCopies.value = totalCopies.value;
                }
                availableCopies.max = totalCopies.value;
            });

            availableCopies.addEventListener('change', function () {
                if (parseInt(availableCopies.value) > parseInt(totalCopies.value)) {
                    availableCopies.value = totalCopies.value;
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
    <?php if (isset($_GET['AddBook_modal'])): ?>
        var addBookModal = new bootstrap.Modal(document.getElementById('addBookModal'));
            addBookModal.show();
    <?php endif; ?>
});

    </script>
</body>

</html>
<?php
include '../include/bootstrap.php';
include '../include/db.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php?login_error=required&login_modal=1');
    exit();
}

$user_id = $_SESSION['user_id'];

// Get search parameters
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$category = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';

// Build query with filters
$query = "SELECT * FROM books WHERE available_copies > 0";

if (!empty($search)) {
    $query .= " AND (title LIKE '%$search%' OR author LIKE '%$search%' OR isbn LIKE '%$search%')";
}

if (!empty($category) && $category != 'all') {
    $query .= " AND category = '$category'";
}

$query .= " ORDER BY title ASC";
$result = mysqli_query($conn, $query);

// Get distinct categories for filter dropdown
$category_query = "SELECT DISTINCT category FROM books WHERE category IS NOT NULL AND category != '' ORDER BY category";
$category_result = mysqli_query($conn, $category_query);

// Check if user has any pending borrow requests
// $pending_query = "SELECT COUNT(*) as pending_count FROM borrow_records 
//                  WHERE user_id = $user_id AND status = 'pending'";
// $pending_result = mysqli_query($conn, $pending_query);
// $pending_data = mysqli_fetch_assoc($pending_result);
// $pending_requests = $pending_data['pending_count'];

// Check if user has any active borrows
// $active_query = "SELECT COUNT(*) as active_count FROM borrow_records 
//                 WHERE user_id = $user_id AND status = 'borrowed' AND due_date >= CURDATE()";
// $active_result = mysqli_query($conn, $active_query);
// $active_data = mysqli_fetch_assoc($active_result);
// $active_borrows = $active_data['active_count'];

// Check for overdue books
// $overdue_query = "SELECT COUNT(*) as overdue_count FROM borrow_records 
//                  WHERE user_id = $user_id AND status = 'borrowed' AND due_date < CURDATE()";
// $overdue_result = mysqli_query($conn, $overdue_query);
// $overdue_data = mysqli_fetch_assoc($overdue_result);
// $overdue_books = $overdue_data['overdue_count'];

// Get user's borrow history
$history_query = "SELECT b.*, br.borrow_date, br.return_date, br.status 
                 FROM borrow_records br 
                 JOIN books b ON br.book_id = b.book_id 
                 WHERE br.user_id = $user_id 
                 ORDER BY br.borrow_date DESC 
                 LIMIT 5";
$history_result = mysqli_query($conn, $history_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Books - Literature Oasis</title>

    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --text-color: #34495e;
            --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            min-height: 100vh;
        }

        .brand-text {
            font-weight: 700;
            color: white;
            font-size: 1.5rem;
        }

        .brand-text span {
            color: var(--secondary-color);
        }

        /* .user-stats {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            padding: 25px;
            margin-bottom: 30px;
            margin-top: 80px;
            backdrop-filter: blur(10px);
        }

        .stat-card {
            text-align: center;
            padding: 20px;
            border-radius: 12px;
            transition: var(--transition);
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        .stat-pending {
            border-top: 4px solid var(--warning-color);
        }

        .stat-active {
            border-top: 4px solid var(--success-color);
        }

        .stat-overdue {
            border-top: 4px solid var(--danger-color);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        } */

        .search-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
        }

        .book-card {
            transition: var(--transition);
            border: none;
            border-radius: 12px;
            overflow: hidden;
            height: 100%;
            box-shadow: var(--card-shadow);
            background: white;
        }

        .book-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .book-image {
            height: 220px;
            object-fit: cover;
            width: 100%;
            background: linear-gradient(45deg, #f8f9fc, #e3e6f0);
        }

        .book-placeholder {
            height: 220px;
            background: linear-gradient(45deg, #f8f9fc, #e3e6f0);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #bdc3c7;
        }

        .category-badge {
            background-color: #e3e6f0;
            color: var(--primary-color);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .btn-borrow {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: var(--transition);
            color: white;
            width: 100%;
        }

        .btn-borrow:hover {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            transform: translateY(-2px);
            color: white;
        }

        .btn-borrow:disabled {
            background: #bdc3c7;
            cursor: not-allowed;
        }

        .history-card {
            background: white;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .history-table th {
            background: var(--primary-color);
            color: white;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .bg-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .bg-borrowed {
            background-color: #d4edda;
            color: #155724;
        }

        .bg-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .bg-overdue {
            background-color: #f8d7da;
            color: #721c24;
        }

        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }

        .section-title {
            position: relative;
            padding-left: 15px;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .section-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 24px;
            width: 6px;
            background: var(--secondary-color);
            border-radius: 3px;
        }

        .footer {
            background: var(--primary-color);
            color: white;
            padding: 30px 0;
            margin-top: 50px;
        }

        @media (max-width: 768px) {
            .stat-card {
                margin-bottom: 15px;
            }

            .book-card {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php  include '../include/navbar.php'; ?>

    <!-- Main Content -->
    <div class="container py-5">

        <!-- User Statistics -->
        <!-- <div class="user-stats">
            <h3 class="section-title">Your Library Stats</h3>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="stat-card stat-pending">
                        <div class="stat-icon text-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h6 class="text-warning">Pending Requests</h6>
                        <h3>
                            <?php echo $pending_requests; ?>
                        </h3>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stat-card stat-active">
                        <div class="stat-icon text-success">
                            <i class="fas fa-book"></i>
                        </div>
                        <h6 class="text-success">Active Borrows</h6>
                        <h3>
                            <?php echo $active_borrows; ?>
                        </h3>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="stat-card stat-overdue">
                        <div class="stat-icon text-danger">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h6 class="text-danger">Overdue Books</h6>
                        <h3>
                            <?php echo $overdue_books; ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Search and Filter Section -->
        <div class="search-section mt-5">
            <h3 class="section-title">Find Your Next Read</h3>
            <div class="row">
                <div class="col-md-8 mb-3">
                    <form method="GET" action="">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" name="search"
                                placeholder="Search books by title, author, or ISBN..."
                                value="<?php echo htmlspecialchars($search); ?>">
                            <button class="btn btn-primary btn-lg" type="submit">
                                <i class="fas fa-search me-1"></i> Search
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 mb-3">
                    <form method="GET" action="">
                        <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
                        <div class="input-group">
                            <select class="form-select form-select-lg" name="category" onchange="this.form.submit()">
                                <option value="all" <?php echo ($category=='all' || empty($category)) ? 'selected' : ''
                                    ; ?>>All Categories</option>
                                <?php 
                                $category_result = mysqli_query($conn, "SELECT DISTINCT category FROM books WHERE category IS NOT NULL AND category != '' ORDER BY category");
                                while($cat = mysqli_fetch_assoc($category_result)): ?>
                                <option value="<?php echo $cat['category']; ?>" <?php echo ($category==$cat['category'])
                                    ? 'selected' : '' ; ?>>
                                    <?php echo $cat['category']; ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Books Grid -->
        <h3 class="section-title">Available Books</h3>
        <?php if(mysqli_num_rows($result) > 0): ?>
        <div class="row">
            <?php while($book = mysqli_fetch_assoc($result)): 
                $request_check = "SELECT status FROM borrow_records 
                  WHERE user_id = $user_id 
                  AND book_id = {$book['book_id']} 
                  AND status IN ('pending','borrowed','overdue')";
                $request_result = mysqli_query($conn, $request_check);
                $already_requested = mysqli_num_rows($request_result) > 0;
                $request_status = $already_requested ? mysqli_fetch_assoc($request_result)['status'] : '';
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card book-card h-100">
                    <?php if(!empty($book['image'])): ?>
                    <img src="../assets/uploads/<?php echo $book['image']; ?>" class="book-image card-img-top"
                        alt="<?php echo $book['title']; ?>">
                    <?php else: ?>
                    <div class="book-placeholder card-img-top">
                        <i class="fas fa-book-open fa-3x"></i>
                    </div>
                    <?php endif; ?>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <?php echo $book['title']; ?>
                        </h5>
                        <p class="card-text text-muted">by
                            <?php echo $book['author']; ?>
                        </p>

                        <?php if($book['category']): ?>
                        <div class="mb-2">
                            <span class="category-badge">
                                <?php echo $book['category']; ?>
                            </span>
                        </div>
                        <?php endif; ?>

                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted">
                                    <i class="fas fa-copy me-1"></i>
                                    <?php echo $book['available_copies']; ?> of
                                    <?php echo $book['total_copies']; ?> available
                                </small>
                            </div>

                            <?php if($book['isbn']): ?>
                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-barcode me-1"></i> ISBN:
                                    <?php echo $book['isbn']; ?>
                                </small>
                            </div>
                            <?php endif; ?>

                            <?php if($already_requested): ?>
                            <?php if($request_status == 'pending'): ?>
                            <button class="btn btn-warning w-100" disabled>
                                <i class="fas fa-clock me-1"></i> Request Pending
                            </button>
                            <?php elseif($request_status == 'borrowed'): ?>
                            <button class="btn btn-success w-100" disabled>
                                <i class="fas fa-check me-1"></i> Already Borrowed
                            </button>
                            <?php elseif($request_status == 'rejected'): ?>
                            <button class="btn btn-secondary w-100" disabled>
                                <i class="fas fa-times me-1"></i> Request Rejected
                            </button>
                            <?php endif; ?>
                            <?php else: ?>
                            <?php if($book['available_copies'] > 0): ?>
                            <form method="POST" action="requestBook_process.php">
                                <input type="hidden" name="book_id" value="<?php echo $book['book_id']; ?>">
                                <button type="submit" class="btn btn-borrow">
                                    <i class="fas fa-hand-paper me-1"></i> Borrow This Book
                                </button>
                            </form>
                            <?php else: ?>
                            <button class="btn btn-secondary w-100" disabled>
                                <i class="fas fa-times me-1"></i> Currently Unavailable
                            </button>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-5">
            <div class="py-5">
                <i class="fas fa-book-open fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">No books found</h4>
                <p class="text-muted mb-4">Try adjusting your search criteria or check back later for new arrivals.</p>
                <a href="?" class="btn btn-primary btn-lg"><i class="fas fa-times me-1"></i> Clear Filters</a>
            </div>
        </div>
        <?php endif; ?>

        <!-- Borrow History -->
        <?php if(mysqli_num_rows($history_result) > 0): ?>
        <div class="row mt-5">
            <div class="col-12">
                <div class="history-card">
                    <div class="card-header bg-white">
                        <h4 class="section-title m-0"><i class="fas fa-history me-2"></i>Your Recent Borrow History</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover history-table">
                                <thead>
                                    <tr>
                                        <th>Book Title</th>
                                        <th>Borrow Date</th>
                                        <th>Return Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($history = mysqli_fetch_assoc($history_result)): ?>
                                    <tr>
                                        <td><strong>
                                                <?php echo $history['title']; ?>
                                            </strong></td>
                                        <td>
                                            <?php echo date('M j, Y', strtotime($history['borrow_date'])); ?>
                                        </td>
                                        <td>
                                            <?php if($history['return_date']): ?>
                                            <?php echo date('M j, Y', strtotime($history['return_date'])); ?>
                                            <?php if(strtotime($history['return_date']) < time() && $history['status'] == 'borrowed'): ?>
                                            <span class="badge bg-danger ms-1">Overdue</span>
                                            <?php endif; ?>
                                            <?php else: ?>
                                            <em class="text-muted">Not returned yet</em>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($history['status'] == 'pending'): ?>
                                            <span class="status-badge bg-pending">Pending</span>
                                            <?php elseif($history['status'] == 'borrowed'): ?>
                                            <span class="status-badge bg-borrowed">Borrowed</span>
                                            <?php elseif($history['status'] == 'rejected'): ?>
                                            <span class="status-badge bg-rejected">Rejected</span>
                                            <?php elseif($history['status'] == 'overdue'): ?>
                                            <span class="status-badge bg-overdue">Overdue</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Toast Notifications -->
    <div class="toast-container">
        <?php if(isset($_GET['request_success'])): ?>
        <div class="toast show align-items-center text-white bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle me-2"></i> Book request submitted successfully! Waiting for admin
                    approval.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
        <?php endif; ?>

        <?php if(isset($_GET['request_error'])): ?>
        <div class="toast show align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-exclamation-circle me-2"></i> Error submitting book request. Please try again.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
        <?php endif; ?>
    </div>




    <script>
        // Auto-hide toasts after 5 seconds
        document.addEventListener('DOMContentLoaded', function () {
            const toasts = document.querySelectorAll('.toast');
            toasts.forEach(toast => {
                setTimeout(() => {
                    const bsToast = new bootstrap.Toast(toast);
                    bsToast.hide();
                }, 3000);
            });
        });
    </script>

</body>

</html>
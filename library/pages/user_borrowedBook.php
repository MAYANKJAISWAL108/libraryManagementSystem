<?php
require '../include/bootstrap.php';
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: /library/index.php?login_error=login_required&login_modal=1");
    exit();
}
require '../include/db.php';

$user_id = $_SESSION['user_id'];

// Fetch borrow records for the logged-in user
$sql = "SELECT br.*, b.title, b.author, b.category 
        FROM borrow_records br
        JOIN books b ON br.book_id = b.book_id
        WHERE br.user_id = $user_id
        ORDER BY br.borrow_date DESC";
$result = mysqli_query($conn, $sql);



// Check if user has any pending borrow requests
$pending_query = "SELECT COUNT(*) as pending_count FROM borrow_records 
                 WHERE user_id = $user_id AND status = 'pending'";
$pending_result = mysqli_query($conn, $pending_query);
$pending_data = mysqli_fetch_assoc($pending_result);
$pending_requests = $pending_data['pending_count'];

// Check if user has any active borrows
$active_query = "SELECT COUNT(*) as active_count FROM borrow_records 
                WHERE user_id = $user_id AND status = 'borrowed' AND due_date >= CURDATE()";
$active_result = mysqli_query($conn, $active_query);
$active_data = mysqli_fetch_assoc($active_result);
$active_borrows = $active_data['active_count'];

// Check for overdue books
$overdue_query = "SELECT COUNT(*) as overdue_count FROM borrow_records 
                 WHERE user_id = $user_id AND status = 'borrowed' AND due_date < CURDATE()";
$overdue_result = mysqli_query($conn, $overdue_query);
$overdue_data = mysqli_fetch_assoc($overdue_result);
$overdue_books = $overdue_data['overdue_count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Borrowed Books - Literature Oasis</title>
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

    .user-stats {
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
    }

    .section-title {
      position: relative;
      padding-left: 15px;
      margin-bottom: 25px;
      font-weight: 700;
      color: var(--primary-color);
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

    .books-table-container {
      background: white;
      border-radius: 15px;
      box-shadow: var(--card-shadow);
      overflow: hidden;
      margin-bottom: 40px;
    }

    .table-header {
      background: var(--primary-color);
      color: white;
      padding: 20px;
    }

    .table th {
      background: var(--primary-color);
      color: white;
      padding: 15px;
      font-weight: 600;
    }

    .table td {
      padding: 15px;
      vertical-align: middle;
    }

    .status-badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
    }

    .bg-borrowed {
      background-color: #d4edda;
      color: #155724;
    }

    .bg-returned {
      background-color: #d1ecf1;
      color: #0c5460;
    }

    .bg-overdue {
      background-color: #f8d7da;
      color: #721c24;
    }

    .bg-pending {
      background-color: #fff3cd;
      color: #856404;
    }

    .book-title {
      font-weight: 600;
      color: var(--primary-color);
    }

    .no-books-container {
      text-align: center;
      padding: 50px 20px;
      background: white;
      border-radius: 15px;
      box-shadow: var(--card-shadow);
    }

    .no-books-icon {
      font-size: 4rem;
      color: #bdc3c7;
      margin-bottom: 20px;
    }

    .action-btn {
      padding: 8px 15px;
      border-radius: 6px;
      font-weight: 600;
      transition: var(--transition);
    }

    .btn-renew {
      background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
      color: white;
      border: none;
    }

    .btn-renew:hover {
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
      color: white;
      transform: translateY(-2px);
    }

    @media (max-width: 768px) {
      .stat-card {
        margin-bottom: 15px;
      }
      
      .table-responsive {
        overflow-x: auto;
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
    <div class="user-stats">
      <h3 class="section-title">Your Library Stats</h3>
      <div class="row">
        <div class="col-md-4 mb-3">
          <div class="stat-card stat-pending">
            <div class="stat-icon text-warning">
              <i class="fas fa-clock"></i>
            </div>
            <h6 class="text-warning">Pending Requests</h6>
            <h3><?php echo $pending_requests; ?></h3>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="stat-card stat-active">
            <div class="stat-icon text-success">
              <i class="fas fa-book"></i>
            </div>
            <h6 class="text-success">Active Borrows</h6>
            <h3><?php echo $active_borrows; ?></h3>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="stat-card stat-overdue">
            <div class="stat-icon text-danger">
              <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h6 class="text-danger">Overdue Books</h6>
            <h3><?php echo $overdue_books; ?></h3>
          </div>
        </div>
      </div>
    </div>

    <!-- Borrowed Books Table -->
    <div class="books-table-container">
      <div class="table-header">
        <h3 class="m-0"><i class="fas fa-book me-2"></i>My Borrowed Books</h3>
      </div>
      
      <?php if(mysqli_num_rows($result) > 0): ?>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Book Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Borrow Date</th>
                <th>Due Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <!-- <th>Actions</th> -->
              </tr>
            </thead>
            <tbody>
              <?php while($row = mysqli_fetch_assoc($result)): 
                $isOverdue = ($row['status'] === 'borrowed' && $row['due_date'] && strtotime($row['due_date']) < time());
              ?>
                <tr>
                  <td><span class="book-title"><?= htmlspecialchars($row['title']) ?></span></td>
                  <td><?= htmlspecialchars($row['author']) ?></td>
                  <td>
                    <?php if($row['category']): ?>
                      <span class="badge bg-light text-dark"><?= htmlspecialchars($row['category']) ?></span>
                    <?php else: ?>
                      <span class="text-muted">N/A</span>
                    <?php endif; ?>
                  </td>
                  <td><?= date('M j, Y', strtotime($row['borrow_date'])) ?></td>
                  <td>
                    <?php if($row['due_date']): ?>
                      <?= date('M j, Y', strtotime($row['due_date'])) ?>
                    <?php else: ?>
                      <span class="text-muted">Not set</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if($row['return_date']): ?>
                      <?= date('M j, Y', strtotime($row['return_date'])) ?>
                    <?php else: ?>
                      <span class="text-muted">Not returned</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if($row['status'] === 'borrowed'): ?>
                      <?php if($isOverdue): ?>
                        <span class="status-badge bg-overdue">Overdue</span>
                      <?php else: ?>
                        <span class="status-badge bg-borrowed">Borrowed</span>
                      <?php endif; ?>
                    <?php elseif($row['status'] === 'returned'): ?>
                      <span class="status-badge bg-returned">Returned</span>
                    <?php elseif($row['status'] === 'pending'): ?>
                      <span class="status-badge bg-pending">Pending</span>
                    <?php else: ?>
                      <span class="status-badge bg-borrowed"><?= ucfirst($row['status']) ?></span>
                    <?php endif; ?>
                  </td>
                  <!-- <td>
                    <?php if($row['status'] === 'borrowed' && !$isOverdue): ?>
                      <button class="action-btn btn-renew">
                        <i class="fas fa-sync-alt me-1"></i> Renew
                      </button>
                    <?php elseif($isOverdue): ?>
                      <button class="action-btn btn-renew">
                        <i class="fas fa-exclamation-circle me-1"></i> Return
                      </button>
                    <?php else: ?>
                      <span class="text-muted">No actions</span>
                    <?php endif; ?>
                  </td> -->
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="no-books-container">
          <div class="no-books-icon">
            <i class="fas fa-book-open"></i>
          </div>
          <h4 class="text-muted">You haven't borrowed any books yet</h4>
          <p class="text-muted mb-4">Explore our collection to find your next great read</p>
          <a href="books.php" class="btn btn-primary btn-lg">
            <i class="fas fa-book me-1"></i> Browse Books
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- <script>
    // Simple animation for stats cards
    document.addEventListener('DOMContentLoaded', function() {
      const statCards = document.querySelectorAll('.stat-card');
      statCards.forEach((card, index) => {
        setTimeout(() => {
          card.style.opacity = 1;
          card.style.transform = 'translateY(0)';
        }, index * 200);
      });
    });
  </script> -->
</body>
</html>
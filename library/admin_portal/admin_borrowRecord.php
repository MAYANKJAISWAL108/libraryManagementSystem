<?php
require '../include/bootstrap.php';
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /library/index.php?login_error=admin_only");
    exit();
}
require '../include/db.php';

// Approve/Reject action
if(isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if($action == "approve") {
        // Approve: set status = borrowed, set due_date = +28 days
        $due_date = date('Y-m-d', strtotime('+28 days'));
        $update_query = "UPDATE borrow_records SET status='borrowed', due_date='$due_date' WHERE borrow_id=$id";
        
        if(mysqli_query($conn, $update_query)) {
            // Update available copies
            $book_id_result = mysqli_query($conn, "SELECT book_id FROM borrow_records WHERE borrow_id=$id");
            if($book_id_result && mysqli_num_rows($book_id_result) > 0) {
                $book_id_row = mysqli_fetch_assoc($book_id_result);
                $book_id = $book_id_row['book_id'];
                mysqli_query($conn, "UPDATE books SET available_copies = available_copies - 1 WHERE book_id=$book_id");
                
                // Add notification for user
                $user_id_result = mysqli_query($conn, "SELECT user_id FROM borrow_records WHERE borrow_id=$id");
                if($user_id_result && mysqli_num_rows($user_id_result) > 0) {
                    $user_id_row = mysqli_fetch_assoc($user_id_result);
                    $user_id = $user_id_row['user_id'];
                    
                    $book_title_result = mysqli_query($conn, "SELECT title FROM books WHERE book_id=$book_id");
                    if($book_title_result && mysqli_num_rows($book_title_result) > 0) {
                        $book_title_row = mysqli_fetch_assoc($book_title_result);
                        $book_title = mysqli_real_escape_string($conn, $book_title_row['title']);
                        
                        $message = "Your request for '$book_title' has been approved. Due date: $due_date.";
                        $message_escaped = mysqli_real_escape_string($conn, $message);
                        mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ($user_id, '$message_escaped')");
                    }
                }
            }
        }
        
    } elseif($action == "reject") {
        // Reject: mark as rejected
        $update_query = "UPDATE borrow_records SET status='rejected' WHERE borrow_id=$id";
        
        if(mysqli_query($conn, $update_query)) {
            // Add notification for user
            $user_id_result = mysqli_query($conn, "SELECT user_id FROM borrow_records WHERE borrow_id=$id");
            if($user_id_result && mysqli_num_rows($user_id_result) > 0) {
                $user_id_row = mysqli_fetch_assoc($user_id_result);
                $user_id = $user_id_row['user_id'];
                
                $book_id_result = mysqli_query($conn, "SELECT book_id FROM borrow_records WHERE borrow_id=$id");
                if($book_id_result && mysqli_num_rows($book_id_result) > 0) {
                    $book_id_row = mysqli_fetch_assoc($book_id_result);
                    $book_id = $book_id_row['book_id'];
                    
                    $book_title_result = mysqli_query($conn, "SELECT title FROM books WHERE book_id=$book_id");
                    if($book_title_result && mysqli_num_rows($book_title_result) > 0) {
                        $book_title_row = mysqli_fetch_assoc($book_title_result);
                        $book_title = mysqli_real_escape_string($conn, $book_title_row['title']);
                        
                        $message = "Your request for '$book_title' has been rejected.";
                        $message_escaped = mysqli_real_escape_string($conn, $message);
                        mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ($user_id, '$message_escaped')");
                    }
                }
            }
        }
    }
    
    // Refresh the page to show updated status
    header("Location: admin_borrowRecord.php");
    exit();
}

// Fetch pending requests
$pending_sql = "SELECT br.borrow_id, u.username, b.title, b.author, br.borrow_date 
        FROM borrow_records br
        JOIN users u ON br.user_id = u.user_id
        JOIN books b ON br.book_id = b.book_id
        WHERE br.status='pending'";
$pending_result = mysqli_query($conn, $pending_sql);

// Get books that are still borrowed (not returned yet)
$borrowed_sql = "SELECT br.*, u.username, b.title 
                 FROM borrow_records br
                 JOIN users u ON br.user_id = u.user_id
                 JOIN books b ON br.book_id = b.book_id
                 WHERE br.status IN ('borrowed', 'overdue')
                 ORDER BY br.borrow_date";
$borrowed_result = mysqli_query($conn, $borrowed_sql);


// Fetch all borrow history
$history_sql = "SELECT br.borrow_id, u.username, b.title, b.author, 
                       br.borrow_date, br.due_date, br.return_date, br.status
                FROM borrow_records br
                JOIN users u ON br.user_id = u.user_id
                JOIN books b ON br.book_id = b.book_id
                ORDER BY br.borrow_date DESC";
$history_result = mysqli_query($conn, $history_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Borrow Records- Literature Oasis</title>
  <style>
    body {
      background-color: #f8f9fc;
      font-family: 'Nunito', sans-serif;
    }

    .main-content {
      margin-left: 250px;
      padding: 20px;
      transition: margin-left 0.3s;
    }

    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, .15);
      margin-bottom: 25px;
    }

    .card-header {
      background: #f8f9fc;
      border-bottom: 1px solid #e3e6f0;
      padding: 15px 20px;
      font-weight: 700;
      color: #5a5c69;
    }

    .table th {
      background: #2c3e50;
      color: #fff;
      padding: 15px;
    }

    .table td {
      padding: 15px;
      vertical-align: middle;
    }

    .action-btn {
      margin: 0 3px;
      border-radius: 5px;
      font-weight: 500;
      padding: 5px 10px;
    }

    .search-box {
      max-width: 300px;
    }

    .status-badge {
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: bold;
    }

    .bg-pending {
      background-color: #f39c12;
      color: white;
    }

    .bg-borrowed {
      background-color: #3498db;
      color: white;
    }

    .bg-returned {
      background-color: #27ae60;
      color: white;
    }

    .bg-rejected {
      background-color: #e74a3b;
      color: white;
    }

    .bg-overdue {
      background-color: #e67e22;
      color: white;
    }

    .section-title {
      border-left: 4px solid #2c3e50;
      padding-left: 10px;
      margin-bottom: 20px;
    }

    .history-table {
      font-size: 0.9rem;
    }

    .history-table th,
    .history-table td {
      padding: 10px;
    }
  </style>
</head>

<body>

  <?php include "../include/admin_sidebar.php"; ?>

  <div class="main-content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Borrow Management</h1>
    </div>

    <!-- Pending Requests Section -->
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h6 style="color: black;" class="m-0 font-weight-bold">Pending Borrow Requests</h6>
        <div class="search-box">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search requests..." id="pendingSearch">
            <button class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="pendingTable">
            <thead>
              <tr>
                <th>Request ID</th>
                <th>User</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Request Date</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if($pending_result && mysqli_num_rows($pending_result) > 0): 
                                while($row = mysqli_fetch_assoc($pending_result)): ?>
              <tr>
                <td><strong>#
                    <?php echo htmlspecialchars($row['borrow_id']); ?>
                  </strong></td>
                <td>
                  <?php echo htmlspecialchars($row['username']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['title']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['author']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['borrow_date']); ?>
                </td>
                <td>
                  <span class="status-badge bg-pending">Pending</span>
                </td>
                <td>
                  <!-- Approve Button -->
                  <a href="?action=approve&id=<?= $row['borrow_id'] ?>" class="btn btn-success btn-sm action-btn"
                    onclick="return confirm('Approve this borrow request?')">
                    <i class="fas fa-check"></i> Approve
                  </a>

                  <!-- Reject Button -->
                  <a href="?action=reject&id=<?= $row['borrow_id'] ?>" class="btn btn-danger btn-sm action-btn"
                    onclick="return confirm('Reject this borrow request?')">
                    <i class="fas fa-times"></i> Reject
                  </a>
                </td>
              </tr>
              <?php endwhile; else: ?>
              <tr>
                <td colspan="7" class="text-center text-muted py-4">
                  <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                  <h5>No Pending Requests</h5>
                  <p>All borrow requests have been processed.</p>
                </td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Borrow History Section -->
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h6 style="color: black;" class="m-0 font-weight-bold">Borrow History</h6>
        <div class="search-box">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search history..." id="historySearch">
            <button class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover history-table" id="historyTable">
            <thead>
              <tr>
                <th>Borrow ID</th>
                <th>User</th>
                <th>Book Title</th>
                <th>Author</th>
                <th>Borrow Date</th>
                <th>Due Date</th>
                <th>Return Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php if($history_result && mysqli_num_rows($history_result) > 0): 
                                while($row = mysqli_fetch_assoc($history_result)): 
                                    $status_class = '';
                                    switch($row['status']) {
                                        case 'pending': $status_class = 'bg-pending'; break;
                                        case 'borrowed': $status_class = 'bg-borrowed'; break;
                                        case 'returned': $status_class = 'bg-returned'; break;
                                        case 'rejected': $status_class = 'bg-rejected'; break;
                                        case 'overdue': $status_class = 'bg-overdue'; break;
                                        default: $status_class = 'bg-pending';
                                    }
                            ?>
              <tr>
                <td><strong>#
                    <?php echo htmlspecialchars($row['borrow_id']); ?>
                  </strong></td>
                <td>
                  <?php echo htmlspecialchars($row['username']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['title']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['author']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['borrow_date']); ?>
                </td>
                <td>
                  <?php echo $row['due_date'] ? htmlspecialchars($row['due_date']) : 'N/A'; ?>
                </td>
                <td>
                  <?php echo $row['return_date'] ? htmlspecialchars($row['return_date']) : 'Not returned'; ?>
                </td>
                <td>
                  <span class="status-badge <?php echo $status_class; ?>">
                    <?php echo ucfirst(htmlspecialchars($row['status'])); ?>
                  </span>
                </td>
              </tr>
              <?php endwhile; else: ?>
              <tr>
                <td colspan="8" class="text-center text-muted py-4">
                  <i class="fas fa-history fa-3x text-muted mb-3"></i>
                  <h5>No Borrow History</h5>
                  <p>No borrowing records found in the system.</p>
                </td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Currently Borrowed Books (Return Section) -->
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h6 style="color: black;" class="m-0 font-weight-bold">Currently Borrowed Books</h6>
        <div class="search-box">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search borrowed..." id="borrowedSearch">
            <button class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="borrowedTable">
            <thead>
              <tr>
                <th>Borrow ID</th>
                <th>User</th>
                <th>Book Title</th>
                <th>Borrow Date</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if($borrowed_result && mysqli_num_rows($borrowed_result) > 0): 
                        while($row = mysqli_fetch_assoc($borrowed_result)): 
                            $status_class = ($row['status'] == 'borrowed') ? 'bg-borrowed' : 'bg-overdue';
                    ?>
              <tr>
                <td><strong>#
                    <?php echo htmlspecialchars($row['borrow_id']); ?>
                  </strong></td>
                <td>
                  <?php echo htmlspecialchars($row['username']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['title']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['borrow_date']); ?>
                </td>
                <td>
                  <?php echo htmlspecialchars($row['due_date']); ?>
                </td>
                <td>
                  <span class="status-badge <?php echo $status_class; ?>">
                    <?php echo ucfirst(htmlspecialchars($row['status'])); ?>
                  </span>
                </td>
                <td>
                  <a href="admin_returnBook.php?borrow_id=<?= $row['borrow_id'] ?>"
                    class="btn btn-sm btn-success action-btn" onclick="return confirm('Mark this book as returned?');">
                    <i class="fas fa-undo"></i> Return
                  </a>
                </td>
              </tr>
              <?php endwhile; else: ?>
              <tr>
                <td colspan="7" class="text-center text-muted py-4">
                  <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                  <h5>No borrowed books pending return</h5>
                  <p>All borrowed books have been returned.</p>
                </td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>


  </div>

  <script>
    // Search functionality for pending requests
    document.getElementById('pendingSearch').addEventListener('keyup', function () {
      let filter = this.value.toLowerCase();
      document.querySelectorAll('#pendingTable tbody tr').forEach(row => {
        let username = row.cells[1].textContent.toLowerCase();
        let title = row.cells[2].textContent.toLowerCase();
        let author = row.cells[3].textContent.toLowerCase();
        if (username.includes(filter) || title.includes(filter) || author.includes(filter)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });

    // Search functionality for borrow history
    document.getElementById('historySearch').addEventListener('keyup', function () {
      let filter = this.value.toLowerCase();
      document.querySelectorAll('#historyTable tbody tr').forEach(row => {
        let username = row.cells[1].textContent.toLowerCase();
        let title = row.cells[2].textContent.toLowerCase();
        let author = row.cells[3].textContent.toLowerCase();
        let status = row.cells[7].textContent.toLowerCase();
        if (username.includes(filter) || title.includes(filter) || author.includes(filter) || status.includes(filter)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  </script>
</body>

</html>
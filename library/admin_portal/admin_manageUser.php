<?php
include '../include/bootstrap.php';
session_start();

// Prevent cached pages after logout
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: /library/index.php?login_error=invalid&login_modal=1');
    exit();
}

include '../include/db.php';

// Fetch all users
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
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
    </style>
</head>

<body>

    <?php include "../include/admin_sidebar.php"; ?>

    <div class="main-content">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">User Management</h1>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 style="color: black;" class="m-0 font-weight-bold ">All Users</h6>
                <div class="search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search users..." id="searchInput">
                        <button class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="userTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(mysqli_num_rows($result) > 0): 
              while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><strong>#
                                        <?php echo $row['user_id']; ?>
                                    </strong></td>
                                <td>
                                    <?php echo htmlspecialchars($row['username']); ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($row['email']); ?>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-<?php echo $row['role'] === 'admin' ? 'danger' : 'success'; ?>">
                                        <?php echo ucfirst($row['role']); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php echo $row['created_at']; ?>
                                </td>
                                <td>
                                    <!-- View -->
                                    <button class="btn btn-info btn-sm action-btn view-btn" data-bs-toggle="modal"
                                        data-bs-target="#viewUserModal" data-id="<?php echo $row['user_id']; ?>"
                                        data-username="<?php echo htmlspecialchars($row['username']); ?>"
                                        data-email="<?php echo htmlspecialchars($row['email']); ?>"
                                        data-role="<?php echo $row['role']; ?>"
                                        data-created="<?php echo $row['created_at']; ?>">
                                        <i class="fas fa-eye"></i> View
                                    </button>

                                    <!-- Edit -->
                                    <button class="btn btn-primary btn-sm action-btn edit-btn" data-bs-toggle="modal"
                                        data-bs-target="#editUserModal" data-id="<?php echo $row['user_id']; ?>"
                                        data-username="<?php echo htmlspecialchars($row['username']); ?>"
                                        data-email="<?php echo htmlspecialchars($row['email']); ?>"
                                        data-role="<?php echo $row['role']; ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    <!-- Delete -->
                                    <?php if ($row['role'] === 'admin'): ?>
                                    <button class="btn btn-danger btn-sm action-btn" disabled
                                        title="Admin cannot be deleted">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                    <?php else: ?>
                                    <a href="deleteUser_process.php?id=<?php echo $row['user_id']; ?>"
                                        class="btn btn-danger btn-sm action-btn"
                                        onclick="return confirm('Are you sure you want to delete this user?');">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No users found</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Details</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>ID:</strong> <span id="viewUserId"></span></p>
                    <p><strong>Username:</strong> <span id="viewUserName"></span></p>
                    <p><strong>Email:</strong> <span id="viewUserEmail"></span></p>
                    <p><strong>Role:</strong> <span id="viewUserRole"></span></p>
                    <p><strong>Created At:</strong> <span id="viewUserCreated"></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="admin_editUser.php">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editUserId">
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" id="editUserName" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" id="editUserEmail" required>
                        </div>
                        <div class="mb-3">
                            <label>Role</label>
                            <select class="form-select" name="role" id="editUserRole">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // View
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('viewUserId').textContent = this.dataset.id;
                document.getElementById('viewUserName').textContent = this.dataset.username;
                document.getElementById('viewUserEmail').textContent = this.dataset.email;
                document.getElementById('viewUserRole').textContent = this.dataset.role;
                document.getElementById('viewUserCreated').textContent = this.dataset.created;
            });
        });

        // Edit
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('editUserId').value = this.dataset.id;
                document.getElementById('editUserName').value = this.dataset.username;
                document.getElementById('editUserEmail').value = this.dataset.email;
                document.getElementById('editUserRole').value = this.dataset.role;
            });
        });

        // Search
        document.getElementById('searchInput').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            document.querySelectorAll('#userTable tbody tr').forEach(row => {
                let username = row.cells[1].textContent.toLowerCase();
                let email = row.cells[2].textContent.toLowerCase();
                if (username.includes(filter) || email.includes(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
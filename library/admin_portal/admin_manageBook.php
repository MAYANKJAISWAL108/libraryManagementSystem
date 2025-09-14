<?php
include '../include/bootstrap.php';
session_start();

// Prevent cached pages from being shown after logout
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: /library/index.php?login_error=invalid&login_modal=1');
    exit();
}

include '../include/db.php';

// Fetch all books
$query = "SELECT * FROM books";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Book Management</title>

  <style>
    :root {
      --primary-color: #4e73df;
      --danger-color: #e74a3b;
      --warning-color: #f6c23e;
    }
    body { background:#f8f9fc; font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; }
    .main-content { margin-left:250px; padding:20px; transition: margin-left .3s; }
    .card { border-radius:10px; box-shadow:0 4px 20px rgba(0,0,0,0.05); margin-bottom:20px; }
    .card-header { background:#fff; border-bottom:1px solid #e9ecef; padding:16px; font-weight:700; color:#333; }
    .table th { background:var(--primary-color); color:#fff; }
    .table td { vertical-align: middle; }
    .action-btn { margin:0 4px; }
    .book-image { width:60px; height:80px; object-fit:cover; border-radius:4px; box-shadow:0 2px 6px rgba(0,0,0,0.08); }
    .status-available { color: #1cc88a; font-weight:600; }
    .status-limited { color: var(--warning-color); font-weight:600; }
    .status-unavailable { color: var(--danger-color); font-weight:600; }
    .img-thumb { max-height:150px; display:block; }
  </style>
</head>
<body>

<?php include "../include/admin_sidebar.php"; ?>

<div class="main-content">
  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3">Book Management</h1>
  </div>

  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <div>All Books</div>
      <div style="max-width:320px;">
        <div class="input-group">
          <input id="searchInput" type="text" class="form-control" placeholder="Search books (title, author, isbn)">
          <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover" id="bookTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Cover</th>
              <th>Title</th>
              <th>Author</th>
              <th>ISBN</th>
              <th>Category</th>
              <th>Copies</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
              <?php while ($row = mysqli_fetch_assoc($result)): 
                // Determine status
                if ($row['available_copies'] == 0) {
                  $status = 'Unavailable'; $statusClass = 'status-unavailable';
                } elseif ($row['available_copies'] < $row['total_copies'] / 2) {
                  $status = 'Limited'; $statusClass = 'status-limited';
                } else {
                  $status = 'Available'; $statusClass = 'status-available';
                }
              ?>
              <tr>
                <td><strong>#<?php echo (int)$row['book_id']; ?></strong></td>
                <td>
                  <?php if (!empty($row['image'])): ?>
                    <img src="../assets/uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="cover" class="book-image">
                  <?php else: ?>
                    <div class="book-image bg-light d-flex align-items-center justify-content-center">
                      <i class="fas fa-book text-secondary"></i>
                    </div>
                  <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['author']); ?></td>
                <td><?php echo $row['isbn'] ? htmlspecialchars($row['isbn']) : '<span class="text-muted">N/A</span>'; ?></td>
                <td><?php echo $row['category'] ? htmlspecialchars($row['category']) : '<span class="text-muted">N/A</span>'; ?></td>
                <td><strong><?php echo (int)$row['available_copies']; ?></strong> / <?php echo (int)$row['total_copies']; ?></td>
                <td class="<?php echo $statusClass; ?>"><?php echo $status; ?></td>
                <td>
                  <!-- View button (populates and shows view modal) -->
                  <button type="button" class="btn btn-info btn-sm action-btn view-btn"
                    data-id="<?php echo (int)$row['book_id']; ?>"
                    data-title="<?php echo htmlspecialchars($row['title']); ?>"
                    data-author="<?php echo htmlspecialchars($row['author']); ?>"
                    data-isbn="<?php echo htmlspecialchars($row['isbn']); ?>"
                    data-category="<?php echo htmlspecialchars($row['category']); ?>"
                    data-total="<?php echo (int)$row['total_copies']; ?>"
                    data-available="<?php echo (int)$row['available_copies']; ?>"
                    data-image="<?php echo htmlspecialchars($row['image']); ?>"
                    data-created="<?php echo htmlspecialchars($row['added_at']); ?>">
                    <i class="fas fa-eye"></i> View
                  </button>

                  <!-- Edit button (populates and shows edit modal) -->
                  <button type="button" class="btn btn-primary btn-sm action-btn edit-btn"
                    data-id="<?php echo (int)$row['book_id']; ?>"
                    data-title="<?php echo htmlspecialchars($row['title']); ?>"
                    data-author="<?php echo htmlspecialchars($row['author']); ?>"
                    data-isbn="<?php echo htmlspecialchars($row['isbn']); ?>"
                    data-category="<?php echo htmlspecialchars($row['category']); ?>"
                    data-total="<?php echo (int)$row['total_copies']; ?>"
                    data-available="<?php echo (int)$row['available_copies']; ?>"
                    data-image="<?php echo htmlspecialchars($row['image']); ?>">
                    <i class="fas fa-edit"></i> Edit
                  </button>

                  <a href="admin_deleteBook.php?id=<?php echo (int)$row['book_id']; ?>" class="btn btn-danger btn-sm action-btn" onclick="return confirm('Delete this book?');">
                    <i class="fas fa-trash"></i> Delete
                  </a>
                </td>
              </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr><td colspan="9" class="text-center py-4">
                <i class="fas fa-book fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No books found</h5>
              </td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- View Book Modal -->
<div class="modal fade" id="viewBookModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Book Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4 text-center mb-3">
            <img id="viewBookImage" src="" alt="Book Cover" class="img-fluid rounded" style="max-height:300px; object-fit:cover; display:none;">
          </div>
          <div class="col-md-8">
            <h3 id="viewBookTitle" class="mb-3"></h3>
            <p><strong>Author:</strong> <span id="viewBookAuthor"></span></p>
            <p><strong>ISBN:</strong> <span id="viewBookIsbn" class="text-muted">N/A</span></p>
            <p><strong>Category:</strong> <span id="viewBookCategory" class="text-muted">N/A</span></p>
            <p><strong>Total Copies:</strong> <span id="viewBookTotal"></span></p>
            <p><strong>Available Copies:</strong> <span id="viewBookAvailable"></span></p>
            <p><strong>Status:</strong> <span id="viewBookStatus"></span></p>
            <p><strong>Added On:</strong> <span id="viewBookCreated"></span></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Edit Book Modal -->
<div class="modal fade" id="editBookModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" enctype="multipart/form-data" action="admin_editBook.php">
        <div class="modal-header">
          <h5 class="modal-title">Edit Book</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="editBookId">

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="editTitle" class="form-label">Title <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="editTitle" name="title" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="editAuthor" class="form-label">Author <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="editAuthor" name="author" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="editIsbn" class="form-label">ISBN</label>
              <input type="text" class="form-control" id="editIsbn" name="isbn">
            </div>
            <div class="col-md-6 mb-3">
              <label for="editCategory" class="form-label">Category</label>
              <select class="form-select" id="editCategory" name="category">
                <option value="">Select Category</option>
                <option>Fiction</option>
                <option>Non-Fiction</option>
                <option>Science</option>
                <option>Technology</option>
                <option>History</option>
                <option>Biography</option>
                <option>Children</option>
                <option>Other</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="editTotalCopies" class="form-label">Total Copies</label>
              <input type="number" class="form-control" id="editTotalCopies" name="total_copies" min="1">
            </div>
            <div class="col-md-6 mb-3">
              <label for="editAvailableCopies" class="form-label">Available Copies</label>
              <input type="number" class="form-control" id="editAvailableCopies" name="available_copies" min="0">
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Current Image</label>
            <div id="currentImageContainer" class="mb-2"></div>

            <label for="editImage" class="form-label">Change Image</label>
            <input type="file" class="form-control" id="editImage" name="image" accept="image/*">
            <div class="form-text">Leave empty to keep existing image</div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="edit_book" class="btn btn-primary">Update Book</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // Search function
  const searchInput = document.getElementById('searchInput');
  if (searchInput) {
    searchInput.addEventListener('keyup', function () {
      const q = this.value.toLowerCase();
      document.querySelectorAll('#bookTable tbody tr').forEach(row => {
        const title = row.cells[2].textContent.toLowerCase();
        const author = row.cells[3].textContent.toLowerCase();
        const isbn = row.cells[4].textContent.toLowerCase();
        row.style.display = (title.includes(q) || author.includes(q) || isbn.includes(q)) ? '' : 'none';
      });
    });
  }

  // VIEW buttons
  const viewButtons = document.querySelectorAll('.view-btn');
  viewButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      // populate view modal
      document.getElementById('viewBookTitle').textContent = this.dataset.title || '';
      document.getElementById('viewBookAuthor').textContent = this.dataset.author || '';
      document.getElementById('viewBookIsbn').textContent = this.dataset.isbn || 'N/A';
      document.getElementById('viewBookCategory').textContent = this.dataset.category || 'N/A';
      document.getElementById('viewBookTotal').textContent = this.dataset.total || '';
      document.getElementById('viewBookAvailable').textContent = this.dataset.available || '';
      document.getElementById('viewBookCreated').textContent = this.dataset.created || '';

      // status
      const available = parseInt(this.dataset.available || '0', 10);
      const total = parseInt(this.dataset.total || '0', 10);
      const statusElement = document.getElementById('viewBookStatus');
      if (available === 0) {
        statusElement.textContent = 'Unavailable';
        statusElement.className = 'text-danger';
      } else if (available < total / 2) {
        statusElement.textContent = 'Limited';
        statusElement.className = 'text-warning';
      } else {
        statusElement.textContent = 'Available';
        statusElement.className = 'text-success';
      }

      // image
      const img = document.getElementById('viewBookImage');
      if (this.dataset.image) {
        img.src = "../assets/uploads/" + this.dataset.image;
        img.style.display = "block";
      } else {
        img.style.display = "none";
      }

      // show modal
      const vm = new bootstrap.Modal(document.getElementById('viewBookModal'));
      vm.show();
    });
  });

  // EDIT buttons
  const editButtons = document.querySelectorAll('.edit-btn');
  editButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      document.getElementById('editBookId').value = this.dataset.id || '';
      document.getElementById('editTitle').value = this.dataset.title || '';
      document.getElementById('editAuthor').value = this.dataset.author || '';
      document.getElementById('editIsbn').value = this.dataset.isbn || '';
      document.getElementById('editCategory').value = this.dataset.category || '';
      document.getElementById('editTotalCopies').value = this.dataset.total || '';
      document.getElementById('editAvailableCopies').value = this.dataset.available || '';

      // current image preview
      const currentImageContainer = document.getElementById('currentImageContainer');
      if (this.dataset.image) {
        currentImageContainer.innerHTML = `<img src="../assets/uploads/${this.dataset.image}" alt="current" class="img-thumb img-thumbnail">`;
      } else {
        currentImageContainer.innerHTML = '<div class="text-muted">No image available</div>';
      }

      // clear file input
      document.getElementById('editImage').value = '';

      // show modal
      const em = new bootstrap.Modal(document.getElementById('editBookModal'));
      em.show();
    });
  });

  // clear current image preview when edit modal hidden
  const editModalEl = document.getElementById('editBookModal');
  if (editModalEl) {
    editModalEl.addEventListener('hidden.bs.modal', function () {
      const container = document.getElementById('currentImageContainer');
      if (container) container.innerHTML = '';
      const fileInput = document.getElementById('editImage');
      if (fileInput) fileInput.value = '';
    });
  }
});
</script>

</body>
</html>

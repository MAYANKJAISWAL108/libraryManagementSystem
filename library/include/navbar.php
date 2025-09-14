<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>




  <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-dark fixed-top"
    style="background-color: rgba(44, 62, 80, 1)">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <!-- <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEVv7e-TL9ZwsBD8QUIjuLIEVKJvzTsdTlJw&s" alt="img" height="50"> -->
        <img
          src="https://img.freepik.com/premium-vector/bookish-oasis-student-sitting-books-emblem-literary-retreat-student-chair-with-books-logo_706143-96993.jpg"
          alt="img" height="40" class="rounded">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5">
          <li class="nav-item">
            <a class="nav-link text-white" aria-current="page" href="/library/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/library/pages/about.php">About Us</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="/library/pages/service.php">Our Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/library/pages/contact.php">Contact Us</a>
          </li>
          <?php if(isset($_SESSION['username'])): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Menu
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/library/pages/user_borrowedBook.php">Borrowed Books</a></li>
              <li><a class="dropdown-item" href="/library/pages/allBook.php">All Books</a></li>
            </ul>
          </li>
          <?php endif; ?>
        </ul>

        <div class="d-flex gap-3">
          <?php if(isset($_SESSION['username'])): ?>
          <span class="welocme-message text-white">Welcome,
            <?= htmlspecialchars($_SESSION['username']) ?>
          </span>
          <a href="/library/pages/logout_process.php" class="btn btn-danger mx-3">Logout</a>
          <?php else: ?>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
          <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registerModal">Sign Up</button>
          <?php endif; ?>
        </div>
      </div>
  </nav>



  <!-- Login Modal-->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">User Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form method="post" action="/library/pages/login_process.php">
            <!-- Error Message -->
            <?php if(isset($_GET['login_error'])): ?>
            <div class="alert alert-danger">Invalid username/email or password</div>
            <?php endif; ?>

            <!-- Username / Email -->
            <div class="mb-3">
              <label for="login_input" class="form-label">Username or Email</label>
              <input type="text" class="form-control" id="login_input" name="login_input"
                placeholder="Enter username or email" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter password"
                required>
            </div>

            <!-- Footer Buttons -->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Login</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <!-- Register Modal -->
  <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel">Sign Up</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form method="post" action="/library/pages/register_process.php">
            <?php if(isset($_GET['register_error1'])): ?>
            <div class="alert alert-danger">All Fields Required!</div>
            <?php elseif(isset($_GET['register_error2'])): ?>
            <div class="alert alert-danger">Username or Email Already Exist!</div>
            <?php elseif(isset($_GET['server_error'])): ?>
            <div class="alert alert-danger">Server Error!</div>
            <?php elseif(isset($_GET['register_success'])): ?>
            <div class="alert alert-success">Registration Successful! You can login now.</div>
            <?php endif; ?>

            <!-- Username -->
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter username"
                required>
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label for="password" class="form-label">New Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter password"
                required>
            </div>

            <!-- phone -->
            <div class="mb-3">
              <label for="phone" class="form-label">Phone</label>
              <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required>
            </div>

            <!-- address -->
            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <textarea class="form-control" id="address" name="address" rows="2" placeholder="Enter your address"
                required></textarea>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Create Account</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>

  <script>
    //code to display modal if login details is wrong
    document.addEventListener('DOMContentLoaded', function () {
    <?php if (isset($_GET['login_modal'])): ?>
      var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
      loginModal.show();
      <?php endif; ?>
  });

    //code to display register modal if registration not successsful
    document.addEventListener('DOMContentLoaded', function () {
    <?php if (isset($_GET['register_modal'])): ?>
      var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
      registerModal.show();

      if (window.history.replaceState) {
        const url = new URL(window.location);
        url.search = ''; // clear query string
        window.history.replaceState({}, document.title, url);
      }
    <?php endif; ?>
  });
  </script>




</body>

</html>
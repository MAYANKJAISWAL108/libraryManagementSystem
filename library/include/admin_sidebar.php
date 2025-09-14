<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            padding: 20px 0;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .sidebar-brand {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            /* margin-bottom: 10px; */
        }

        /* 
        .nav-item {
            margin: 10px 0;
        } */

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            border-radius: 5px;
            margin: 5px 15px;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
            transition: margin-left 0.3s ease;
        }

        #sidebarToggle {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1001;
            display: none;
        }

        /* Hide sidebar on mobile */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            #sidebarToggle {
                display: block;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <button class="btn btn-dark" id="sidebarToggle">☰</button>

    <!-- Sidebar -->
    <div class="sidebar col-md-3 col-lg-2 d-md-block" id="sidebar">
        <div class="sidebar-brand">
            <img src="https://img.freepik.com/premium-vector/bookish-oasis-student-sitting-books-emblem-literary-retreat-student-chair-with-books-logo_706143-96993.jpg"
                alt="img" height="100">
            <h4 class="text-white py-3">Literature Oasis</h4>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="admin_dashboard.php">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_manageUser.php">
                    <i class="fas fa-users"></i> Manage Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_manageBook.php">
                    <i class="fas fa-book"></i> Manage Books
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_borrowRecord.php">
                    <i class="fas fa-exchange-alt"></i> Borrow Records
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="admin_notification.php">
                    <i class="fas fa-bell"></i> Notifications
                </a>
            </li> -->
            <li class="nav-item" style="margin-top: 
            50px;">
                <a class="nav-link btn btn-danger" href="admin_logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>

    <script>
        document.getElementById("sidebarToggle").addEventListener("click", function () {
            document.getElementById("sidebar").classList.toggle("show");
        });
    </script>

</body>

</html>
<?php 
session_start();
include 'conn.php';
include 'function.php';

if(isset($_POST['btnadduser'])) {
    // Function to add user
    adduser();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background-color: #007bff; /* Blue */
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #ffcc00 !important; /* Bright Yellow */
        }
        .card-header {
            background-color: rgb(66, 116, 167); /* Dark Blue */
            color: white;
            font-weight: bold;
        }
        .text-danger {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="category.php">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="productlist.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userlist.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order_mgmt.php">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row mt-3">
            <div class="col-md-12">
                <h2>
                    Welcome Admin
                    <span class="text-danger">
                        <?php 
                        if(isset($_SESSION['admin'])) {
                            echo htmlspecialchars($_SESSION['admin']);
                        } else {
                            $_SESSION['admin'] = '';
                        }
                        ?>
                    </span>
                </h2>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header text-center">Add New User</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">User  Name</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="cpassword" class="form-label">Confirm Password</label>
                                <input type="password" name="cpassword" id="cpassword" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="usertype" class="form-label">User  Type</label>
                                <select name="usertype" id="usertype" class="form-control text-center" required>
                                    <option value="">------Choose One------</option>
                                    <option value="admin">------Admin-----</option>
                                    <option value="user">-----User -----</option>
                                </select>
                            </div>
                            <div class="d-grid">
                                <input type="submit" value="Add User" class="btn btn-outline-danger" name="btnadduser">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

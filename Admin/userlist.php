<?php 
session_start();
include 'conn.php';
include 'function.php';

if(isset($_GET['action']) && $_GET['action'] == 'delete')
{
    deluser();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
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
            background-color:rgb(66, 116, 167); /* Red */
            color: white;
            font-weight: bold;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }
        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
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
                        if(isset($_SESSION['admin']))
                        {
                            echo htmlspecialchars($_SESSION['admin']);
                        }
                        else
                        {
                            $_SESSION['admin'] = '';
                        }
                        ?>
                    </span>
                </h2>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">User  List</div>
                    <div class="card-body">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>User Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "SELECT * FROM usertable ORDER BY userid DESC";
                            $go_query = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_array($go_query))
                            {
                                $userid = $row['userid'];
                                $username = $row['username'];
                                $userrole = $row['role'];
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($userid) . "</td>";
                                echo "<td>" . htmlspecialchars($username) . "</td>";
                                echo "<td>" . htmlspecialchars($userrole) . "</td>";
                                echo "<td>
                                    <a href='userlist.php?action=delete&uid={$userid}' class='btn btn-sm btn-outline-danger'>X</a>
                                </td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

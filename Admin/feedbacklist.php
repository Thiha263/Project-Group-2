<!DOCTYPE html>
<?php
session_start();
include 'conn.php';
include 'function.php';
if(isset($_GET['action']) && $_GET['action'] == 'delete') {
    delfeedback();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Management</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
            background-color: #dc3545; /* Red */
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
                        <a class="nav-link" href="feedbacklist.php">Feedback</a>
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">Feedback List</div>
                    <div class="card-body">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = "SELECT * FROM feedback ORDER BY fid DESC";
                            $go_query = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_array($go_query)) {
                                $fid = $row['feedbackid'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $phone = $row['phone'];
                                $message = $row['message'];

                                echo "<tr>";
                                echo "<td>{$fid}</td>";
                                echo "<td>" . htmlspecialchars($name) . "</td>";
                                echo "<td>" . htmlspecialchars($email) . "</td>";
                                echo "<td>" . htmlspecialchars($phone) . "</td>";
                                echo "<td>" . htmlspecialchars($message) . "</td>";
                                echo "<td>
                                    <a href='feedbacklist.php?action=delete&fid={$fid}' class='btn btn-sm btn-outline-danger'>X</a>
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

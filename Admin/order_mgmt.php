<?php
session_start();
include 'conn.php';
$orders = mysqli_query($connection, "SELECT * FROM orders ORDER BY orderid DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
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
        .table th, .table td {
            vertical-align: middle;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #e9ecef; /* Light Gray */
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: #ffffff; /* White */
        }
        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }
        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }
        .btn-outline-info {
            color: #17a2b8;
            border-color: #17a2b8;
        }
        .btn-outline-info:hover {
            background-color: #17a2b8;
            color: white;
        }
        .text-danger {
            font-weight: bold;
        }
        .mark {
            background-color: #d4edda; /* Light Green for delivered orders */
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
        <div class="row">
            <div class="col-md-12">
                <h3>
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
                </h3>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Delivery Address</th>
                            <th>Item(s)</th>
                            <th>Order Date</th>
                            <th>Card Type</th>
                            <th>Card No</th>
                            <th>Sent Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($out = mysqli_fetch_array($orders)) 
                        {
                            $check = $out['status']; // 0 or 1
                            $rowClass = $check > 0 ? 'mark' : ''; // Highlight delivered orders
                            echo '<tr class="' . $rowClass . '">';
                            echo '<td>' . htmlspecialchars($out['orderid']) . '</td>';
                            echo '<td>' . htmlspecialchars($out['deliveryname']) . '</td>';
                            echo '<td>' . htmlspecialchars($out['deliveryphone']) . '</td>';
                            echo '<td>' . htmlspecialchars($out['deliveryaddress']) . '</td>';
                            echo '<td>';

                            $orderid = $out['orderid'];
                            $order = mysqli_query($connection, "SELECT ordersdetail.*, product.* FROM ordersdetail LEFT JOIN product ON ordersdetail.productid = product.productid WHERE ordersdetail.orderid = '$orderid'");
                            while($row = mysqli_fetch_assoc($order))
                            {
                                echo '<ul><li>' . htmlspecialchars($row['productname']) . ' <span style="color:red;">[' . htmlspecialchars($row['productqty']) . ']</span></li></ul>';
                            }
                            echo '</td>';
                            echo '<td>' . htmlspecialchars($out['orderdate']) . '</td>';
                            echo '<td>' . ($check > 0 ? htmlspecialchars($out['cardtype']) : 'N/A') . '</td>';
                            echo '<td>' . ($check > 0 ? htmlspecialchars($out['cardno']) : 'N/A') . '</td>';
                            echo '<td>' . ($check > 0 ? htmlspecialchars($out['senddate']) : '----/--/--') . '</td>';
                            echo '<td>';
                            if($check)
                            {
                                echo '<a href="status.php?id=' . $out['orderid'] . '&status=0" class="btn btn-outline-danger">Undo</a>';
                            }
                            else
                            {
                                echo '<a href="status.php?id=' . $out['orderid'] . '&status=1" class="btn btn-outline-info">Mark as Delivered</a>';
                            }
                            echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

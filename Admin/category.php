<?php 
session_start();
?>
<?php
    include 'conn.php';
    include 'function.php';
    if(isset($_POST['btnaddcategory']))
    {
        addCategory();
    }
    if(isset($_POST['btnupdatecategory']))
    {
        update_category();
    }
    if(isset($_GET['action']) && $_GET['action']=='delete')
    {
        delcategory();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
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
            background-color: #6f42c1; /* Purple */
            color: white;
            font-weight: bold;
        }
        .btn-warning {
            background-color: #ffcc00; /* Bright Yellow */
            border-color: #ffcc00;
        }
        .btn-warning:hover {
            background-color: #e6b800; /* Darker Yellow */
            border-color: #e6b800;
        }
        .btn-primary {
            background-color: #007bff; /* Blue */
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker Blue */
            border-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545; /* Red */
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333; /* Darker Red */
            border-color: #c82333;
        }
        .text-danger {
            font-weight: bold;
        }
        .table th, .table td {
            vertical-align: middle;
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
            <div class="col-md-12 text-center mb-4">
                <h2>Welcome Admin
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
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header text-center">Add Category</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="catname" class="form-label">Category Name</label>
                                <input type="text" name="catname" id="catname" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <input type="submit" value="Add Category" class="btn btn-secondary" name="btnaddcategory">
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <?php
                if(isset($_GET['action']) && $_GET['action']=='edit')
                {
                    $catid = $_GET['cid'];
                    $query = "SELECT * FROM category WHERE catid='$catid'";
                    $go_query = mysqli_query($connection, $query);
                    while($out = mysqli_fetch_array($go_query))
                    {
                        $catname = $out['catname'];
                ?>
                <div class="card mb-4">
                    <div class="card-header text-center">Update Category</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="updatecatname" class="form-label">Category Name</label>
                                <input type="text" name="updatecatname" id="updatecatname" class="form-control" value="<?php echo htmlspecialchars($catname); ?>" required>
                            </div>
                            <div class="d-grid">
                                <input type="submit" value="Update Category" class="btn btn-warning" name="btnupdatecategory">
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header text-center">Category List</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $query = "SELECT * FROM category";
                                $go_query = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_array($go_query)) 
                                {
                                    $catid = $row['catid'];
                                    $catname = $row['catname'];
                                    echo "<tr>";                                    
                                    echo "<td>{$catid}</td>";
                                    echo "<td>{$catname}</td>";
                                    echo "<td>
                                    <a href='category.php?action=edit&cid={$catid}' class='btn btn-sm btn-primary'>Edit</a>
                                    <a href='category.php?action=delete&cid={$catid}' class='btn btn-sm btn-danger'>Delete</a>
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

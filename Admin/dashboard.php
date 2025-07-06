<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #0d6efd;
            --success: #198754;
            --info: #0dcaf0;
            --warning: #ffc107;
            --danger: #dc3545;
            --dark: #212529;
        }
        
        body {
            background-color: #e9ecef;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .dashboard-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.3);
        }
        
        .card-header {
            font-weight: bold;
            border-bottom: 2px solid rgba(0,0,0,.125);
        }
        
        .admin-welcome {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #dee2e6;
        }
        
        .action-buttons {
            margin-top: 2rem;
        }
        
        .btn-icon-split .icon {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <?php 
    // This would include your header/navigation
    // include 'header.php'; 
    ?>
    
    <div class="container-fluid py-4">
        <div class="d-sm-flex justify-content-between align-items-center mb-4 admin-welcome">
            <h1 class="h3 mb-0 text-dark">Dashboard</h1>
            <h3 class="h5 mb-0 text-muted">
                Welcome Admin 
                <span class="text-primary">
                    <?php 
                    if(isset($_SESSION['admin'])) {
                        echo htmlspecialchars($_SESSION['admin']);
                    } else {
                        $_SESSION['admin'] = '';
                        echo "Admin";
                    }
                    ?>
                </span>
            </h3>
        </div>

        <!-- Cards Row -->
        <div class="row">
            <!-- Categories Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card border-left-warning h-100">
                    <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                        <h6 class="m-0">Categories</h6>
                        <i class="fas fa-folder fa-2x"></i>
                    </div>
                    <div class="card-body text-center">
                        <a href="category.php" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">View Details</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Products Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card border-left-success h-100">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h6 class="m-0">Products</h6>
                        <i class="fas fa-box-open fa-2x"></i>
                    </div>
                    <div class="card-body text-center">
                        <a href="productlist.php" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">View Details</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Users Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card border-left-danger h-100">
                    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                        <h6 class="m-0">Users</h6>
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <div class="card-body text-center">
                        <a href="userlist.php" class="btn btn-danger btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">View Details</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Orders Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card border-left-primary h-100">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h6 class="m-0">Orders</h6>
                        <i class="fas fa-shopping-cart fa-2x"></i>
                    </div>
                    <div class="card-body text-center">
                        <a href="order_mgmt.php" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">View Details</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Feedback Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card dashboard-card border-left-secondary h-100">
                    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                        <h6 class="m-0">Feedback</h6>
                        <i class="fas fa-comments fa-2x"></i>
                    </div>
                    <div class="card-body text-center">
                        <a href="feedbacklist.php" class="btn btn-secondary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">View Details</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row action-buttons">
            <div class="col-md-12 d-flex justify-content-end">
                <a href="addnewuser.php" class="btn btn-info btn-icon-split me-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-user-plus"></i>
                    </span>
                    <span class="text">Add User</span>
                </a>
                <a href="addproduct.php" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-box"></i>
                    </span>
                    <span class="text">Add Product</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

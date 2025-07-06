<?php 
session_start();
include 'conn.php';
include 'function.php';

if(isset($_POST['btnLogin'])) {
    // Function call
    adminlogin();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Arial', sans-serif;
        }
        .login-container {
            margin-top: 100px;
        }
        .card-header {
            background-color: #007bff; /* Blue */
            color: white;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .text-danger {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header text-center">Admin Login</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">User  Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="username" id="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="checkbox" name="remember_me" id="remember_me">
                                <label class="form-check-label" for="remember_me">Keep me logged in</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit" name="btnLogin">Log in now</button>
                            </div>
                        </form>
                        <hr class="mt-4">
                        <div class="d-flex justify-content-between">
                            <a href="#!" class="link-secondary">Create new account</a>
                            <a href="#!" class="link-secondary">Forgot password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

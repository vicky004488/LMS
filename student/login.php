<?php 
    session_start();
    include 'inc/connection.php';

    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <link rel="stylesheet" href="inc/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="inc/css/pro1.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
    <style>
        .login{
            background-image: url(inc/img/3.jpg);
            margin-bottom: 30px;
            padding: 50px;
            padding-bottom: 70px;
        }
        .reg-header h2{
            color: #DDDDDD;
            z-index: 999999;
        }
        .login-body h4{
            margin-bottom: 20px;
        }
        p span{
        color:red;
        font-weight:800;
      }
    </style>
</head>
<body>
    
    <div class="login registration">
        <div class="wrapper">
            <div class="reg-header text-center">
                <h2>Library management system</h2>
                <div class="gap-40"></div>
            </div>
            <div class="gap-30"></div>
            <div class="login-content">
                <div class="login-body">
                    <h4>User Login Form</h4>
                    <form action="" method="post">
                        <div class="mb-20">
                            <input type="text" name="username" class="form-control" placeholder="Username" required=""/>
                        </div>
                        <div class="mb-20">
                            <input type="password" name="password" class="form-control" placeholder="Password" required=""/>
                        </div>
                        <div class="mb-20">
                            <input class="btn btn-info submit" type="submit" name="login" value="Login">
                            <a class="reset_pass" href="lost-password.php">Lost your password?</a>
                        </div>
                    </form>
                </div>
                <div class="login-footer text-center">
                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="registration.php" class="text-right"> Create Account </a>
                        </p>
                    </div>
                </div>
                <?php 
                    if (isset($_POST["login"])) {
                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        // Use prepared statement to prevent SQL injection
                        $stmt = $link->prepare("SELECT * FROM std_registration WHERE username=? AND status='yes' AND verified='yes'");
                        $stmt->bind_param("s", $username);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();


                        if ($row && $row['password'] === $password) {
                            $_SESSION["student"] = $username;
                            header("Location: my-issued-books.php");
                            exit();        
                        } else {
                            ?>
                            <div class="alert alert-warning">
                                <strong style="color:#333">Invalid!</strong> <span style="color: red;font-weight: bold; ">Username Or Password.</span>
                            </div>
                            <?php
                        }
                    }
                 ?>
            </div>
        </div>
    </div>

    <div class="footer text-center">
        <p>&copy; All rights reserved <span>Vicky </span>Singh</p>
    
    </div>

    <script src="inc/js/jquery-2.2.4.min.js"></script>
    <script src="inc/js/bootstrap.min.js"></script>
    <script src="inc/js/custom.js"></script>
</body>
</html>

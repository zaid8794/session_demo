<?php
include "helper/db.php";
session_start();
if (isset($_SESSION['user'])) {
    header('Location:index.php');
}
if ($_POST) {
    $email = $_POST['user_email'];
    $pass = $_POST['user_pass'];
    $q = mysqli_query($con, "SELECT * FROM tbl_user WHERE user_email='$email' and user_password='$pass'");
    $row = mysqli_fetch_array($q);
    unset($row['user_password']);
    if (mysqli_num_rows($q) > 0) {
        $_SESSION['user'] = $row;
        header('Location:index.php');
    } else {
        echo "<script>alert('Login Fail');</script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>

<nav class="navbar navbar-expand-sm navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php" aria-current="page">Home
                            <span class="visually-hidden">(current)</span></a>
                    </li>
                    <?php
                    if (!isset($_SESSION['user'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="add-order.php">Add Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view-order.php">View Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <form class="d-flex my-2 my-lg-0">
                    <input class="form-control me-sm-2" type="text" placeholder="Search" />
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <h1 class="text-center">Login</h1>
        <div class="row">
            <div class="col-4 offset-4">
                <div class="card p-5 shadow">
                    <form action="" method="post">
                        <div class="py-1">
                            Email : <input type="email" name="user_email" class="form-control shadow-none">
                        </div>
                        <div class="py-1">
                            Password : <input type="password" name="user_pass" class="form-control shadow-none">
                        </div>
                        <div class="text-center py-1">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
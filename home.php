<?php
include 'module/connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/nav_admin.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5dc;
            color: #5a4635;
        }

        .navbar,
        footer {
            background-color: #d2b48c;
        }

        .btn-warning {
            background-color: #a0522d;
            border-color: #a0522d;
        }

        .btn-warning:hover {
            background-color: #8b4513;
            border-color: #8b4513;
        }

        .img-fluid {
            border: 2px solid #d2b48c;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">LOGO</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" data-bs-parent=".container-fluid">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="">หน้าแรก</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="frm_login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container text-center">
        <div class="row">
            <div class="col-12 my-4">
                <img src="component/header.png" class="img-fluid" alt="Responsive image">
            </div>
        </div>

        <div class="row">
            <div class="col-12 my-4">
            <a class="btn btn-warning btn-lg text-white" href="frm_login.php">จองบริการได้ที่นี่</a>
            </div>
        </div>
        

        <div class="row">
            <div class="col-md-6 my-4">
                <img src="component/body.jpg" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col-md-6 my-4">
            <img src="component/body.jpg" class="img-fluid" alt="Responsive image">
            </div>
        </div>

        <div class="row">
            <div class="col-12 my-4">
            <a class="btn btn-warning btn-lg text-white" href="frm_login.php">จองบริการได้ที่นี่</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 my-4">
                <img src="component/detail.jpg" class="img-fluid" alt="Responsive image">
            </div>
        </div>
    </div>

    <footer>
        <div class="container text-center text-black">
            <div class="row">
                <div class="col-12 my-4">
                    <p>© 2024 All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
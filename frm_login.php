<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/login.css?v=2">
</head>

<body class="bg-light d-flex justify-content-center align-items-center min-vh-100">

<div class="card p-4 shadow-lg" style="width: 100%; max-width: 400px;">
    <h2 class="card-title text-center mb-4">เข้าสู่ระบบ</h2>
    <form action="module/login.php" method="post">
        <div class="mb-3">
            <label for="u_name" class="form-label">Username</label>
            <input type="text" name="u_name" class="form-control" id="u_name" required>
        </div>
        <div class="mb-3">
            <label for="u_pass" class="form-label">Password</label>
            <input type="password" name="u_pass" class="form-control" id="u_pass" required>
        </div>
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">ล๊อกอิน</button>
        </div>
    </form>
    <div class="text-center">
        <a href="Register.php" class="btn btn-link">สมัครสมาชิก</a>
    </div>
</div>


</body>

</html>

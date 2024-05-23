<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/nav_admin.css">

<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" 
        aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarNav">
            <ul class="navbar-nav me-auto"> <!-- ใช้ me-auto เพื่อให้อันอื่นๆ อยู่ด้านซ้าย -->
                <li class="nav-item">
                    <a class="nav-link" href="./cusHome.php">หน้าแรก</a>
                </li>
                <li class="nav-item mr-extra">
                    <a class="nav-link" href="./add_Booking.php">การจองคิว</a>
                </li>
            </ul>
            <ul class="navbar-nav"> <!-- ใช้ navbar-nav ปกติเพื่อปุ่ม Logout อยู่ด้านขวา -->
                <li class="nav-item">
                    <a class="nav-link" href="module/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
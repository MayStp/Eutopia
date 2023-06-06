<?php 
session_start();

if( !isset($_SESSION["login"])){
    header("Location: login/index.php");
    exit;
}

?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>Title</title>
</head>
<body>
    <h1>aowdkoawkodkaowkd</h1>
    <a href="logout.php">logout min!</a>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sticky Navbar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Menu 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Menu 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Menu 3</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="content">
    <!-- Konten halaman -->
    <div class="container mt-5">  
        <h1>Halaman Utama</h1>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        <p>Isi konten halaman utama di sini...</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

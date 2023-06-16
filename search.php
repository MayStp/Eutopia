<?php
// search.php

session_start();

$conn = mysqli_connect("localhost", "root", "", "wrlds");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION["login"])) {
    header("Location: login/index.php");
    exit;
}

// Fungsi untuk mencari lagu berdasarkan query
function searchSongs($query)
{
    global $conn;
    $query = mysqli_real_escape_string($conn, $query);
    $sql = "SELECT * FROM lagu WHERE judul_lagu LIKE '%$query%'";
    $result = mysqli_query($conn, $sql);
    $songs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $songs;
}

// Periksa apakah ada query yang dikirimkan
if (isset($_GET["query"])) {
    $query = $_GET["query"];
    $songs = searchSongs($query);
} else {
    // Tindakan jika tidak ada query yang dikirimkan, misalnya kembali ke halaman sebelumnya
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Hasil pencarian...</h1>
        <p>Showing search results for: <?php echo $query; ?></p>
        
        <ul>
            <?php foreach ($songs as $song) : ?>
                <li>
                    <?php echo $song['judul_lagu']; ?>
                    <!-- Tambahkan tombol atau tindakan lainnya di sini -->
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

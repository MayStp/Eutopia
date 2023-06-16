<?php
session_start();
// Membuat koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'wrlds');

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function generatePlaylistId() {
    global $conn;
    
    // Mengambil ID playlist tertinggi dari database
    $query = "SELECT MAX(id_playlist) AS max_id FROM playlist";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Error retrieving maximum playlist ID: " . mysqli_error($conn));
    }
    
    $row = mysqli_fetch_assoc($result);
    $maxId = $row['max_id'];
    
    // Menghasilkan ID playlist baru
    $newPlaylistId = 'pl1';
    
    if ($maxId !== null) {
        $maxIdNumber = intval(substr($maxId, 2));
        $newIdNumber = $maxIdNumber + 1;
        $newPlaylistId = 'pl' . $newIdNumber;
    }
    
    return $newPlaylistId;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    global $_SESSION;
    $namaplay = $_POST['playlistName'];
    $userId = $_SESSION['username'];
    // Menghasilkan ID playlist baru
    $newPlaylistId = generatePlaylistId();

    $querrr = "INSERT INTO playlist (id_playlist, namaplay, username) VALUES ('$newPlaylistId', '$namaplay', '$userId')";

    if (mysqli_query($conn, $querrr)) {
        echo "<script> alert('Playlist berhasil dibuat');
              window.location.href = 'index.php'; </script>";
        exit();
    } else {
        echo "Error: " . $querrr . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
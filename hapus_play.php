<?php
// Koneksi ke database
include 'koneksi.php';

// Ambil ID data yang akan dihapus dari metode POST
$namaplay = $_POST['namaplay'];

// Escape string $namaplay untuk menghindari SQL injection
$namaplay = $conn->real_escape_string($namaplay);

// Perintah SQL untuk menghapus data dari tabel
$sql = "DELETE FROM playlist WHERE namaplay = '$namaplay'";

// Jalankan perintah penghapusan
if ($conn->query($sql) === TRUE) {
  echo "<script> alert('Playlist berhasil dibuat');
  window.location.href = 'index.php'; </script>";;
} else {
  echo "Error: " . $conn->error;
}

// Tutup koneksi database
$conn->close();
?>

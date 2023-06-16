<?php

// Membuat koneksi
$conn = new mysqli("localhost", "root", "", "wrlds");

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

echo "Koneksi sukses!";

// Menutup koneksi
// $conn->close();
?>

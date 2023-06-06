<?php 
$conn = mysqli_connect("localhost", "root", "", "wrlds");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function register($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);


    $cekus = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");

    if (mysqli_fetch_assoc($cekus)){
        echo "<script>
                alert('username sudah ada')    
        </script>";
        return false;
    }



    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai')
            </script>";
        
        return false;
    }

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Ambil id terakhir dari tabel user
    $hasil = mysqli_query($conn, "SELECT id_user FROM user ORDER BY id_user DESC LIMIT 1");
    $lastId = mysqli_fetch_assoc($hasil);

    if ($lastId) {
        // Jika ada data id_user
        $lastId = $lastId['id_user'];
        $newId = 'U' . (intval(substr($lastId, 1)) + 1);
    } else {
        // Jika tidak ada data id_user
        $newId = 'U1';
    }

    mysqli_query($conn, "INSERT INTO user VALUES ('$newId', '$username', '$password')");

    return mysqli_affected_rows($conn);
}
?>

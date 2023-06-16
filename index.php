<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "wrlds");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION["login"])) {
    header("Location: login/index.php");
    exit;
}

// Fungsi untuk mendapatkan daftar lagu dari database
function getSongList(){
    global $conn;
    $query = "SELECT * FROM lagu";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Error retrieving songs: " . mysqli_error($conn));
    }
    
    $songs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $songs;
}

// Mendapatkan daftar lagu
$songs = getSongList();

// Mendapatkan daftar playlist pengguna
// require '/login/index.php';
function getUserPlaylists(){
    global $conn;
    // require 'login/index.php';
    $userId = $_SESSION["username"];
    $query = "SELECT * FROM playlist WHERE username = '$userId'";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Error retrieving playlists: " . mysqli_error($conn));
    }
    
    $playlists = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $playlists;
}

// Mendapatkan daftar playlist pengguna
$playlists = getUserPlaylists();

if(isset($_POST["submit"])){
    if( register($_POST) > 0) {
        echo "<script>
                alert('user baru ditambahkan!');
            </script>";
        header("Location: ../login/index.php");
        exit;
    } else {
        echo mysqli_error($conn);
    }
}
?>

function



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Musik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ebaf338085.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Logo</a>
            <a href="logout.php">Logout</a>
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
    <br><br>
    
    <div class="container mt-5">  
    <h1>EUTOPIA</h1>

    <!-- SONG LIST  -->
    <h2>Song List</h2>
    <div class="row">
        <?php foreach ($songs as $song) : ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card mb-3" >
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title"><?php echo $song['judul_lagu']; ?></h5>
                        <button class="btn ml-auto" onclick="playAudio('<?php echo $song['id_lagu']; ?>'+'.mp3')">
                        <img src="https://icons8.com/icon/fKjdxWYsIQbi/play" alt="">
                        <i class="fa-solid fa-play"></i>
                        </button>
                        <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="addToPlaylist('<?php echo $song['id_lagu']; ?>')">
                        <i class="fa-solid fa-bars-progress"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <?php foreach ($playlists as $playlist) : ?>
                                <li><a class="dropdown-item" href="#" data-id="<?php echo $playlist['id_playlist']; ?>"><?php echo $playlist['namaplay']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


  <!-- PLAYLSIT -->
    <h2>Playlists</h2>
    <div class="row">
        <?php foreach ($playlists as $playlist) : ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $playlist['namaplay']; ?></h5>
                        <button class="btn" onclick="playPlaylist(<?php echo $playlist['id_playlist']; ?>)"><i class="fa-solid fa-play"></i></button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <i class="fa-solid fa-circle-play"></i>
    <i class="fa-solid fa-play"></i>
    <h2>Create Playlist</h2>
        <form action="createPlaylist.php" method="POST">
            <div class="mb-3">
                <label for="playlistName" class="form-label">Playlist Name</label>
                <input type="text" class="form-control" id="playlistName" name="playlistName" required>
            </div>
            <button type="submit" value="submit" class="btn btn-primary">Create Playlist</button>
        </form>


    
    <h2>Search Song</h2>
    <form action="search.php" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="query" placeholder="Search..." required="">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasBottomLabel">Offcanvas bottom</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body small">
            ...
        </div>
    </div>
    
    <div id="player"></div>
</div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function playAudio(songId) {
            var audio = new Audio(songId);
            audio.play();
            
            var offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasBottom'));
            offcanvas.show();
        }

        // function addToPlaylist(songId) {
        //     var offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasBottom'));
        //     offcanvas.show();
        // }
        
    </script>
</body>
</html>

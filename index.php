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

<img id="bg" src="assets/bg.png" alt="">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand " href="#">EUTOPIA</a>
        
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Beranda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="search/index.php">Telusuri</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Genre</a>
            </li>
        </ul>
        
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="assets/bear.png" class="rounded-circle" alt="Profile Picture" style="width: 40px; height: 40px;">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
        
    </div>
</nav>



    <br><br><br><br>
    
    <div class="container mt-5">  
    <h1>Selamat datang, <span class="auto-type"></span> </h1>
    <br>

    <div class="container">
        <div class="music-image">
            <div class="image-container">
                <img src="assets/rumbling.jpg" alt="Music Image">
                <button class="play-button" aria-label="Play Music">
                    <i class="set-icon fas fa-solid fa-play "></i>
                </button>
                <audio src="songs/Positions.mp3"></audio>
            </div>

            <div class="image-container">
                <img src="assets/maroon.jpg" alt="Music Image">
                <button class="play-button" aria-label="Play Music">
                    <i class="set-icon fas fa-solid fa-play "></i>
                </button>
                <audio src="songs/Positions.mp3"></audio>
            </div>

            <div class="image-container">
                <img src="assets/f7.jpg" alt="Music Image">
                <button class="play-button" aria-label="Play Music">
                    <i class="set-icon fas fa-solid fa-play "></i>
                </button>
                <audio src="songs/Positions.mp3"></audio>
            </div>

            <div class="image-container">
                <img src="assets/bmrh.png" alt="Music Image">
                <button class="play-button" aria-label="Play Music">
                    <i class="set-icon fas fa-solid fa-play "></i>
                </button>
                <audio src="songs/Positions.mp3"></audio>
            </div>
        </div>
    </div>

    <!-- SONG LIST  -->
    <h2>Song List</h2>
    <div class="row">
        <?php foreach ($songs as $song) : ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card mb-3" >
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title"><?php echo $song['judul_lagu']; ?></h5>
                        <button class="btn ml-auto" onclick="playAudio('songs/'+'<?php echo $song['id_lagu']; ?>'+'.mp3')">
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
                        <button class="btn" onclick="playPlaylist(<?php echo $playlist['namaplay']; ?>)"><i class="fa-solid fa-play"></i></button>
                        <form action="hapus_play.php" method="POST">
                            <button class="btn" name="namaplay" value="<?php echo $playlist['namaplay']; ?>"><i class="fa-regular fa-trash-can"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
            <br><br>

    <i class="fa-solid fa-circle-play"></i>
    <i class="fa-solid fa-play"></i>
    <h2 for="playlistName">Create Playlist</h2>
    <div class="container-createplaylist">
    <form action="createPlaylist.php" method="POST">
            <div class="mb-3">
                <input type="text" class="form-control" id="playlistName" name="playlistName" required placeholder="Nama playlist">
            </div>
            <button type="submit" value="submit" class="btns"><i class="fa-solid fa-circle-plus fa-2xl"></i></button>
        </form>
    </div>
    <br><br><br>
        


    
        <div class="floating-navbar">
        <div class="player">
                    <!-- Define the section for displaying details -->
                    <div class="details">
                    <div class="track-name">Track Name</div>
                    <div class="track-artist">Track Artist</div>
                    </div>

                    <!-- Define the section for displaying track buttons -->
                    <div class="buttons">
                    <div class="play-track" onclick="PlayAudio2()">
                    <button><i class="fa-solid fa-play fa-2x"></i></button>    
                    </div>
                    <div class="pause-track" onclick="pauseAudio()">
                    <i class="fa-solid fa-pause fa-2x"></i>
                    </div>
                    </div>
                    <!-- Define the section for displaying the seek slider-->
                    <div class="slider_container">
                    <div class="current-time">00:00</div>
                    <input type="range" min="1" max="100"
                        value="0" class="seek_slider" onchange="seekTo()">
                    <div class="total-duration">00:00</div>
                    </div>
                    <!-- Define the section for displaying the volume slider-->
                    <div class="slider_container">
                    <i class="fa fa-volume-down"></i> 
                    <input class="volume-slider" type="range" min="0" max="100" value="100" class="volume-slider" onchange="setVolume(this.value)">
                    <i class="fa fa-volume-up"></i>
                    </div>
                    
        </div>
        <div id="player"></div>
        </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
    <script>
        <?php
            $userId = $_SESSION["username"];

            echo "var userId = '" . $userId . "';";
        ?>

        var typed = new Typed(".auto-type", {
            strings: [userId, "Eutopian"],
            typeSpeed: 150,
            backSpeed: 150,
            loop: true
        });

    
    </script>

    <script src="script.js" ></script>

</body>
</html>

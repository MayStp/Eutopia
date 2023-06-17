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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand" href="#">Logo</a>
        
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
            <button type="submit" value="submit" class="btns"><i class="fa-solid fa-circle-plus fa-2xl"></i></button>
            
        </form>


    
    
    
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <!-- <h5 class="offcanvas-title" id="offcanvasBottomLabel">Offcanvas bottom</h5> -->
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
        </div>
        <div class="offcanvas-body small">
        <div class="player">
 
 <!-- Define the section for displaying details -->
 <div class="details">
   <div class="track-name">Track Name</div>
   <div class="track-artist">Track Artist</div>
 </div>

 <!-- Define the section for displaying track buttons -->
 <div class="buttons">
   <div class="prev-track" onclick="prevTrack()">
     <i class="fa fa-step-backward fa-2x"></i>
   </div>
   <div class="playpause-track" onclick="playpauseTrack()">
     <i class="fa fa-play-circle fa-5x"></i>
   </div>
   <div class="next-track" onclick="nextTrack()">
     <i class="fa fa-step-forward fa-2x"></i>
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
   <input type="range" min="1" max="100"
     value="99" class="volume_slider" onchange="setVolume()">
   <i class="fa fa-volume-up"></i>
 </div>
</div>

        </div>
    </div>
    
    <div id="player"></div>
</div>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js" ></script>

</body>
</html>

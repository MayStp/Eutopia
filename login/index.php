<?php 
session_start();

if(isset($_SESSION["login"])){
  
  header("Location: ../index.php");

}

require 'functions.php';

if(isset($_POST["submit"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $ceklogin = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if(mysqli_num_rows($ceklogin) == 1){
        $row = mysqli_fetch_assoc($ceklogin);
        if (password_verify($password, $row["password"])){
          //set session
          $_SESSION["login"] = true ;
          $_SESSION['username'] = $username;

          header("Location: ../index.php");
          exit;
        }
    }

    $error = true;

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<title>Login</title>
</head>
<body>


<?php if(isset($error)):?>
  <script>
    alert('Password/ Username salah')
  </script>
  <?php endif; ?>
<div class="gradient-background">

    <div class="login-container ">

      <div class="login-header">
        <h2>Eutopia</h2>
      </div>

      <div class="login-form">
        <form method="POST">
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="password" name="password" id="password" placeholder="Password">
            <a class="askreg" href="../signup/index.php">Belum punya akun? Daftar!</a>
            <br><br>
            <button type="submit" name="submit" class="login-button">Login</button>
        </form>
      </div>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
<?php 
require 'functions.php';

if(isset($_POST["submit"])){

    if( register($_POST) > 0) {
        echo "<script>
                alert('user baru ditambahkan!');
            </script>";
          header("Location: ../login/index.php");
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
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<title>SignUp</title>
</head>
<body>
<!-- Image and text -->

<div class="gradient-background">

    <div class="login-container ">

      <div class="login-header">
        <h2>Eutopia</h2>
      </div>

      <div class="login-form">
        <form method="POST">
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="password" name="password" id="password" placeholder="Password">
            <input type="password" name="password2" id="password2" placeholder="Confirm Password">
            <a href="../login/index.php">Sudah punya akun? Login</a>
            <br><br>
            <button type="submit" name="submit" class="login-button">Sign Up</button>
        </form>
      </div>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="Description" content="Enter your description here"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <title>Title</title>
  <style>

  </style>
</head>
<body>
  <video autoplay muted loop id="myVideo">
    <source src="assets/bgg.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>

  <form action="search.php" method="GET">
  <div class="content">
    <div class="input-group search-container">
      <input type="text" class="form-control" name="query" placeholder="Search..." required="">
      <div class="input-group-append">
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
    </div>
  </div>
    </form>


  

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

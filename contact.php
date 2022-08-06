<?php

if (!isset($_SESSION)) {
 session_start();
}

if (isset($_SESSION['UserLogin'])) {
 echo "Welcome " . $_SESSION['UserLogin'];
} else {
 echo "Welcome Guest";
}

include_once("connections/connection.php");

$con = connection();

if (isset($_POST['submit'])) {

  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $gender = $_POST['gender'];
  $mobile = $_POST['mobile'];
  $description = $_POST['description'];
  $email = $_POST['email'];
  $sql = "INSERT INTO `missing`( `lat`, `lng`, `fname`, `lname`, `gender`, `mobile`, `description`, `email`) VALUES ('$lat', '$lng', '$fname', '$lname', '$gender', '$mobile', '$description', '$email')";
  -$con->query($sql) or die($con->error);
 
  echo header("Location: index.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./libs/ol/ol.css">
  <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
  <link rel="stylesheet" href="./libs/ol-layerswitcher/dist/ol-layerswitcher.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Finder Helper | Contact Us</title>
  <script src="./libs/ol/ol.js"></script>
  <script src="./libs/ol-layerswitcher/dist/ol-layerswitcher.js"></script>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top py-3 top" id="navBar" name="top">
    <div class="container">

      <a class="navbar-brand" href="http://localhost/openlayers">
          <img src="./img/logo.webp" alt="logo" height="30">
        </a>
        <button 
          class="navbar-toggler" 
          type="button" 
          data-bs-toggle="collapse" 
          data-bs-target="#navmenu" 
          >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="text-center collapse navbar-collapse" id="navmenu">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="./index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./services.php">Service</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./contact.php">Contact</a>
          </li>
        </ul>

        
        
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <?php if (isset($_SESSION['UserLogin'])) { ?>
              <a class="nav-link" href="list.php">Missing List</a>
            <?php  } else { ?>
            <a class="nav-link" href="register.html">Register</a>
            <?php } ?>
            </li>
            <li class="nav-item">
            <?php if (isset($_SESSION['UserLogin'])) { ?>
            <a class="nav-link" href="logout.php">Logout</a>
            <?php  } else { ?>
            <a class="nav-link" href="login.php">Login</a>
            <?php } ?>
            </li>
          </ul>
        </div>
    </div>
  </nav>

  <div class="mt-5 header-img fade-in">
<img class="img-fluid" src="./img/img4.webp" alt="">
</div>

<div class="container">
  <div class="row align-items-center justify-content-between">
  <div class="mt-5 col-md section-2">
    <div class="fs-2 text-center">CONTACT US</div>
  <p class="fs-4 pt-4">For more information, please email or call us:</p>
  <p class="fs-6 pt-1">+63 961 0288791 | cddigital2022@gmail.com</p>
  <p class="fs-4 pt-4">Our address:</p>
  <h6 class="fs-6">finder helper Ph</h6>
  <p class="fs-6">Agoo, La Union</p>
  <p class="fs-6 mb-5">Philippines</p>
</div>
<div class="col-md">
  <img class="img-fluid" src="./img/contact.webp" alt="">
</div>
</div>
</div>
<footer class="container-fluid bg-light py-4">
    <div class="container ">
      <span>Agoo, La Union 2504</span>
      <p>cddigital2022@gmail.com | +63 9610288791</p>
      <br><br>
      <div class="d-flex justify-content-between grayed-text"><p>&copy 2022 by finder helper. All rights reserved.</p><span class="chevron"><a href="#top"><i class="fa-solid fa-circle-chevron-up fa-3x"></i></a></span></div>
      <p>Privacy Policy | Cookie Policy</p>
    </div>
  </footer>

  <script type="text/javascript" src="./js/nav.js"></script>
  <script type="text/javascript" src="./js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
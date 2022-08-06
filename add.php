<?php

if (!isset($_SESSION)) {
 session_start();
}

if (isset($_SESSION['UserLogin'])) {
 echo "Welcome " . $_SESSION['UserLogin'];
} else {
  echo header("Location: login.php");
}

include_once("connections/connection.php");

$con = connection();
//name property of submit button
if (isset($_POST['submit'])) {

if($_FILES['img']['tmp_name']){
  $img = addslashes(file_get_contents($_FILES["img"]["tmp_name"]));
}
  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $gender = $_POST['gender'];
  $mobile = $_POST['mobile'];
  $descriptio = $_POST['descriptio'];
  $email = $_POST['email'];

 

  $sql = "INSERT INTO `missing`( `lat`, `lng`, `fname`, `lname`, `gender`, `mobile`, `descriptio`, `email`, `img`) VALUES ('$lat', '$lng', '$fname', '$lname', '$gender', '$mobile', '$descriptio', '$email', '$img')";
  $con->query($sql) or die($con->error);
 
  echo header("Location: list.php");
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
  <title>Finder Helper | Help Someone</title>
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
            <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./services.php">Service</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./contact.php">Contact</a>
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

<div class="mt-5 header-map">
  <div id="map"></div>
</div>
<div class="container section-1">
<form id="form" method="post" enctype="multipart/form-data">
    <h3>Report New information</h3>
    <h4>Last Location Seen: (zoom in and click on the map)</h4>

    <div class="row">
      <div class="col-sm">
      <div class="form-floating mb-3">
      <input class="form-control" placeholder="Latitude" name="lat" type="text" id="lat">
      <label for="lat">Latitude: </label>
    </div>
    <div class="form-floating mb-3">
      <input class="form-control" placeholder="Longitude" name="lng" type="text" id="lng">
      <label for="lng">Longitude: </label>
    </div>

      <select hidden id="projection">
        <option value="EPSG:4326">EPSG:4326</option>
      </select>

      <div class="form-floating mb-3">
        <input class="form-control" placeholder="First Name of Missing Person" name="fname" type="text" id="fname">
        <label for="fname">First Name: </label>
      </div>

      <div class="form-floating mb-3">
        <input class="form-control" placeholder="Last Name of Missing Person" name="lname" type="text" id="lname">
        <label for="lname">Last Name: </label>
      </div>

      <div class="form-floating mb-3">
        <select class="form-select" aria-label="Default select gender" name="gender" id="gender">
          <option value="Male">Male</option>
          <option value="Male">Female</option>
        </select>
        <label>Gender</label>
      </div>

      <div class="mb-3">
      <label for="formFileSm" class="form-label">Upload Image</label>
      <input class="form-control-sm" type="file" name="img" value="img/default_img.png">
      </div>
      </div>
      <div class="col-sm">
      <div class="form-group mb-3">
        <textarea class="form-control" placeholder="Describe the Person (height, skin color, clothes wearing, etc. Note: please do not type single quote character.)" name="descriptio" id="descriptio" rows="5"></textarea>
      </div>

    <div class="form-floating mb-3">
      <input class="form-control" placeholder="Contact of Helper" name="mobile" type="text" id="mobile">
      <label for="mobile">Mobile No. of Helper: </label>
    </div>

    <div class="form-floating mb-3">
      <input class="form-control" placeholder="Your Email" name="email" type="email" id="email">
      <label for="email">Email of Helper: </label>
    </div>
    <div class="form-floating mb-3">
      <button class="btn btn-primary" type="submit" name="submit">Submit</button>

    </div>
    </form>
   <div class="pt-3">
      </div>
    </div>

   

      

      <p class="mt-3">Please be careful in reporting information. Double check the information. Your report is needed to help someone find their way home.</p>

      <br>
   </div>
   <br>


   
   </div>
   <footer class="container-fluid bg-light py-4">
    <div class="container ">
      <span>Agoo, La Union 2504</span>
      <p>cddigital2022@gmail.com | +63 9610288791</p>
      <br><br>
      <div class="d-flex justify-content-between grayed-text"><p>&copy 2022 by finder helper. All rights reserved.</p><span class="chevron"><a href="#top"><i class="fa-solid fa-circle-chevron-up fa-3x"></i></a></span></div>
      <p>Privacy Policy | Cookie Policy</p>
    </div>
    </div>
  </footer>

  <script type="text/javascript" src="./js/nav.js"></script>
  <script type="text/javascript" src="./js/draw.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
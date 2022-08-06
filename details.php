<?php

if (!isset($_SESSION)) {
   session_start();
}

if (isset($_SESSION['Access']) && $_SESSION['Access'] == "administrator" || isset($_SESSION['Access']) && $_SESSION['Access'] == "user") {
   echo "Welcome " . $_SESSION['UserLogin'] . "<br><br>";
} else {
   echo header("Location: landing.php");
}

include_once("connections/connection.php");

$con = connection();

$id = $_GET['ID'];

$sql = "SELECT * FROM missing WHERE id = '$id'";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./libs/ol/ol.css">
    <link rel="stylesheet" href="./libs/ol-layerswitcher/dist/ol-layerswitcher.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
   <title>Finder Helper | Details</title>
   <script src="./libs/ol/ol.js"></script>
   <script src="./libs/ol-layerswitcher/dist/ol-layerswitcher.js"></script>
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
            <a class="nav-link" href="./services.php">Services</a>
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

<div class="mt-4 header-map">
   <div id="map"></div>
</div>
<div class="container section-1">
      <h3 class="mb-3 text-center">Missing Person Details</h3>
      <div class="row">
         <div class="col-sm">
            <div class="mb-3">
               <label>Latitude: </label><input class="form-control" id="lat" value="<?= $row['lat']; ?>"> 
            </div>
            <div class="mb-3">
            <label>Longitude: </label><input class="form-control" id="lng" value="<?= $row['lng']; ?>"> 
            </div>
            <div class="mb-3">
               <p>First Name: <?php echo $row['fname']; ?></p>
            </div>
            <div class="mb-3">
            <p>Last Name: <?php echo $row['lname']; ?></p>
            </div>
            <div class="mb-3">
            <p>Gender: <?php echo $row['gender']; ?></p>
            </div>
         </div>
         <div class="col-sm">
         <div class="mb-3">
            <div class="text-center"> 
               <?php 
               if($row['img']){
               echo '<img class="coverImg" src="data:image;base64,'.base64_encode($row['img']).'" alt="Image">';
               } else {
                  echo '<img class="coverImg" src="./img/default_img.png" alt="Image">';
               } 
                ?></div>
            </div>
         <div class="mb-3">
            <p>Description: <?php echo $row['descriptio']; ?></p>
         </div>
         <div class="mb-3">
            <p>Contact No. of Helper: <?php echo $row['mobile']; ?></p>
         </div>

   </div>
   </div>


   <div>

      <h3 class="pt-3">Thank you for your help.</h3>
   </div>
   <section>
      <section>
         <p>The information above are subject to correction and is protected by law.</p>
      </section>

   </section>

   <form class="index-form" action="delete.php" method="post">

<?php if ($_SESSION['Access'] == "administrator") { ?>
   <a class="btn btn-warning" href="edit.php?ID=<?php echo $row['id']; ?>">Edit</a>
<?php } ?>
<?php if ($_SESSION['Access'] == "administrator") { ?>
   <button class="btn btn-danger" type="submit" name="delete">Delete</button>
<?php } ?>
<input type="hidden" name="ID" value="<?php echo $row['id']; ?>">

</form>
<a href="./index.php">
<button class="btn btn-primary mt-3 mb-3">Back to Home</button></a>
</div>
   <footer class="container-fluid bg-light py-4">
    <div class="container ">
      <span>Agoo, La Union 2504</span>
      <p>cddigital2022@gmail.com | +63 9610288791</p>
      <br><br>
      <p>&copy 2022 by finder helper. All rights reserved.</p>
      <p>Privacy Policy | Cookie Policy</p>
    </div>
  </footer>
   <script type="text/javascript" src="./js/nav.js"></script>
   <script src="./js/main2.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

 
</body>
</html>
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
$search = $_GET['search'];
$sql = "SELECT * FROM missing WHERE fname LIKE '%$search%' || lname LIKE '%$search%' ORDER BY id DESC";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Finder Helper System</title>
 <link rel="stylesheet" href="./css/style.css">
 <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
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
<div class="container">
 <h1 class="top">Search Result</h1>
 <br>
 <form class="row row-cols-sm-auto g-3" action="result.php" method="GET">
 <div class="col-12">
  <input class="form-control" type="text" name="search" id="search"></div>
  <div class="col-12">
  <button class="btn btn-primary" type="submit">search</button></div>
 </form>

 <div class="addNew">
  <br>
  <?php if (isset($_SESSION['UserLogin'])) { ?>
   <a href="logout.php">Logout</a>
  <?php  } else { ?>
   <a href="login.php">Login</a>

  <?php } ?>
  <br>
  <a href="add.php">Add New</a>
 </div>
 <br>
 <br>
 <table class="table">
  <thead>
   <tr>
    <th></th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Added At</th>
   </tr>
  </thead>
  <tbody>
   <?php do { ?>
    <tr>
     <td><a href="details.php?ID=<?php echo $row['id']; ?>">view</a></td>
     <td><?php if($row){
     echo $row['fname']; 
     } else {
      echo "no result";
     } ?></td>
     <td><?php if($row){
     echo $row['lname'];
     }else{
      echo "no result";
     } ?></td>
     <td><?php if($row)
     {
      echo $row['added_at'];
      }else{
        echo "no result";
      } ?></td>
    </tr>
   <?php } while ($row = $students->fetch_assoc()) ?>
  </tbody>
 </table>
 <br>
 <div class="bot"><a href="#top">back to top</a></div>
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
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>
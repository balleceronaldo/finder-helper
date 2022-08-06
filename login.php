<?php

if (!isset($_SESSION)) {
 session_start();
}

include_once("connections/connection.php");
$con = connection();


if (isset($_POST['login'])) {

 $username = $_POST['username'];
 $password = $_POST['password'];


 $sql = "SELECT * FROM system_users WHERE username = '$username'";
 $user = $con->query($sql) or die($con->error);
 $row = $user->fetch_assoc();
 $total = $user->num_rows;
 $hash = $row['password'];

 if ($total > 0 && password_verify($password, $hash)) {
  $_SESSION['UserLogin'] = $row['username'];
  $_SESSION['Access'] = $row['access'];

  echo header("Location: services.php");
}else{
    echo "User and Password does not match.";
}
 } else {
  echo "Please login with correct password.";
 }





?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Finder Helper | Login</title>
 <link rel="stylesheet" href="./css/style.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <link rel="icon" type="image/x-icon" href="./img/favicon.ico">

</head>

<body>
<div class="container col col-md-4 mt-5">
 <h1>Login</h1>
 <br>
<form action="" method="post">

  <div class="container mb-3">
   <img src="./img/logo.webp" alt="logo" width="200">
  </div>

    <div class="form-floating mb-3">
        <input class="form-control" type="text" name="username" id="username" placeholder="username" required>
        <label>Username</label>
    </div>
    <div class="form-floating mb-3">
        <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
        <label>Password</label>
    </div>
    <div class="form-floating">
        <button class="btn btn-primary mb-3" type="submit" name="login">Login</button><div>No account yet?</div><div class="form-link"><a href="./register.html">Register <i class="fa-solid fa-circle-chevron-right"></i></a></div>
    </div>
</form>






 <br>
 <footer class="footer"><small>&copy; <a href="./index.php">finder helper</a></small></footer>
 </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
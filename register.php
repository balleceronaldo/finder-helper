<?php

if (!isset($_SESSION)) {
 session_start();
}

include_once("connections/connection.php");
$con = connection();

// code validation for error message if database is connected or not
if(mysqli_connect_error()){
 exit('Error connecting to the database' . mysqli_connect_error());
}
// check if variable is empty or not
if(!isset($_POST['username'], $_POST['password'], $_POST['email'])){
 exit('<p style="font-family: sans-serif;">'.'Empty field(s). Try again.'.'<a style="text-decoration: none; color: #148ec7" href="./register.html"> back</a>'.'<p>');
}

if(empty($_POST['username'] || empty($_POST['password']) || empty($_POST['email']))){
 exit('<p style="font-family: sans-serif;">'.'Values empty. Try again.'.'<a style="text-decoration: none; color: #148ec7" href="./register.html"> back</a>'.'<p>');
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
  exit('<p style="font-family: sans-serif;">'.'Valid email is required. Try again.'.'<a style="text-decoration: none; color: #148ec7" href="./register.html"> back</a>'.'<p>');
}

if (strlen($_POST["password"]) < 8) {
  exit('<p style="font-family: sans-serif;">'.'Password must be at least 8 characters. Try again.'.'<a style="text-decoration: none; color: #148ec7" href="./register.html"> back</a>'.'<p>');
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
  exit('<p style="font-family: sans-serif;">'.'Password must contain at least 1 letter. Try again.'.'<a style="text-decoration: none; color: #148ec7" href="./register.html"> back</a>'.'<p>');
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
  exit('<p style="font-family: sans-serif;">'.'Password must contain at least 1 number. Try again.'.'<a style="text-decoration: none; color: #148ec7" href="./register.html"> back</a>'.'<p>');
}

if ($_POST["password"] != $_POST["password_confirmation"]) {
  exit('<p style="font-family: sans-serif;">'.'Password must match. Try again.'.'<a style="text-decoration: none; color: #148ec7" href="./register.html"> back</a>'.'<p>');
}

// check if details already exist or if new enter into database
if($stmt = $con->prepare('SELECT id, password FROM system_users WHERE username = ?')){
 $stmt->bind_param('s',$_POST['username']);
 $stmt->execute();
 $stmt->store_result();

 if($stmt->num_rows>0){
  echo '<p style="font-family: sans-serif;">'.'Username already exists. Try again.'.'<a style="text-decoration: none; color: #148ec7" href="./register.html"> back</a>'.'<p>';
 }
//  send data to database
 else{
  if($stmt = $con->prepare('INSERT INTO system_users (username, password, email) VALUES (?, ?, ?)')){
  $password = $_POST['password'];
  $hash = password_hash($password, PASSWORD_DEFAULT);
   $stmt->bind_param('sss', $_POST['username'], $hash, $_POST['email']);
   $stmt->execute();
   echo header("Location: login.php");
   
 }
 else {
  echo 'Error Occured';
}
 }
$stmt->close();
}
else{
 echo 'Error occured';
}

$con->close();
?>



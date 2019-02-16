<?php
// Initialize the session
session_start();
require_once "config.php";

$verified = $email = "";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
} 
else {
  //$sql = "SELECT id, username, password, email, verified FROM users WHERE username = :username";
  //$verified = $row["verified"];
  if($_SESSION["verified"] !== 1){
    header("location: pleaseactivate.php");

    /*$email = $row["email"];

    $to = "charleswmc19970124@gmail.com"
    $subject = "Testing";
    $txt = "Hello, tesing for sending email";
    $header = "From: eie3117group7b@gmail.com" . "\r\n" . "CC: somebodyelse@example.com";

    mail($to, $subject, $txt, $header);*/

  }
  // check the user have registered passenger or not
  $sql = "SELECT username FROM passengers WHERE username = :username";
  if($stmt = $pdo->prepare($sql))
  {
      // Bind variables to the prepared statement as parameters
      $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

      // Set parameters
      $param_username = $_SESSION['username'];

      // Attempt to execute the prepared statement
      if($stmt->execute())
      {
          if($stmt->rowCount() >= 1) { $_SESSION["passengers"] = true; }
          else { $_SESSION["passengers"] = false; }
      }
      else
      {
          header("location: logout.php");
          exit;
      }
  }
    // check the user have registered driver or not
  $sql = "SELECT username FROM drivers WHERE username = :username";
  if($stmt = $pdo->prepare($sql))
  {
      // Bind variables to the prepared statement as parameters
      $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

      // Set parameters
      $param_username = $_SESSION['username'];

      // Attempt to execute the prepared statement
      if($stmt->execute())
      {
          if($stmt->rowCount() >= 1) { $_SESSION["drivers"] = true; }
          else { $_SESSION["drivers"] = false; }
      }
      else
      {
          header("location: logout.php");
          exit;
      }
  }
}



$sql = "SELECT id, username, password, verified FROM users WHERE username = :username";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>

 
<!-- Nav Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <nav class="navbar navbar-dark bg-dark  " >
      <a class="navbar-brand" href="#">
        <img src="photo/polyu.png" width="30" height="30" class="d-inline-block align-top" alt="">
        EIE3117 - Integrated Project
      </a>    
    </nav>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="driver/register.php">Driver <span class="sr-only">(current)</span></a>
        </li>
         <li class="nav-item active">
          <a class="nav-link" href="passenger/home.php">Passenger <span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
    <ul class="nav justify-content-end">
      <li class="nav-item">
        <a href="reset-password.php" class="nav-link disabled" >Reset Password</a>
      </li>
      <li class="nav-item">
        <a href="logout.php" class="btn btn-danger">Sign Out</a>
      </li>
    </ul>

  </nav>
    <!-- Nav Bar -->


  <div class="card text-white bg-dark mb-3">
    <img class="card-img-top" src="photo/Uber-Driver-Requirements.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><b>Your safety is always a top priority</b></h5>
      <p class="card-text">We’re committed to helping riders and drivers get where they want to go with confidence.</p>
    </div>
  </div>

<div>
    <div class="row">
  <div class="col-sm-6">
    <div class="card border-dark text-center">
      <div class="card-body">
        <h5 class="card-title"><b>Driver</b></h5>
        <p class="card-text">Make the most of your time on the road with requests from the largest network of active riders.</p>
        <a href="driver/register.php" class="btn btn-primary">Drive</a>
      </div>
    </div>
  </div>

  <div class="col-sm-6" >
    <div class="card border-dark text-center">
      <div class="card-body">
        <h5 class="card-title"><b>Passenger</b></h5>
        <p class="card-text">Always the ride you want</p>
        <a href="passenger/home.php" class="btn btn-primary">Ride</a>
      </div>
    </div>
  </div>
</div>
</<div>

</body>
</html>

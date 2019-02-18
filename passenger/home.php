<?php


// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
else{
// {
//   $sql = "SELECT passsengerName from pending where passengerName = :username";
//   if($stmt = $pdo->prepare($sql)){
//             // Bind variables to the prepared statement as parameters
//             $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

//             // Set parameters
//             $param_username = $_SESSION['username'];

//             // Attempt to execute the prepared statement
//             if($stmt->execute()){
//                 if($stmt->rowCount() == 1){
//                     //have pending request

//                 } else{
//                     //no pending request
//                       $sql = "SELECT passsengerName from history where passengerName = :username and status = 1";
//                     if($stmt1 = $pdo->prepare($sql)){
//                               // Bind variables to the prepared statement as parameters
//                               $stmt1->bindParam(":username", $param_username, PDO::PARAM_STR);

//                               // Set parameters
//                               $param_username = $_SESSION['username'];

//                               // Attempt to execute the prepared statement
//                               if($stmt1->execute()){
//                                   if($stmt1->rowCount() == 1){
//                                       //have accepted request

//                                   } else{
//                                       //no accpeted request
                                      

//                                   }
//                               } else{
//                                   echo "Oops! Something went wrong. Please try again later.";
//                               }
//                           }

//                 }
//             } else{
//                 echo "Oops! Something went wrong. Please try again later.";
//             }
//         }


}
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
  </head>
  <body>
     <div class="container-fluid">
  <!--   <h3>Integrated Project Demo</h3> -->
    <!--The div element for the map -->
    <!-- Image and text -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <nav class="navbar navbar-dark bg-dark  " >
  <a class="navbar-brand" href="../welcome.php">
    <img src="../photo/polyu.png" width="30" height="30" class="d-inline-block align-top" alt="">
    EIE3117 - Integrated Project
  </a>    
</nav>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="#">My trips <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Profile <span class="sr-only">(current)</span></a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="#">History <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    </div>

    </nav>
    <!-- card -->
    <div class="card text-center" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Looks like you haven't taken a trip yet.</h5>
    <p class="card-text">Book a car from a web browser, no app install necessary.</p>
    <a href="looking.php" class="btn btn-primary">Request a Ride</a>
  </div>
   <!-- card -->
</div>
 <!-- <div class="container-fluid"> -->
</div>

    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
   <!--  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDQSwfy3WYNrr2lOvQTPfbGHVHpPxuUus&callback=initMap">
    </script> -->
  </body>
</html>
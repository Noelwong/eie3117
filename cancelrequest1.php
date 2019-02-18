<?php
require_once "config.php";
session_start();
$passenger_name = $driver_name = $passenger_email = $driver_email = "";

$sql1 = "SELECT * FROM history WHERE passengerName = :username OR driverName = :username";

if($stmt = $pdo->prepare($sql1)){
    $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
    $param_username = $_SESSION["username"];

    if($stmt->execute()){
        if($stmt->rowCount() >= 1){
            $count = 0;
            $records = $stmt->fetchAll();
            foreach ($records as $record) {
                $passenger_name = $record["passengerName"];
                $driver_name = $record["driverName"];
            }                
        }
    }
}

$sql2 = "SELECT * FROM users WHERE username = :name";

if($stmt = $pdo->prepare($sql2)){
    $stmt->bindParam(":name", $param_passengername, PDO::PARAM_STR);
    $param_passengername = $passenger_name;

    if($stmt->execute()){
        if($stmt->rowCount() >= 1){
            $count = 0;
            $records = $stmt->fetchAll();
            foreach ($records as $record) {
                $passenger_email = $record["email"];
                //$driver_email = $record["driverName"];
            }
        $htmlStr = "";
        $htmlStr .= "Hi " . $param_username . "\r\n\n";

        $htmlStr .= "Your current request has been canceled. \r\n\n";

        $to = $passenger_email;
        $subject = "Request Canceled!!!!";
        $header = "From: eie3117group7b@gmail.com" . "\r\n" . "CC: somebodyelse@example.com";

        mail($to, $subject, $htmlStr, $header);                
        }
    }
}

$sql3 = "SELECT * FROM users WHERE username = :name";

if($stmt = $pdo->prepare($sql3)){
    $stmt->bindParam(":name", $param_drivername, PDO::PARAM_STR);
    $param_drivername = $driver_name;

    if($stmt->execute()){
        if($stmt->rowCount() >= 1){
            $count = 0;
            $records = $stmt->fetchAll();
            foreach ($records as $record) {
                //$passenger_email = $record["email"];
                $driver_email = $record["email"];
            }
        $htmlStr = "";
        $htmlStr .= "Hi " . $param_username . "\r\n\n";

        $htmlStr .= "Your current request has been canceled. \r\n\n";

        $to = $driver_email;
        $subject = "Request Canceled!!!!";
        $header = "From: eie3117group7b@gmail.com" . "\r\n" . "CC: somebodyelse@example.com";
        mail($to, $subject, $htmlStr, $header);                
        }
    }
}

$sql = "DELETE FROM history WHERE passengerName = :username OR driverName = :username  AND startingLocation_lat = :startingLocation_lat AND destination_lat = :destination_lat AND pickUpTime = :pickUpTime ";

if($stmt = $pdo->prepare($sql)){
    $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
    $stmt->bindParam("startingLocation_lat", $param_startingLocation_lat, PDO::PARAM_STR);
    $stmt->bindParam("destination_lat", $param_destination_lat, PDO::PARAM_STR);
    $stmt->bindParam("pickUpTime", $param_pickUpTimet, PDO::PARAM_STR);
    //$stmt->bindParam("startingLocation_lat", $param_startingLocation_lat, PDO::PARAM_STR);

    $param_username = $_SESSION["username"];
    $param_startingLocation_lat = $_SESSION["startingLocation_addr"];
    $param_destination_lat = $_SESSION["destination_addr"];
    $param_pickUpTimet = $_SESSION["pickupTime"];

    if($stmt->execute())
    {

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Current Request (related to yourself)</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 720px; padding: 20px; }
        .btn_home:link{ color: white; text-decoration: none; font-weight: normal }
        .btn_home:visited{ color: white; text-decoration: none; font-weight: normal }
        .btn_home:active{ color: white; text-decoration: none }
        .btn_home:hover{ color: white; text-decoration: none; font-weight: none }
    </style>
</head>
<body>
    <!--Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
        <div class="navbar-brand" >
            <a href="welcome.php" class="btn_home">
                <img src="../photo/polyu.png" width="30" height="30" class="d-inline-block align-top" alt="">
                EIE3117 - Integrated Project 
            </a>
            
        </div>
        <ul class="navbar-nav mr-auto my-auto">
          <li class="nav-item active">
            <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="searching.php">Search Rides <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Profile <span class="sr-only">(current)</span></a>
          </li>
           <li class="nav-item active">
            <a class="nav-link" href="#">History <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <span class="navbar-text navbar-right">
            Don't drive when you drink
        </span>
    </nav>
    <!-- Nav Bar-->
    <div class="wrapper">
        <h2>Cancel Request</h2>
        <p>Request is canceled. An email has been sent to the passenger/driver for notification!</p>
    </div>
</body>
</html>

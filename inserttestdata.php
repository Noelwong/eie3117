<?php
require_once "config.php";


$sql = "INSERT INTO history (passengerName, driverName, startingLocation_lat, destination_lat, totalcharge, status) VALUES (:passengerName, :driverName, :startingLocation_lat, :destination_lat,  :totalcharge, :status)";

if($stmt = $pdo->prepare($sql)){
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":passengerName", $param_passengerName, PDO::PARAM_STR);
    $stmt->bindParam(":driverName", $param_driverName, PDO::PARAM_STR);
    $stmt->bindParam(":startingLocation_lat", $param_startingLocation_lat, PDO::PARAM_STR);
    $stmt->bindParam(":destination_lat", $param_destination_lat, PDO::PARAM_STR);
    //$stmt->bindParam(":pickUpTime", $param_pickUpTime, PDO::PARAM_STR);
    $stmt->bindParam("totalcharge", $param_totalcharge, PDO::PARAM_STR);
    $stmt->bindParam("status", $param_status, PDO::PARAM_STR);


    // Set parameters
    $param_passengerName = "charles2";
    $param_driverName = "charleswmc"; // Creates a password hash
    $param_startingLocation_lat = "Ma On Shan";
    $param_destination_lat = "HK airport";
    //$param_pickUpTime = "19:00:00";
    $param_totalcharge = 200;
    $param_status = "3";

    // Attempt to execute the prepared statement
    if($stmt->execute()){
        // Redirect to login page
        
    } else{
        echo "Something went wrong. Please try again later.";
    }
}

?>

<body> 
<p>Data Inserted!</p>
</body>
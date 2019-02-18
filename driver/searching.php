<?php
// Include config file
require_once "../config.php";
// Initialize the session
session_start();

$records = array(array(), array(), array(), array());

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
else
{
    if($_SESSION["drivers"] = false)
    {
        header("location: register.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Driver - Search Rides</title>
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
            <a href="../welcome.php" class="btn_home">
                <img src="../photo/polyu.png" width="30" height="30" class="d-inline-block align-top" alt="">
                EIE3117 - Integrated Project 
            </a>
            <span class="badge badge-info ml-2">Driver</span>
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
    <table class="table">
        <thead><tr>
                <th scope="col">#</th>
                
                <th scope="col">Destination Address</th>
                <th scope="col">Pick up time</th>
                <th scope="col">Free toll</th>
                <th scope="col">Tips</th>
                <th scope="col">Total charge</th>
                <th scope="col"></th>
        </tr></thead>
        <tbody>
<?php

$location = "";
if(isset($_POST['passenger']))
{

    $sql = "DELETE FROM pending where passenger = :passenger";
    $stmt = $pdo->prepare($sql);
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":passenger", $param_passenger, PDO::PARAM_STR);
    // Set parameters
    $param_passenger = $_POST['passenger'];

    if($stmt->execute())
    {
        $sql = "INSERT INTO history (passengerName, driverName, startingLocation_lat, startingLocation_lng, destination_lat, destination_lng, pickupTime, tips, freeToll, status, totalcharge) VALUES (:passengerName, :driverName, :startingLocation_lat, :startingLocation_lng, :destination_lat, :destination_lng, :pickupTime, :tips, :freeToll, :status, :totalcharge)";
        $stmt1 = $pdo->prepare($sql);
        // Bind variables to the prepared statement as parameters
        $stmt1->bindParam(":passengerName", $param_passengerName, PDO::PARAM_STR);
        $stmt1->bindParam(":driverName", $param_driverName, PDO::PARAM_STR);
        $stmt1->bindParam(":startingLocation_lat", $param_startingLocation_lat, PDO::PARAM_STR);
        $stmt1->bindParam(":startingLocation_lng", $param_startingLocation_lng, PDO::PARAM_STR);
        $stmt1->bindParam(":destination_lat", $param_destination_lat, PDO::PARAM_STR);
        $stmt1->bindParam(":destination_lng", $param_destination_lng, PDO::PARAM_STR);
        $stmt1->bindParam(":pickupTime", $param_pickupTime, PDO::PARAM_STR);
        $stmt1->bindParam(":tips", $param_tips, PDO::PARAM_STR);
        $stmt1->bindParam(":freeToll", $param_freeToll, PDO::PARAM_STR);
        $stmt1->bindParam(":status", $param_status, PDO::PARAM_STR);
        $stmt1->bindParam(":totalcharge", $param_totalcharge, PDO::PARAM_STR);
        // Set parameters
        $param_passengerName = $_POST['passenger'];
        $param_driverName = $_SESSION['username'];
        $param_startingLocation_lat = 0;
        $param_startingLocation_lng = 0;
        $param_destination_lat = 0;
        $param_destination_lng = 0;
        $param_pickupTime = $_POST['pickupTime'];
        $param_tips = $_POST['tips'];
        $param_freeToll = $_POST['freeToll'];
        $param_status = 1;
        $param_totalcharge = 200;

        if($stmt1->execute())
        {
            $_SESSION['passenger'] = $_POST['passenger'];
            $_SESSION['startingLocation_addr'] = $_POST['startingLocation_addr'];
            $_SESSION['destination_addr'] = $_POST['destination_addr'];
            $_SESSION['pickupTime'] = $_POST['pickupTime'];
            $_SESSION['freeToll'] = $_POST['freeToll'];
            $_SESSION['tips'] = $_POST['tips'];
            header("location: home.php");
            exit;
        }
        // Close statement
        unset($stmt1);

    }

    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);


}
else if(isset($_POST['Refresh']))
{
    header("location: searching.php");
    exit;
}
else
{

    $sql = "SELECT * FROM pending ";
    $stmt = $pdo->prepare($sql);
    if($stmt->execute())
    {
        if($stmt->rowCount() >= 1)
        {
            $count = 0;
            $records = $stmt->fetchAll();
            foreach ($records as $record) {
                $freeToll = $record["freeToll"] == 0 ? "No" : "Yes";
                echo "<form id=\"form".++$count."\" active=\"".htmlspecialchars($_SERVER["PHP_SELF"])."\" method=\"post\">";
                echo "<input type=\"hidden\" name=\"passenger\" value=\"".$record["passenger"]."\" /> ";
                //echo "<input type=\"hidden\" name=\"startingLocation_addr\" value=\"".$record["startingLocation_addr"]."\" /> ";
                echo "<input type=\"hidden\" name=\"destination_addr\" value=\"".$record["destination_addr"]."\" /> ";
                echo "<input type=\"hidden\" name=\"pickupTime\" value=\"".$record["pickupTime"]."\" /> ";
                echo "<input type=\"hidden\" name=\"freeToll\" value=\"".$record["freeToll"]."\" /> ";
                echo "<input type=\"hidden\" name=\"tips\" value=\"".$record["tips"]."\" /> ";
                echo "<tr><th scope=\"row\">".$count."</th>";
                //echo "<td>".$record["startingLocation_addr"]."</td>";
                echo "<td>".$record["destination_addr"]."</td>";
                echo "<td>".$record["pickupTime"]."</td><td>".$freeToll."</td><td>".$record["tips"]."</td>";
                echo "<td>".$record["totalcharge"]."</td>";
                echo "<td><input type=\"submit\" name=\"submit\" class=\"btn btn-primary mx-auto\" value=\"Accept\"></td></tr>";
                //setcookie("c_pickuplocation", $record["address"], time()+3600);
                //echo $_COOKIE["c_pickuplocation"];
                echo "</form>";
            }
        }
        else 
        {
            echo "<form active=\"".htmlspecialchars($_SERVER["PHP_SELF"])."\" method=\"post\">";
            echo "<tr align=\"center\"><td colspan=\"7\"><strong>No record</strong>";
            echo "<td><input type=\"submit\" name=\"Refresh\" class=\"btn btn-primary ml-2\" value=\"Refresh\"></td></tr>";
            echo "</form>";
        }
    }
    else
    {
        echo "<tr><td colspan=\"5\">Database Error...</td><tr>";
    }
    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);

}
?>

        </tbody>
    </table>
</body>
</html>

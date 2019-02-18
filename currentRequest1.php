<?php
session_start();
require_once "config.php";

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
      <li class="nav-item active">
        <a class="nav-link" href="#">Driver <span class="sr-only">(current)</span></a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="#">Passenger <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="currentRequest.php">Current Request<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="history.php">History<span class="sr-only">(current)</span></a>
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
    <!-- Nav Bar-->
    <table class="table">
        <thead><tr>
                <th scope="col">#</th>
                <th scope="col">Passenger</th>
                <th scope="col">Driver</th>
                <th scope="col">Pick up Location</th>
                <th scope="col">Destination</th>
                <th scope="col">Pick up time</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
        </tr></thead>
        <tbody>
            <form active="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
<?php

$startingLocation_lat = $destination_lat = $pickUpTime = "";

if(isset($_POST['submit1']))
{
    echo "<script type=\"text/javascript\">alert(\"Cancel pressed!!\");</script>";
    header("location: cancelRequest.php");
}
if(isset($_POST['startride']))
{
    echo "<script type=\"text/javascript\">alert(\"startride!\");</script>";
    $sql1 = "UPDATE history SET status = '2' WHERE passengerName = :username OR driverName = :username AND startingLocation_lat = :startingLocation_lat AND destination_lat = :destination_lat AND pickUpTime = :pickUpTime";
    if($stmt = $pdo->prepare($sql1)){
		$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        $stmt->bindParam(":startingLocation_lat", $param_startingLocation_lat, PDO::PARAM_STR);
        $stmt->bindParam(":destination_lat", $param_destination_lat, PDO::PARAM_STR);
        $stmt->bindParam(":pickUpTime", $param_pickUpTime, PDO::PARAM_STR);

	    $param_username = $_SESSION["username"];
        $param_startingLocation_lat = $_POST["startingLocation_addr"];
        $param_destination_lat = $_POST["destination_addr"];
        $param_pickUpTime = $_POST["pickupTime"];


	    if($stmt->execute())
	    {
	    }
	}
    header("location: currentRequest2.php");
}
else if(isset($_POST['Refresh']))
{
    header("location: searching.php");
    exit;
}

$sql = "SELECT * FROM history WHERE passengerName = :username OR driverName = :username";

    if($stmt = $pdo->prepare($sql)){
	$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
    $param_username = $_SESSION["username"];


    if($stmt->execute())
    {
        if($stmt->rowCount() >= 1)
        {
            $count = 0;
            $records = $stmt->fetchAll();
            foreach ($records as $record) {
                if($record["status"] == 3){
                   
                }
                else{
                    echo "<form id=\"form".++$count."\" active=\"".htmlspecialchars($_SERVER["PHP_SELF"])."\" method=\"post\">";
                    echo "<tr><th scope=\"row\">".$count."</th>";
                    echo "<input type=\"hidden\" name=\"passenger\" value=\"".$record["passengerName"]."\" /> ";
                    echo "<input type=\"hidden\" name=\"startingLocation_addr\" value=\"".$record["startingLocation_lat"]."\" /> ";
                    echo "<input type=\"hidden\" name=\"destination_addr\" value=\"".$record["destination_lat"]."\" /> ";
                    echo "<input type=\"hidden\" name=\"pickupTime\" value=\"".$record["pickUpTime"]."\" /> ";
                    //echo "<input type=\"hidden\" name=\"status\" value=\"".$record["status"]."\" /> ";
                    //echo "<input type=\"hidden\" name=\"freeToll\" value=\"".$record["freeToll"]."\" /> ";
                    echo "<input type=\"hidden\" name=\"tips\" value=\"".$record["status"]."\" /> ";
                    echo "<td>".$record["passengerName"]."</td><td>".$record["driverName"]."</td><td>";
                    echo $record["startingLocation_lat"]."</td><td>".$record["destination_lat"]."</td>";
                    echo "<td>".$record["pickUpTime"]."</td><td>";
                    echo "<td>".$record["status"]."</td><td>";
                    $_SESSION["status"] = $record["status"];
                    echo "<td><input type=\"submit\" name=\"submit".$count."\" class=\"btn btn-primary mx-auto\" value=\"Cancel\"></td>";
                    echo "<td><input type=\"submit\" name=\"startride\" class=\"btn btn-primary mx-auto\" value=\"StartRide\"></td>";
                    //echo "<td><input type=\"submit\" name=\"Complete\" class=\"btn btn-primary mx-auto\" value=\"Complete\"></td></tr>";
                    echo "</form>";
                /*echo "<input type=\"hidden\" name=\"passenger\" value=\"".$record["passengerName"]."\" /> ";

                echo "<input type=\"hidden\" name=\"startingLocation_addr\" value=\"".$record["startingLocation_lat"]."\" /> ";
                echo "<input type=\"hidden\" name=\"destination_addr\" value=\"".$record["destination_lat"]."\" /> ";
                echo "<input type=\"hidden\" name=\"pickupTime\" value=\"".$record["pickupTime"]."\" /> ";
                //echo "<input type=\"hidden\" name=\"freeToll\" value=\"".$record["freeToll"]."\" /> ";
                echo "<input type=\"hidden\" name=\"tips\" value=\"".$record["status"]."\" /> ";*/
                }

            }
                
        }
    }
}

?>
            </form>
        </tbody>
    </table>

</body>
</html>
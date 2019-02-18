<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'eie3117');

$pdo = "";
/* Attempt to connect to MySQL database */
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

session_start();
echo("<script>console.log('PHP locations_model: ".$_SESSION["username"]."');</script>");

// Gets data from URL parameters.
if(isset($_POST['request_submit'])) {
    $username = $_SESSION["username"];
    $startingLocation_addr = $_POST["startingLocation_addr"];
    $startingLocation_lat = $_POST["startingLocation_lat"];
    $startingLocation_lng = $_POST["startingLocation_lng"];
    $destination_addr = $_POST["destination_addr"];
    $destination_lat = $_POST["destination_lat"];
    $destination_lng = $_POST["destination_lng"];
    $startingLocation_placeID = $_POST['startingLocation_placeID'];
    $destination_placeID = $_POST['destination_placeID'];
    $pickUpTime =$_POST['pickUpTime'];
    $tips = $_POST['tips'];
    $freeToll = $_POST['freeToll'];

        $sql = "INSERT INTO pending (passenger, startingLocation_addr, startingLocation_placeid, startingLocation_lat, startingLocation_lng, destination_addr, destination_placeid, destination_lat, destination_lng, pickupTime, freeToll, tips) VALUES (:passenger, :startingLocation_addr, :startingLocation_placeid, :startingLocation_lat, :startingLocation_lng, :destination_addr, :destination_placeid, :destination_lat, :destination_lng, :pickupTime, :freeToll, :tips);";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":passenger", $param_passenger, PDO::PARAM_STR);
            $stmt->bindParam(":startingLocation_addr", $param_startingLocation_addr, PDO::PARAM_STR);
            $stmt->bindParam(":startingLocation_placeid", $param_startingLocation_placeid, PDO::PARAM_STR);
            $stmt->bindParam(":startingLocation_lat", $param_startingLocation_lat, PDO::PARAM_STR);
            $stmt->bindParam(":startingLocation_lng", $param_startingLocation_lng, PDO::PARAM_STR);
            $stmt->bindParam(":destination_addr", $param_destination_addr, PDO::PARAM_STR);
            $stmt->bindParam(":destination_placeid", $param_destination_placeid, PDO::PARAM_STR);
            $stmt->bindParam(":destination_lat", $param_destination_lat, PDO::PARAM_STR);
            $stmt->bindParam(":destination_lng", $param_destination_lng, PDO::PARAM_STR);
            $stmt->bindParam(":pickupTime", $param_pickupTime, PDO::PARAM_STR);
            $stmt->bindParam(":freeToll", $param_freeToll, PDO::PARAM_STR);
            $stmt->bindParam(":tips", $param_tips, PDO::PARAM_STR);


            // Set parameters
            $param_passenger = $username;
            $param_startingLocation_addr = $startingLocation_addr;
            $param_startingLocation_placeid = $startingLocation_placeID;
            $param_startingLocation_lat = $startingLocation_lat;
            $param_startingLocation_lng = $startingLocation_lng;
            $param_destination_addr = $destination_addr;
            $param_destination_placeid = $destination_placeID;
            $param_destination_lat = $destination_lat;
            $param_destination_lng = $destination_lng;
            $param_pickupTime = $pickUpTime;
            $param_freeToll = $freeToll;
            $param_tips = $tips;

echo("<script>console.log('PHP address: ".$param_startingLocation_addr."');</script>");
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                echo"Inserted Successfully";
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    // Close connection
    unset($pdo);

}
if(isset($_GET['confirm_location'])) {
    confirm_location();
}
//=============================

    // $con=mysqli_connect ("localhost", 'root', '','eie3117');
    // if (!$con) {
    //     die('Not connected : ' . mysqli_connect_error());
    // }
    // $username = $_SESSION["username"];
    // // $startingLocation_placeID = $_GET['startingLocation_placeID'];
    // // $destination_placeID = $_GET['destination_placeID'];

    // $pickUpTime = $_POST['pickUpTime'];
    // $tips = $_POST['tips'];
    // $freeToll = $_POST['freeToll'];


    // // Inserts new row with place data.
    // $query = sprintf("INSERT INTO passengers " .
    //     " (username, homeLocation, workLocation, startingLocation_placeID, destination_placeID, pickUpTime,tips,freeToll) " .
    //     " VALUES ('%s', NULL, NULL,NULL,NULL,'%s', '%s', '%s');",
    //     mysqli_real_escape_string($con,$username),
    //     // mysqli_real_escape_string($con,$startingLocation_placeID),
    //     // mysqli_real_escape_string($con,$destination_placeID),
    //     mysqli_real_escape_string($con,$pickUpTime),
    //     mysqli_real_escape_string($con,$tips),
    //     mysqli_real_escape_string($con,$freeToll));

    // $result = mysqli_query($con,$query);
    // echo"Inserted Successfully";
    // if (!$result) {
    //     die('Invalid query: ' . mysqli_error($con));
    // }
    //=============================


function add_location(){
    //$con=mysqli_connect ("localhost", 'root', '','eie3117');
    // if (!$con) {
    //     die('Not connected : ' . mysqli_connect_error());
    // }
    $username = $_SESSION["username"];
    $startingLocation_addr = $_POST["startingLocation_addr"];
    $startingLocation_lat = $_POST["startingLocation_lat"];
    $startingLocation_lng = $_POST["startingLocation_lng"];

    $destination_addr = $_POST["destination_addr"];
    $destination_lat = $_POST["destination_lat"];
    $destination_lng = $_POST["destination_lng"];
    $startingLocation_placeID = $_POST['startingLocation_placeID'];
    $destination_placeID = $_POST['destination_placeID'];
    $pickUpTime =$_POST['pickUpTime'];
    $tips = $_POST['tips'];
    $freeToll = $_POST['freeToll'];

// echo("<script>console.log('PHP username: ".$username."');</script>");
// echo("<script>console.log('PHP username: ".$startingLocation_placeID."');</script>");
// echo("<script>console.log('PHP username: ".$destination_placeID."');</script>");
// echo("<script>console.log('PHP username: ".$tips."');</script>");
// echo("<script>console.log('PHP locations_model: ".$pickUpTime."');</script>");
// echo("<script>console.log('PHP locations_model: ".$freeToll."');</script>");
    // Inserts new row with place data.

 
// echo("<script>console.log('PHP address: ".$_POST["destination_addr"]."');</script>");

//     $query = sprintf("INSERT INTO pending " .
//         " (`passenger`, `startingLocation_addr`, `startingLocation_placeid`, `startingLocation_lat`, `startingLocation_lng`, `destination_addr`, `destination_placeid`, `destination_lat`, `destination_lng`, `pickupTime`, `freeToll`, `tips`) " .
//         " VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s');",
//         mysqli_real_escape_string($con,$username),
//         mysqli_real_escape_string($con,$startingLocation_addr),
//         mysqli_real_escape_string($con,$startingLocation_placeID),
//         mysqli_real_escape_string($con,$startingLocation_lat),
//         mysqli_real_escape_string($con,$startingLocation_lng),
//         mysqli_real_escape_string($con,$destination_addr),
//         mysqli_real_escape_string($con,$destination_placeID),
//         mysqli_real_escape_string($con,$destination_lat),
//         mysqli_real_escape_string($con,$destination_lng),
//         mysqli_real_escape_string($con,$pickUpTime),
//         mysqli_real_escape_string($con,$tips),
//         mysqli_real_escape_string($con,$freeToll));
      


    // $result = mysqli_query($con,$query);
        // echo"Inserted Successfully";
    // if (!$result) {
    //     die('Invalid query: ' . mysqli_error($con));
    // }

    $sql = "INSERT INTO pending (passenger, startingLocation_addr, startingLocation_placeid, startingLocation_lat, startingLocation_lng, destination_addr, destination_placeid, destination_lat, destination_lng, pickupTime, freeToll, tips) VALUES (:passenger, :startingLocation_addr, :startingLocation_placeid, :startingLocation_lat, :startingLocation_lng, :destination_addr, :destination_placeid, :destination_lat, :destination_lng, :pickupTime, :freeToll, :tips);";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":passenger", $param_passenger, PDO::PARAM_STR);
            $stmt->bindParam(":startingLocation_addr", $param_startingLocation_addr, PDO::PARAM_STR);
            $stmt->bindParam(":startingLocation_placeid", $param_startingLocation_placeid, PDO::PARAM_STR);
            $stmt->bindParam(":startingLocation_lat", $param_startingLocation_lat, PDO::PARAM_STR);
            $stmt->bindParam(":startingLocation_lng", $param_startingLocation_lng, PDO::PARAM_STR);
            $stmt->bindParam(":destination_addr", $param_destination_addr, PDO::PARAM_STR);
            $stmt->bindParam(":destination_placeid", $param_destination_placeid, PDO::PARAM_STR);
            $stmt->bindParam(":destination_lat", $param_destination_lat, PDO::PARAM_STR);
            $stmt->bindParam(":destination_lng", $param_destination_lng, PDO::PARAM_STR);
            $stmt->bindParam(":pickupTime", $param_pickupTime, PDO::PARAM_STR);
            $stmt->bindParam(":freeToll", $param_freeToll, PDO::PARAM_STR);
            $stmt->bindParam(":tips", $param_tips, PDO::PARAM_STR);


            // Set parameters
            $param_passenger = $username;
            $param_startingLocation_addr = $startingLocation_addr;
            $param_startingLocation_placeid = $startingLocation_placeID;
            $param_startingLocation_lat = $startingLocation_lat;
            $param_startingLocation_lng = $startingLocation_lng;
            $param_destination_addr = $destination_addr;
            $param_destination_placeid = $destination_placeID;
            $param_destination_lat = $destination_lat;
            $param_destination_lng = $destination_lng;
            $param_pickupTime = $pickUpTime;
            $param_freeToll = $freeToll;
            $param_tips = $tips;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                echo"Inserted Successfully";
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    // Close connection
    unset($pdo);

}

//     $sql = "INSERT INTO passengers (username, homeLocation, workLocation, startingLocation_placeID,destination_placeID, pickUpTime,tips, freeToll)
// VALUES ('noelwong','NULL','NULL','NULL','NULL','NULL','NULL','NULL')";

// if ($conn->query($sql) === TRUE) {
//     echo "New record created successfully";
// } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }

// }
function confirm_location(){
    $con=mysqli_connect ("localhost", 'root', '','demo');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    $id =$_GET['id'];
    $confirmed =$_GET['confirmed'];
    // update location with confirm if admin confirm.
    $query = "update locations set location_status = $confirmed WHERE id = $id ";
    $result = mysqli_query($con,$query);
    echo "Inserted Successfully";
    if (!$result) {
        die('Invalid query: ' . mysqli_error($con));
    }
}
function get_confirmed_locations(){
    $con=mysqli_connect ("localhost", 'root', '','demo');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    // update location with location_status if admin location_status.
    $sqldata = mysqli_query($con,"
select id ,lat,lng,description,location_status as isconfirmed
from locations WHERE  location_status = 1
  ");

    $rows = array();

    while($r = mysqli_fetch_assoc($sqldata)) {
        $rows[] = $r;

    }

    $indexed = array_map('array_values', $rows);
    //  $array = array_filter($indexed);

    echo json_encode($indexed);
    if (!$rows) {
        return null;
    }
}
function get_all_locations(){
    $con=mysqli_connect ("localhost", 'root', '','demo');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    // update location with location_status if admin location_status.
    $sqldata = mysqli_query($con,"
select id ,lat,lng,description,location_status as isconfirmed
from locations
  ");

    $rows = array();
    while($r = mysqli_fetch_assoc($sqldata)) {
        $rows[] = $r;

    }
  $indexed = array_map('array_values', $rows);
  //  $array = array_filter($indexed);

    echo json_encode($indexed);
    if (!$rows) {
        return null;
    }
}
function array_flatten($array) {
    if (!is_array($array)) {
        return FALSE;
    }
    $result = array();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, array_flatten($value));
        }
        else {
            $result[$key] = $value;
        }
    }
    return $result;
}

?>
<?php
require("config.php");

// session_start();
echo("<script>console.log('PHP locations_model: ".$_SESSION["username"]."');</script>");

// Gets data from URL parameters.
if(isset($_GET['add_location'])) {
    add_location();
}
if(isset($_GET['confirm_location'])) {
    confirm_location();
}



function add_location(){
    $con=mysqli_connect ("localhost", 'root', '','eie3117');
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    $username = $_SESSION["username"];
    $startingLocation_placeID = $_GET['startingLocation_placeID'];
    $destination_placeID = $_GET['destination_placeID'];
    $pickUpTime =$_GET['pickUpTime'];
    $tips = $_GET['tips'];
    $freeToll = $_GET['freeToll'];


    // Inserts new row with place data.
    // $query = sprintf("INSERT INTO passengers " .
    //     " (username, homeLocation, workLocation, startingLocation_placeID, destination_placeID, pickUpTime,tips,freeToll) " .
    //     " VALUES ('%s', NULL, NULL,'%s','%s','%s', '%s', '%s');",
    //     mysqli_real_escape_string($con,$username),
    //     mysqli_real_escape_string($con,$startingLocation_placeID),
    //     mysqli_real_escape_string($con,$destination_placeID),
    //     mysqli_real_escape_string($con,$pickUpTime),
    //     mysqli_real_escape_string($con,$tips),
    //     mysqli_real_escape_string($con,$freeToll));

    // $result = mysqli_query($con,$query);
    // echo"Inserted Successfully";
    // if (!$result) {
    //     die('Invalid query: ' . mysqli_error($con));
    // }

    $sql = "INSERT INTO passengers (username, homeLocation, workLocation, startingLocation_placeID,destination_placeID, pickUpTime,tips, freeToll)
VALUES ('noelwong','NULL','NULL','NULL','NULL','NULL','NULL','NULL')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}
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
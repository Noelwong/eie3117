<?php
// Initialize the session
require_once "../config.php";
session_start();
echo $_SESSION["username"];
$param_username = $_SESSION["username"];
echo $param_username;
$errMessage = "";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
/*else
{
    if($_SESSION["drivers"] = false)
    {
        header("location: driver/register.php");
        exit;
    }
}*/

if(isset($_SESSION['driver']))
{
    $sql = "SELECT username FROM drivers WHERE username = :username";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

        // Set parameters
        $param_username = $_SESSION["username"];

        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $_SESSION["drivers"] = true;
            } else{
                $_SESSION["drivers"] = false;
                header("location: register.php");
                exit;
            }
        }
    }
}
else
{ 
    if(isset($_SESSION['status']))
}

unset($stmt);
unset($pdo);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Driver - Home</title>
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

    <div class="wrapper">
        <h3>Home</h3>

        <!-- card -->
        <div class="card text-center" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title">Many passengers are waiting for you.</h5>
            <p class="card-text">Let's drive and take the passengers to their destination.</p>
            <a href="searching.php" class="btn btn-primary">Search Ride</a>
          </div>
        </div>
    </div>
    
   <!-- card -->


</body>
</html>

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
                <th scope="col">Destination</th>
                <th scope="col">Pick up time</th>
                <th scope="col">Free toll</th>
                <th scope="col">Tips</th>
                <th scope="col"></th>
        </tr></thead>
        <tbody>
            <form active="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<?php

$location = "";

if(isset($_POST['submit1']))
{
    echo "<script type=\"text/javascript\">alert(\"submit pressed!!\");</script>";
}
else if(isset($_POST['Refresh']))
{
    header("location: searching.php");
    exit;
}
else
{

    $sql = "SELECT * FROM pending_ride ";
    $stmt = $pdo->prepare($sql);

    if($stmt->execute())
    {
        if($stmt->rowCount() >= 1)
        {
            $count = 0;
            $records = $stmt->fetchAll();
            foreach ($records as $record) {
                echo "<tr><th scope=\"row\">".++$count."</th>";
                echo "<td>".$record["address"]."</td><td>".$record["pickupTime"]."</td><td>";
                echo $record["freeToll"]."</td><td>".$record["tips"]."</td>";
                echo "<td><input type=\"submit\" name=\"submit".$count."\" class=\"btn btn-primary mx-auto\" value=\"Accept\"></td></tr>";
                //setcookie("c_pickuplocation", $record["address"], time()+3600);
                //echo $_COOKIE["c_pickuplocation"];
            }
        }
        else 
        {
            echo "<tr align=\"center\"><td colspan=\"6\"><strong>No record</strong>";
            echo "<td><input type=\"submit\" name=\"Refresh\" class=\"btn btn-primary ml-2\" value=\"Refresh\"></td></tr>";
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

            </form>
        </tbody>
    </table>

</body>
</html>
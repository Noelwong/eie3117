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
        <a class="nav-link" href="currentRequest.php">Request History <span class="sr-only">(current)</span></a>
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

        <tbody>
            <form active="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="wrapper">
        <h2>Cancel Request</h2>
        <p>Are you sure to cancel the request?</p>
<?php
if(isset($_POST['sure']))
{
    echo "<script type=\"text/javascript\">alert(\"Cancel pressed!\");</script>";
    header("location: cancelRequest1.php");
}
if(isset($_POST['no']))
{
    echo "<script type=\"text/javascript\">alert(\"No!\");</script>";
    header("location: welcome.php");
}
else if(isset($_POST['Refresh']))
{
    header("location: searching.php");
    exit;
}
echo "<td><input type=\"submit\" name=\"sure\" class=\"btn btn-primary mx-auto\" value=\"Sure\"></td>";
echo "  ";
echo "<td><input type=\"submit\" name=\"no\" class=\"btn btn-primary mx-auto\" value=\"No\"></td>";

?>
            </form>
        </tbody>


</body>
</html>
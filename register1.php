<?php
// Include config file
require_once "config.php";
require_once ("PHPMailer/PHPMailer.php");

echo $_COOKIE["c_username"];
$username = $_COOKIE["c_username"];
//session_start();
//REQUIRE_ONCE "PHPmailer";
// Define variables and initialize with empty values

$homeLocation = $workLocation = "";             //data saved into passenger
$homeLocation_err = $workLocation_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate home address
    if(empty(trim($_POST["homeLocation"]))){
        $homeLocation_err = "Please enter your home address.";
    } else{
        $homeLocation = trim($_POST["homeLocation"]);
    }

    // Vlidate work address
    if(empty(trim($_POST["workLocation"]))){
        $workLocation_err = "Please enter your home address.";
    } else{
        $workLocation = trim($_POST["workLocation"]);
    }

    // Check input errors before inserting in database
    if(empty($homeLocation_err) && empty($workLocation_err)){

        // Prepare an insert statement
        $sql1 = "INSERT INTO passengers (username, homeLocation, workLocation) VALUES (:username, :homeLocation, :workLocation)";

        if($stmt = $pdo->prepare($sql1)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":homeLocation", $param_homeLocation, PDO::PARAM_STR);
            $stmt->bindParam(":workLocation", $param_workLocation, PDO::PARAM_STR);

            // Set parameters
            $param_username = $username;
            $param_homeLocation = $homeLocation;
            $param_workLocation = $workLocation;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        // Close statement
        unset($stmt);
    }


    // Close connection
    unset($pdo);
    setcookie("c_email", $_POST["email"], time()-3600);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($homeLocation_err)) ? 'has-error' : ''; ?>">
                <label>Home Address</label>
                <input type="text" name="homeLocation" class="form-control" value="<?php echo $homeLocation; ?>">
                <span class="help-block"><?php echo $homeLocation_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($workLocation_err)) ? 'has-error' : ''; ?>">
                <label>Working Address</label>
                <input type="text" name="workLocation" class="form-control" value="<?php echo $workLocation; ?>">
                <span class="help-block"><?php echo $workLocation_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</body>
</html>

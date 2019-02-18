<?php
require_once "../../config.php";
session_start();

$start = $dest = $time = $tips = $freetoll = $charge ="";
$start_err = $dest_err = $time_err = $tips_err = $freetoll_err = $charge_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate home address
    if(empty(trim($_POST["start"]))){
        $start_err = "Please enter the pick up location.";
    } else{
        $start = trim($_POST["start"]);
    }

    // Vlidate work address
    if(empty(trim($_POST["dest"]))){
        $dest_err = "Please enter the destination.";
    } else{
        $dest = trim($_POST["dest"]);
    }

    if(empty(trim($_POST["time"]))){
        $time_err = "Please enter the pick up time.";
    } else{
        $time = trim($_POST["time"]);
    }

    if(!empty(trim($_POST["tips"]))){
        $tips = trim($_POST["tips"]);
    }

    if(empty(trim($_POST["freetoll"]))){
        $freetoll_err = "Please enter Yes or No.";
    } else{
        $freetoll = trim($_POST["freetoll"]);
    }
    if(empty(trim($_POST["charge"]))){
        $charge_err = "Please enter Yes or No.";
    } else{
        $charge = trim($_POST["charge"]);
    }

    // Check input errors before inserting in database
    if(empty($start_err) && empty($dest_err) && empty($time_err)){

        // Prepare an insert statement
        $sql = "UPDATE passengers
                set startingLocation_placeID = :startingLocation_placeID, destination_placeID = :destination_placeID, pickUpTime = :pickUpTime
                where username = :username";
        if($stmt = $pdo->prepare($sql)){
        	$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        	$stmt->bindParam(":startingLocation_placeID", $param_start, PDO::PARAM_STR);
            $stmt->bindParam(":destination_placeID", $param_dest, PDO::PARAM_STR);
            $stmt->bindParam(":pickUpTime", $param_time, PDO::PARAM_STR);
        	$param_username = $_SESSION["username"];


            $param_start = $start;
            $param_dest = $dest;
            $param_time = $time;
        	if($stmt->execute()){
        		header("location: ../displayDistance.php");
        	}

		}
        // Close statement
        unset($stmt);
    }


    // Close connection
    unset($pdo);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Text input</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Request Form</h2>
        <p>Please fill in the form.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($start_err)) ? 'has-error' : ''; ?>">
                <label>Pick Up Location*</label>
                <input type="text" name="start" class="form-control">
                <span class="help-block"><?php echo $start_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($dest_err)) ? 'has-error' : ''; ?>">
                <label>Destination*</label>
                <input type="text" name="dest" class="form-control">
                <span class="help-block"><?php echo $dest_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($time_err)) ? 'has-error' : ''; ?>">
                <label>Pick up time*</label>
                <input type="time" name="time" class="form-control">
                <span class="help-block"><?php echo $time_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($tips_err)) ? 'has-error' : ''; ?>">
                <label>Tips</label>
                <input type="number" name="tips" class="form-control">
                <span class="help-block"><?php echo $tips_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($freetoll_err)) ? 'has-error' : ''; ?>">
                <label>Free Toll* (Yes or No)</label>
                <input type="text" name="tips" class="form-control">
                <span class="help-block"><?php echo $freetoll_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($charge_err)) ? 'has-error' : ''; ?>">
                <label>Total charge* (Yes or No)</label>
                <input type="number" name="charge" class="form-control">
                <span class="help-block"><?php echo $charge_err; ?></span>
            </div>
            <p>* Must enter content!</p>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p><a href="../displayDistance.php">Previous Page</a></p>
        </form>
    </div>
    <!--js-->
    
</body>
</html>

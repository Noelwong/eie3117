<?php
// Include config file
require_once "../config.php";
// Initialize the session
session_start();

$errMessage = "";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
/*else
{
	if($_SESSION["drivers"] = true)
    {
        header("location: home.php");
        exit;
    }
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Driver Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        th{ font: 18px; text-align: center; }
        td{ text-align: center;}
        .wrapper{ width: 720px; padding: 20px; }
        .btn_home:link{ color: white; text-decoration: none; font-weight: normal }
        .btn_home:visited{ color: white; text-decoration: none; font-weight: normal }
        .btn_home:active{ color: white; text-decoration: none }
        .btn_home:hover{ color: white; text-decoration: none; font-weight: none }
    </style>
</head>
<body>
<?php
if(isset($_POST['reset']))
{
    header("location: register_driver.php");
}
else if(isset($_POST['submit_N']) || isset($_POST['submit_L']))
{
	if(!isset($_POST['carModel']))
	{
		$errMessage = "Please select a car model.";
	}
	else if(empty(trim($_POST['carPlateNum'])))
	{
		$errMessage = "Please type your car plate number.";
	}
	else if(strlen(trim($_POST['carPlateNum'])) > 8)
	{
		$errMessage = "The car plate number is invalid.";
	}
	/*else if(!isset($_FILES['profileImg']))
	{
		$errMessage = "Please select a profile picture.";
	}*/
	else
	{
		// Check duplicated car plate number
	    $sql = "SELECT carPlateNum FROM drivers WHERE carPlateNum = :carPlateNum";
		if($stmt = $pdo->prepare($sql))
		{
		    // Bind variables to the prepared statement as parameters
		    $stmt->bindParam(":carPlateNum", $param_carPlateNum, PDO::PARAM_STR);

		    // Set parameters
		    $param_carPlateNum = strtoupper(trim($_POST["carPlateNum"]));

		    // Attempt to execute the prepared statement
		    if($stmt->execute())
		    {
	        if($stmt->rowCount() >= 1)
	        {
	            $errMessage = "This car plate number is already registered.";
	        } 
	        else
	        {
				    // Prepare an insert statement
				    $sql = "INSERT INTO drivers (username, carClass, carModel, carPlateNum) VALUES (:username, :carClass, :carModel, :carPlateNum)";

				    if($stmt = $pdo->prepare($sql))
				    {
			        // Bind variables to the prepared statement as parameters
			        $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
			        $stmt->bindParam(":carClass", $param_carClass, PDO::PARAM_STR);
			        $stmt->bindParam(":carModel", $param_carModel, PDO::PARAM_STR);
			        $stmt->bindParam(":carPlateNum", $param_carPlateNum, PDO::PARAM_STR);
			        //$stmt->bindParam(":profileImg", $param_profileImg, PDO::PARAM_STR);

			        // Set parameters
			        $param_username = $_SESSION["username"];
			        if(isset($_POST['submit_N'])) { $param_carClass = "Normal"; }
			        else if(isset($_POST['submit_L'])) { $param_carClass = "Large"; }
			        $param_carModel = $_POST['carModel'];
			        $param_carPlateNum = strtoupper(trim($_POST["carPlateNum"]));
			        //$param_profileImg = addslashes(file_get_contents($_FILES['profileImg']['tmp_name']));

			        //Attempt to execute the prepared statement
			        if($stmt->execute())
			        {
		            // Successed, Redirect to Welcome page
								echo "<script>
								$(document).ready(function() 
								{ $(\"#success_message\").modal('show'); }
								);
								</script>";
			        } 
			        else
			        {
			        	// Failed, Redirect to Welcome page
								echo "<script>
								$(document).ready(function() 
								{ $(\"#fail_message\").modal('show'); }
								);
								</script>";	
							}
				    }
	        }
		    }
		    else
		    {
        	// Failed, Redirect to Welcome page
					echo "<script>
					$(document).ready(function() 
					{ $(\"#fail_message\").modal('show'); }
					);
					</script>";	
		    }
		}

	}
    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);
}
?>

   <!--Nav Bar -->
    <nav class="navbar navbar-dark bg-dark sticky-top" >
        <div class="navbar-brand" >
            <a href="../welcome.php" class="btn_home">
                <img src="../photo/polyu.png" width="30" height="30" class="d-inline-block align-top" alt="">
                EIE3117 - Integrated Project
            </a>
        </div>
    </nav>
    <!-- Nav Bar-->

    <div class="wrapper">
    	<h2>Driver Registration</h2>
	    <div id="carClass">
	    	<h5>Choose Car Class</h5>
			<?php
			if($errMessage !== "")
			{
				?>
	        	<div class="alert alert-warning">
					<?php echo $errMessage; ?>
				</div>
			<?php
			}
			?>
		    <div class="card">
				<div class="card-header">
					<a class="collapsed card-link" data-toggle="collapse" href="#collapseNormal">
					  Normal(4 seats)
					</a>
				</div>
				<div id="collapseNormal" class="collapse" data-parent="#carClass">
					<div class="card-body">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<table>
              	<tr>
              		<td>
              			<label for="normalCar1">
              				<img src="photo/Lexus ES250 Ultimate.jpg" width="320" height="180"/>
              			</label>
              		</td>
              		<td>
              			<label for="normalCar2">
              				<img src="photo/Tesla Model S 85.jpg" width="320" height="180"/>
              			</label>
              		</td>
              	</tr>
              	<tr>
              		<td>
              			<input type="radio" id="normalCar1" name="carModel" value="Lexus ES250 Ultimate"/>
              			<label for="normalCar1">Lexus ES250 Ultimate</label>
              		</td>
              		<td>
              			<input type="radio" id="normalCar2" name="carModel" value="Tesla Model S 85"/>
              			<label for="normalCar2">Tesla Model S 85</label>
              		</td>
              	</tr>
              </table>
							<br>
		            	<div class="form-group">
		            		<label>Type the car plate number</label>
		            		<input type="text" class="form-control" name="carPlateNum"/>
		            	</div>
		            	<div class="form-group">
		            		<label>Import your profile picture</label>
										<input type="file" name="profileImg"/>
		            	</div>
			            <div class="form-group">
			                <input type="submit" name="submit_N" class="btn btn-primary" value="Submit">
			                <input type="submit" name="reset" class="btn btn-default" value="Reset">
			            </div>
			        </form>
					</div>
				</div>
		    </div>
		    <div class="card">
		    	<div class="card-header">
		        	<a class="collapsed card-link" data-toggle="collapse" href="#collapseLarge">
			    		Large(6-7 seats)
			    	</a>
		    	</div>
		    	<div id="collapseLarge" class="collapse" data-parent="#carClass">
		    		<div class="card-body">
    			    	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			    			<table>
		                    	<tr>
		                    		<td>
		                    			<label for="largeCar1">
		                    				<img src="photo/Honda CR-V Turbo.jpg" width="320" height="180"/>
		                    			</label>
		                    		</td>
		                    		<td>
		                    			<label for="largeCar2">
		                    				<img src="photo/Toyota Noah.png" width="320" height="180"/>
		                    			</label>
		                    		</td>
		                    	</tr>
		                    	<tr>
		                    		<td>
		                    			<input type="radio" id="largeCar1" name="carModel" value="Honda CR-V Turbo"/>
		                    			<label for="largeCar1">Honda CR-V Turbo</label>
		                    		</td>
		                    		<td>
		                    			<input type="radio" id="largeCar2" name="carModel" value="Toyota Noah"/>
		                    			<label for="largeCar2">Toyota Noah</label>
		                    		</td>
		                    	</tr>
		                    </table>
							<br>
			            	<div class="form-group">
			            		<label>Type the car plate number</label>
			            		<input type="text" class="form-control" name="carPlateNum"/>
			            	</div>
			            	<div class="form-group">
			            		<label>Import your profile picture</label>
			            		<input type="file" calss="form-control" name="profileImg"/>
			            	</div>
				            <div class="form-group">
				                <input type="submit" name="submit_L" class="btn btn-primary" value="Submit">
				                <input type="submit" name="reset" class="btn btn-default" value="Reset">
				            </div>
				        </form>
		        	</div>
		      	</div>
		    </div>
		 </div>
    </div>

	<div class="modal fade" id="success_message">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Register Successful</h4>
				</div>
				<div class="modal-body">
					Click OK to return Home page...
				</div>
				<div class="modal-footer">
					<button onclick="location.href='home.php';" class="btn btn-primary" data-dismiss="modal" >OK</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="fail_message">
		<div class="modal-dialog">
			<div class="modal-content">
	    		<div class="modal-header">
	    			<h4 class="modal-title">Register Failed</h4>
	    		</div>
			    <div class="modal-body">
					Click OK to return Home page...
				</div>
			    <div class="modal-footer">
					<button onclick="location.href='home.php';" class="btn btn-primary" data-dismiss="modal" >OK</button>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$(document).ready( function() {

		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#profileImg").change(function(){
			alert(this);
		    readURL(this);
		}); 	
	});	

</script>
</body>
</html>


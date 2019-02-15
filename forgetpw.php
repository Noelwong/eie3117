<?php

require_once "config.php";

$username = $email = $verify_email = $new_pw = "";
$username_err = $email_err = "";

$new_pw = rand(999,999999);
//echo $new_pw;
if($_SERVER["REQUEST_METHOD"] == "POST"){
	//Check if username is empty
	if(empty(trim($_POST["username"]))){
		$username_err = "Please enter username.";
	} else{
		$username = trim($_POST["username"]);
	}

	//Check if email is empty
	if(empty(trim($_POST["email"]))){
		$email_err = "Please enter your email.";
	} else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
		echo "Your email address is not valid!";
	} else{
		$email = trim($_POST["email"]);
	}

	//Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, email FROM users WHERE username = :username";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);
            setcookie("c_username", $param_username, time()+3600);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $verify_email = $row["email"];
                        if($email==$verify_email){

							$verification_code = md5($email);
							$ResetPWLink = "http://localhost/eie3117/forgetpw1.php?code=" . $verification_code;
	 
			                $htmlStr = "";
			                $htmlStr .= "Hi " . $username . "\r\n\n";

			                $htmlStr .= "Here is a new password for you." . $new_pw . "\r\nPlease login and reset/change it immediately!";
			                setcookie("c_new_pw", $new_pw, time()+3600);
							$to = $email;
							$subject = "Request for reset password!";
							$header = "From: eie3117group7b@gmail.com" . "\r\n" . "CC: somebodyelse@example.com";

							mail($to, $subject, $htmlStr, $header);
                        	header("location: forgetpw1.php");
                            
                        } else{
                            // Display an error message if password is not valid
                            $email_err = "The email is not match with the account.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);

        }

        // Close statement
        unset($stmt);
    }
    unset($pdo);
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
        <h2>Forget Password Form</h2>
        <p>Please fill this form to have a new password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
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

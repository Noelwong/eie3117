<?php
require_once "config.php";

$new_pw = "";
$new_pw = $_COOKIE["c_new_pw"];
$username = $_COOKIE["c_username"];

//$sql = "SELECT email, verified FROM users ";
$sql = "UPDATE users SET password = :password WHERE username = :username";
if($stmt = $pdo->prepare($sql)){
    $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
    $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

    //Set parameters
    $param_username = $username;
    $param_password = password_hash($new_pw, PASSWORD_DEFAULT);
    if($stmt->execute()){
        echo "A new password has been sent to your email. Please check your email";
    } else{
        echo "This is a problem. We cannot reset your password.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forget password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 400px; padding: 20px; }
    </style>
</head>
<body>
    <body>
    <div class="wrapper">
        <p>Please check your email</p>
        <p>An email has been sent to your email address.</p>
        <p> Please follow the instruction to reset your password.</p>
        <p><a href="login.php">Back to the Login page</a>.</p>
        </form>
    </div>
</body>
</body>
</html>

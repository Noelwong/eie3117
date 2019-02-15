<?php
require_once "config.php";

// check first if record exists
$sql = "SELECT id FROM users WHERE verification_code = ? and verified = '0'";
$stmt = $pdo->prepare( $sql );
$stmt->bindParam(1, $_GET['code']);
$stmt->execute();
$num = $stmt->rowCount();
 
if($num>0){
 
    // update the 'verified' field, from 0 to 1 (unverified to verified)
    $sql = "UPDATE users
                set verified = '1'
                where verification_code = :verification_code";
 
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':verification_code', $_GET['code']);
 
    if($stmt->execute()){
        // tell the user
        echo "<div>Your email is valid, thanks!. You may now login.</div>";
    }else{
        echo "<div>Unable to update verification code.</div>";
        //print_r($stmt->errorInfo());
    }
 
}else{
    // tell the user he should not be in this page
    echo "<div>We can't find your verification code.</div>";
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

</body>
</html>

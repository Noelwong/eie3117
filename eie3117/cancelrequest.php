<?php
require_once "config.php";


$sql = "DELETE FROM passenger WHERE........."					//database setting


$htmlStr = "";
$htmlStr .= "Hi " . $username . "\r\n\n";

$htmlStr .= "Please click the link below to activate your account. \r\n\n";

$to = $email;
$subject = "Email Verification!!!!";
$header = "From: eie3117group7b@gmail.com" . "\r\n" . "CC: somebodyelse@example.com";

mail($to, $subject, $htmlStr, $header);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cancel Request</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Cancel Request</h2>
        <p>Request is canceled. An email has been sent to the passenger/driver for notification!</p>
    </div>
</body>
</html>

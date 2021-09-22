<?php
session_start();
include_once "config.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$subject = "Blink Chat - Verification Code for Password Reset";
$headers = "From: support@blinkchat.com";

if(!empty($email)){
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
    if(mysqli_num_rows($sql) > 0){
        date_default_timezone_set("Asia/Calcutta");
        $time = date("r");
        $authcode = rand(99999, 999999);
        $sql2 = mysqli_query($conn, "INSERT INTO resetpass (email, name, time, authcode) VALUES ('{$email}', '{$name}', '{$time}', {$authcode})");
        if($sql2){
            echo 'Success! Code sent to your email address';
            $message = 'You requested for password verification code at: ' .$time. '\r\n \r\nThe 6-digit verification code is: ' .$authcode. 
                        '\r\n \r\nGo to https://saranshgupta.000webhostapp.com/reset.php to set your new password';
            mail($email, $subject, $message, $headers);
            }
    }
    else{
        echo 'No account registered with this email';
    }
}
else{
    echo 'required fields';
}
?>
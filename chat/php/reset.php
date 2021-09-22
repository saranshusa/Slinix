<?php
session_start();
include_once "config.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$code = mysqli_real_escape_string($conn, $_POST['code']);
$password = mysqli_real_escape_string($conn, $_POST['password']);


if(!empty($email) && !empty($code) && !empty($password)){
    $sql = mysqli_query($conn, "SELECT * FROM resetpass WHERE email = '{$email}' AND authcode = {$code}");
    if(mysqli_num_rows($sql) > 0){
        $sql2 = mysqli_query($conn, "UPDATE users SET password = {$password} WHERE email = '{$email}'");
        $sql3 = mysqli_query($conn, "DELETE FROM resetpass WHERE email = '{$email}'");
        if($sql2){
            echo 'Success! Password updated';
            }
    }
    else{
        echo 'Invalid code or email address!';
    }
}
else{
    echo 'required fields';
}
?>
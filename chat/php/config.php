<?php
$conn = mysqli_connect('freedb.tech', 'freedbtech_blinkchat', 'blinkchat', 'freedbtech_blinkchat');
if(!$conn){
    echo 'Connected' . mysqli_connect_error();
}
?>
<?php
session_start();
include_once "config.php";
$name = mysqli_real_escape_string($conn, $_POST['full-name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if(!empty($name) && !empty($email) && !empty($password)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){
            echo "$email - This email already exists!";
        }
        else{
            if(isset($_FILES['profile-image'])){
                $img_name = $_FILES['profile-image']['name'];
                $tmp_name = $_FILES['profile-image']['tmp_name'];

                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);

                $extensions = ['png', 'jpeg', 'jpg'];
                if(in_array($img_ext, $extensions) === true){
                    $time = time();
                    $new_img_name = $time.$img_name;
                    if(move_uploaded_file($tmp_name, "profilepic/".$new_img_name)){
                        $status = "Active now";
                        $random_id = rand(time(), 10000000);

                        $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, name, email, password, profilepic, status) 
                        VALUES ({$random_id}, '{$name}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");

                        if($sql2){
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                            if(mysqli_num_rows($sql3) > 0){
                                $row = mysqli_fetch_assoc($sql3);
                                $_SESSION['unique_id'] = $row['unique_id'];
                                echo "success";
                            }
                        }
                        else{
                            echo "Something went wrong!";
                        }
                    }
                }
                else{
                    echo "Only jpeg, jpg, png file types supported!";
                }
            }
            else{
                echo 'Please select an Image file!';
            }
        }
    }
    else{
        echo "$email - This is not a valid email!";
    }
}
else{
    echo "All input fields are required!";
}
?>
<?php
session_start();
if(isset($_SESSION['unique_id'])){
  header('location: users.php');
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/bootstrap/css/bootstrap.min.css"
    />
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/css-hamburgers/hamburgers.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/select2/select2.min.css"
    />
    <script src="js/removeBanner.js"></script>
    <link rel="stylesheet" type="text/css" href="css/util.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <title>Blink Chat - Login</title>
  </head>

  <body>
    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100 form-login">
          <div class="login100-pic js-tilt" data-tilt>
            <img src="images/img-01.png" alt="IMG" />
          </div>

          <form class="login100-form validate-form">
            <span class="login100-form-title">Generate Reset Code</span>
            <div class="error-txt"></div>
            <div class="code-sent">
            <div
              class="wrap-input100 validate-input"
              data-validate="Valid email is required: ex@abc.xyz"
            >
              <input
                class="input100"
                type="text"
                name="email"
                placeholder="Registerd Email"
              />
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
              </span>
            </div>

            <div
              class="wrap-input100"
              >
              <input
                class="input100"
                type="text"
                name="name"
                placeholder="Full Name"
              />
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-user" aria-hidden="true"></i>
              </span>
            </div>

            

            <div class="container-login100-form-btn submits">
              <button class="login100-form-btn">Send Code</button>
            </div>

            <div class="text-center p-t-12">
              <span class="txt1"> Back to </span>
              <a class="txt2" href="index.php">Login </a>
            </div>
            </div>

            <div class="text-center p-t-136">
              <a class="txt2" href="reset.php">
                Code received ? Reset Password now
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="js/resetcode.js"></script>
   
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script>
      $(".js-tilt").tilt({
        scale: 1.1,
      });
    </script>
  </body>
</html>

<?php
session_start();
include_once "php/config.php";
if(!isset($_SESSION['unique_id'])){
  header('location: index.php');
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
    <title>Blink Chat</title>
  </head>

  <body>
    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100">
          <section class="users">
            <header>
              <div class="content">
              <?php
              $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
            ?>
                <img src="php/profilepic/<?php echo $row['profilepic']; ?>" alt="">
                <div class="details">
                  <span><?php echo $row['name'] ?></span>
                  <p><?php echo $row['status']; ?></p>
                </div>
              </div>
              <a href="php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="logout">Logout</a>
            </header>
            <div class="search">
              <span class="text">Select an user to start chat</span>
              <input class='search-field' type="text" placeholder="Enter name to search..." />
              <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
              
            </div>
          </section>
        </div>
      </div>
    </div>

    <script src="js/users.js"></script>
    
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script>
      $(".js-tilt").tilt({
        scale: 1.1,
      });
    </script>
  </body>
</html>

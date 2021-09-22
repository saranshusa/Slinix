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
    <link rel="stylesheet" href="style.css" />
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
    <link rel="stylesheet" type="text/css" href="css/util.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <?php
    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
    $row = mysqli_fetch_assoc($sql);
    ?>
    <script src="js/removeBanner.js"></script>
    <title>Chat with <?php echo $row['name']; ?></title>
  </head>

  <body>
    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100 wrap-chat">
          <section class="chat-area users">
            <header class="nav-bar">
            <?php
            $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
            else{
              header('location: users.php');
            }
            ?>
              <div class="content">
                <a href="users.php" class="back-icon"
                  ><i class="fas fa-arrow-left"></i
                ></a>
                <img src="php/profilepic/<?php echo $row['profilepic']; ?>" alt="" />
                <div class="details">
                  <span><?php echo $row['name'] ?></span>
                  <p><?php echo $row['status']; ?></p>
                </div>
              </div>
            </header>
            <div class="chat-box">
            
            </div>
            <form action="#" class='typing-area' autocomplete='off'>
            <input type="text" name='outgoing_id' value="<?php echo $_SESSION['unique_id']; ?>" hidden>
            <input type="text" name='incoming_id' value="<?php echo $user_id; ?>" hidden>
              <input
                type="text"
                class='input-field'
                name='message'
                placeholder="Type a message here..."
              />
              <button><i class="fab fa-telegram-plane"></i></button>
            </form>
          </section>
        </div>
      </div>
    </div>

    <script src="js/chat.js"></script>
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script>
      $(".js-tilt").tilt({
        scale: 1.1,
      });
    </script>
  </body>
</html>

<!-- -------X---------------X---------Admin---------X--------------X------------ -->


<!-- -------------------------------Admin----------------------------------- -->
<?php
require "./particial/_dbconnect.php";
$login = false;
$Error = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM `registration` WHERE `Email`='$username' OR `phone_no` = '$username'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row['Password'])) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['profession'] = $row['profession'];
        header("location:welcome.php");
      } else {
        $Error = true;
      }
    }
  } else {
    $Error = true;
  }
}

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <link rel="icon" href="./image/icon.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="./css/login.css">
  <link rel="stylesheet" href="./css/_scroll.css">
  <title>login</title>
</head>

<body>
  <?php
  require "./particial/_navbar.php";
  ?>
  <?php
  if ($login) {
    echo '<div class="alert alert-true alert-dismissible fade show" role="alert">
    <strong style="font-size:25px">Success!</strong>
    <span style="font-size:20px;">Your are now logged in.</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
  if ($Error) {
    echo '<div class="alert alert-error alert-dismissible fade show" role="alert">
    <strong style="font-size:25px">Error!</strong>
    <span style="font-size:20px;">your username and password is invalid!</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
  ?>


  <!-- ------------------------------------------------------------path for scrollbar----------------------------------------------------- -->
  <?php
  include "html/scrollbar.html";
  ?>
  <!-- ------------------------------------------------------------path for scrollbar----------------------------------------------------- -->

  <h1>Login</h1>

  <div class="container my-4">
    <form action="" method="POST">
      <div class="form-group">
        <label for="username"><i class="fa fa-envelope" aria-hidden="true"></i> Email OR <i class="fa fa-phone" aria-hidden="true"></i> Phone_no <span style="color:red">
            *</span></label>
        <input type="text" class="form-control bg-nue" id="username" name="username" placeholder="example@gmail.com OR 999889899" required aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted"><span style="color:green;font-size:15px;font-family:Arial, Helvetica, sans-serif">We'll never share your email
            with anyone else.</span></small>
      </div>
      <div class="form-group">
        <label for="password"><i class="fa fa-lock" aria-hidden="true"></i> Password<span style="color:red">
            *</span></label>
        <input type="password" class="form-control bg-nue" id="password" maxlength="15" minlength="8" name="password" placeholder="password">
        <a href="forgot_password.php" class="link my-2">Forgot Password ?</a>
      </div>
      <button type="submit" class="btn-login btn-block my-4">Login</button>
    </form>
  </div>

  <br><br>
  <?php
  include "./particial/_footer.html";
  ?>



  <!-- -----------------------------------------------------script for scrollbar------------------------------------------- -->
  <script type="text/javascript">
    let progress = document.getElementById('progressbar');
    let totalHeight = document.body.scrollHeight - window.innerHeight;
    window.onscroll = function() {
      let progressHeight = (window.pageYOffset / totalHeight) * 100;
      progress.style.height = progressHeight + "%";
    }
  </script>

</body>

</html>
<?php
require "./particial/_dbconnect.php";
$login = false;
$Error = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM `farco_admin` WHERE `email`='$username' OR `phone_no` = '$username'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($password, $row['password'])) {
        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location:index.php");
      } else {
        $Error = true;
      }
    }
  } else {
    $Error = true;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="../image/icon.png" type="image/x-icon">

  <title>FARCO Admin - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <style>
    .bg-login-image {
      background: url('img/farmer.jpeg');
      background-position: center;
      background-size: cover;
    }

    body {
      background: url('img/20.jpg'), no-repeat;
      background-position: center, center;
      background-size: cover;
      backdrop-filter: blur(7.0px) brightness(100%) saturate(150%);
      -moz-backdrop-filter: blur(7.0px);
      height: 100vh;
      width: 100vw;
    }

    .form-control,
    input[type="text"],
    input[type="password"],
    input[type="text"]:focus,
    input[type="password"]:focus,
    input:-internal-autofill-selected {
      background: rgba(204, 204, 204, 0.45);
      caret-color: #63ff23;
      backdrop-filter: blur(5.5px) brightness(100%) saturate(200%);
      -webkit-backdrop-filter: blur(5.5px) brightness(100%) saturate(200%);
      outline: none;
      border: none;
      color: white;
    }

    .form-control::placeholder {
      color: white;
    }
  </style>
</head>

<body>
  <?php
  if ($login) {
    echo '<div class="alert alert-true alert-dismissible fade show" role="alert" style="background:#66ff33;>
    <strong style="font-size:25px">Success!</strong>
    <span style="font-size:20px;">Your are now logged in.</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
  if ($Error) {
    echo '<div class="alert alert-error alert-dismissible fade show" role="alert" style="background:rgba(255,255,255,.35);backdrop-filter:blur(15px);color:white;">
    <strong style="font-size:25px">Error!</strong>
    <span style="font-size:20px;">your username and password is invalid!</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
  ?>
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5" style="background:transparent;">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-100 mb-4">Welcome Back!</h1>
                  </div>
                  <form method="post">
                    <div class="form-group">
                      <input type="text" name="username" required placeholder="Enter Email Address OR Password" class="form-control form-control-user" id="exampleInputPassword">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" maxlength="15" minlength="8" required class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck" required>
                        <label class="custom-control-label" for="customCheck" style="color:aliceblue;">Remember Me</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-user" style="background:crimson;color:white;">Login</button>
                    <hr>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="medium" href="forgot-password.php" style="color: #63ff23;font-weight:600;">Forgot Password?</a>
                  </div>
                  <div class=" text-center">
                    <a class="medium" href="register.php" style="color: coral;font-weight:600;">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
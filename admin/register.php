<?php
require "./particial/_dbconnect.php";
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fname = $_REQUEST['fname'];
  $lname = $_REQUEST['lname'];
  $email = $_REQUEST['email'];
  $phone_no = $_REQUEST['phone_no'];
  $password = $_REQUEST['password'];
  $cpassword = $_REQUEST['cpassword'];

  $imagename = $_FILES['img1']['name'];
  $tempimgname = $_FILES['img1']['tmp_name'];

  move_uploaded_file($tempimgname, "./admin_img/$imagename");

  // $exists = false;
  // check wheather this user Exists
  $existsql = "SELECT * FROM `farco_admin` WHERE  `email`='$email' OR `phone_no`='$phone_no'";
  $result = mysqli_query($conn, $existsql);
  $numExitstRows = mysqli_num_rows($result);
  if ($numExitstRows > 0) {
    $showError = "Username Already Exists";
  } else {
    $exists = false;
    if (($password == $cpassword)) {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $sqlp = "INSERT INTO `farco_admin` (`fname`, `lname`, `email`, `phone_no`, `password`, `admin_img`) VALUES ('$fname', '$lname', '$email', '$phone_no', '$hash', '$imagename');";
      $result = mysqli_query($conn, $sqlp);
      if ($result) {
        $showAlert = true;
      }
    } else {
      $showError = "password doen not match Sorry";
    }
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

  <title>FARCO Admin - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <style>
    .bg-login-image {
      background: url(./img/farmer.jpeg);
      background-position: center;
      background-size: cover;
    }

    body {
      background: url('img/20.jpg'), no-repeat;
      background-position: center, center;
      background-size: cover;
      backdrop-filter: blur(7.0px);
      height: 100vh;
      width: 100vw;
      margin: 0%;
      padding: 0%;
    }

    .form-control,
    input[type="text"],
    input[type="password"],
    input [type="email"],
    input[type="file"],
    input[type="text"]:focus,
    input[type="password"]:focus,
    input [type="email"]:focus,
    input[type="file"]:focus,
    input:-internal-autofill-selected {
      background: rgba(204, 204, 204, 0.45);
      caret-color: #63ff23;
      backdrop-filter: blur(5.5px);
      -webkit-backdrop-filter: blur(5.5px);
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
  if ($showAlert) {
    echo '
    <div class="alert  alert-dismissible fade show" role="alert" style="background:#66ff33;">
    <strong style="font-size:25px;color:white;">Success!</strong>
    <span style="font-size:20px;color:white;">Your account has been successfully created and <a href="login.php">you can login here.</a></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
  if ($showError) {
    echo '<div class="alert alert-dismissible fade show" role="alert" style="background:yellow;">
    <strong style="font-size:25px;color:black;">Error!</strong>
    <span style="font-size:20px; color:black;">' . $showError . '</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
  ?>
  <div class="container">

    <div class="card o-hidden border-0 shadow-lg" style="background-color: transparent;">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-100 mb-4">Create an Account!</h1>
              </div>
              <form action="" method="post" class="user" enctype="multipart/form-data">
                <div class=" form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" required class="form-control form-control-user" name="fname" placeholder="First Name">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" required class="form-control form-control-user" name="lname" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" required class="form-control form-control-user" name="email" placeholder="Email Address">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" maxlength="10" minlength="10" name="phone_no" placeholder="Phone No." required>
                </div>
                <div class="form-group my-3" style="padding: 0;margin:0;">
                  <input type="file" name="img1" id="" required class="form-control" style="padding: 3px;margin:0;">
                  <!-- <label class=" input-group-text" for="inputGroupFile02">Upload</label> -->
                  <span style="color:#2feb00;">*please only upload images</span>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" required maxlength="15" minlength="8" class="form-control form-control-user" name="password" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" required maxlength="15" minlength="8" class="form-control form-control-user" name="cpassword" placeholder="Repeat Password">
                  </div>
                </div>
                <!-- <input type="submit" name="submit" value="submit" class="btn btn-primary btn-user btn-block"> -->
                <button type="submit" class="btn btn-block btn-user" style="color:white;background:crimson;">Sign up</button>
                <hr>
                <a href="login.php" style="color: coral;font-weight:600;">Have an account? log in</a></button>

              </form>
              <hr>
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
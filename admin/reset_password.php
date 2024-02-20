<?php
$error = false;
$success = false;
require "../particial/_dbconnect.php";
$link = $_GET['token'];
// echo $link;
$result = mysqli_query($conn, "SELECT *FROM farco_admin WHERE password = '$link'");
$num = mysqli_num_rows($result);
// echo $num;
while ($rows = mysqli_fetch_assoc($result)) {
    $gmail = $rows['email'];
    echo $gmail;
    if (isset($_POST['submit'])) {
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        if ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $result1 = mysqli_query($conn, "UPDATE farco_admin SET password='$hash' WHERE email='$gmail'");
            if ($result1) {
                $success = true;
            }
        } else {
            $error = "new password and confirm password is does not match";
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

    <title>Farco Admin - Reset Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<style>
    .bg-password-image {
        background: url(img/farmer.jpeg);
        background-size: cover;
        background-position: center, center;
    }

    body {
        background: url('img/20.jpg'), no-repeat;
        background-position: center, center;
        background-size: cover;
        backdrop-filter: blur(7.0px);
        height: 100vh;
        width: 100vw;
    }

    .form-control,
    input[type="password"],
    input[type="password"]:focus,
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

<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5" style="background:transparent;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-100 mb-2">Change Password</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <?php
                                            if ($error) {
                                                echo '<h6 style="background:rgba(250,0,0,.5);color:white;padding:15px;">
                                                            Sorry! New Password and Confirm Password is does not match.
                                                         </h6>';
                                            }
                                            if ($success) {
                                                echo '<h6 style="background:rgba(0,250,0,.5);color:white;padding:15px;">
                                                            Success! Your Password has been reseted successfully.
                                                            </h6>';
                                            }
                                            ?>
                                            <label for="password" class="form-label h6 ml-3">New Password</label>
                                            <input type="password" class="form-control form-control-user" name="password" minlength="8" maxlength="16" id="password" aria-describedby="emailHelp" placeholder="Enter New Password" required>
                                            <label for="cpassword" class="form-label ml-3 my-2">Confirm New Password</label>
                                            <input type="password" class="form-control form-control-user" name="cpassword" minlength="8" maxlength="16" id="cpassword" aria-describedby="emailHelp" placeholder="Confirm New Password" required>
                                            <button type="submit" name="submit" class="btn btn-success btn-block my-3" style="background: crimson;border:none;">Set password</button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="medium" href="login.php" style="color: coral;font-weight:600;">Login Here</a>
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
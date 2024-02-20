<?php
$error = false;
$success = false;
require "./particial/_dbconnect.php";
$link = $_GET['token'];
// echo $link;
$result = mysqli_query($conn, "SELECT *FROM registration WHERE Password = '$link'");
$num = mysqli_num_rows($result);
// echo $num;
while ($rows = mysqli_fetch_assoc($result)) {
    $gmail = $rows['Email'];
    echo $gmail;
    if (isset($_POST['submit'])) {
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        if ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $result1 = mysqli_query($conn, "UPDATE registration SET Password='$hash' WHERE Email='$gmail'");
            if ($result1) {
                $success = true;
            } else {
                $error = "your username and password is invalid!";
            }
        } else {
            $error = "new password and confirm password is does not match";
        }
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
    <title>Reset Password</title>
</head>

<body>
    <?php
    require "./particial/_navbar.php";
    ?>
    <?php
    if ($success) {
        echo '<div class="alert alert-true alert-dismissible fade show" role="alert">
    <strong style="font-size:25px">Success!</strong>
    <span style="font-size:20px;">password reseted successfully</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
    }
    if ($error) {
        echo '<div class="alert alert-error alert-dismissible fade show" role="alert">
    <strong style="font-size:25px">Error!</strong>
    <span style="font-size:20px;">' . $error . '</span>
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

    <h1>Forgot Password</h1>

    <div class="container my-4">
        <form action="" method="POST">
            <div class="form-group">
                <label for="password"><i class="fa fa-lock" aria-hidden="true"></i> Password<span style="color:red">
                        *</span></label>
                <input type="password" class="form-control bg-nue" id="password" name="password" placeholder="Enter New password" required aria-describedby="emailHelp">
            </div>
            <div class="form-group"><br>
                <label for="cpassword"><i class="fa fa-lock" aria-hidden="true"></i> Confirm Password <span style="color:red">
                        *</span></label>
                <input type="password" class="form-control bg-nue" id="cpassword" name="cpassword" placeholder="Re-Enter Password" required aria-describedby="emailHelp">
            </div><br>
            <button type="submit" name="submit" class="btn-login btn-block my-4" style="background:yellow;color:black;box-shadow:none;font-weight:500;">Submit</button>
            <center><a href="login.php" style="color:coral">Have an account? log in</a></center>
        </form>
    </div>

    <br><br>




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
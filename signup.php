<?php
require "./particial/_dbconnect.php";
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['username'];
  $phone_no = $_POST['phone_no'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zipcode = $_POST['zipcode'];
  $profession = $_POST['profession'];
  // $exists = false;
  // check wheather this user Exists
  $existsql = "SELECT * FROM `registration` WHERE `Email`='$email' OR `phone_no`='$phone_no'";
  $result = mysqli_query($conn, $existsql);
  $numExitstRows = mysqli_num_rows($result);
  if ($numExitstRows > 0) {
    $showError = "Username Already Exists";
  } else {
    $exists = false;
    if (($password == $cpassword)) {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO `registration`(`Name`, `Email`, `phone_no`, `Address`, `City`, `State`, `Password`, `Pin code`, `profession`, `date`) VALUES ('$name', '$email','$phone_no', '$address', '$city','$state','$hash','$zipcode','$profession',current_timestamp())";
      // $sql = "INSERT INTO `registration` (`Name`, `Email`, `phone_no`, `Address`, `City`, `State`, `Password`, `Pin code`, `profession`, `date`) VALUES ( '$name', '$email', '$phone_no', '$address', '$city', '$state', '$hash', '$zipcode', '$profession', current_timestamp());";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $showAlert = true;
      } else {
        $showError = "error : " . mysqli_error($conn);
      }
    } else {
      $showError = "password doen not match Sorry";
    }
  }
}

?>
<?php
require "./particial/_navbar.php";
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <link rel="stylesheet" href="_root.css"> -->
  <link rel="stylesheet" href="./css/_signup.css">
  <link rel="stylesheet" href="./css/_scroll.css">
  <title>Farco~Sign Up</title>
</head>
<style>

</style>

<body style="cursor: url('./image/cursor1.png'),auto;">
  <?php
  if ($showAlert) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong style="font-size:25px">Success!</strong>
    <span style="font-size:20px;">Your account has been successfully created and you can login.</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  }
  if ($showError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong style="font-size:25px">Error!</strong>
    <span style="font-size:20px;">' . $showError . '</span>
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

  <h1><span class="htext">Sign Up to our website</span></h1>
  <div class="container my-4">
    <!-- =======================form=============================== -->

    <form action="" method="post">
      <div class="form-group">
        <label for="name"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-people-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
          </svg> Name</label>
        <input type="text" class="form-control bg-nue" id="name" placeholder="Tala Shyam " name="name" required>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="username"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z" />
            </svg> Email</label>
          <input type="email" class="form-control bg-nue" id="username" name="username" placeholder="example@gmail.com">
          <small id="emailHelp" class="form-text text-muted">If you do not have an email. you can enter a phone
            number.</small>
        </div>
        <div class="form-group col-md-6">
          <label for="phone_no"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.47 17.47 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969z" />
            </svg> Phone_no<span style="color:red"> *</span></label>
          <input type="text" class="form-control bg-nue" id="phone_no" maxlength="10" minlength="10" name="phone_no" placeholder="9988776666" required>
        </div>
        <div class="form-group col-md-6">
          <label for="password"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z" />
              <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z" />
            </svg> Password<span style="color:red"> *</span></label>
          <input type="password" class="form-control bg-nue" id="password" maxlength="15" minlength="8" name="password" placeholder="!example#@#121!" required>
        </div>
        <div class="form-group col-md-6">
          <label for="cpassword"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z" />
              <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z" />
            </svg> Confirm Password<span style="color:red"> *</span></label>
          <input type="password" class="form-control bg-nue" id="cpassword" maxlength="15" minlength="8" name="cpassword" placeholder="!example#@#121!" required>
        </div>
      </div>
      <div class="form-group">
        <label for="address1"><i class="fa fa-map-marker" aria-hidden="true"></i> Address<span style="color:red">
            *</span></label>
        <input type="text" class="form-control bg-nue" id="address1" placeholder="Navagam, Kalavad" name="address" required>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="city"><i class="fa fa-map-marker" aria-hidden="true"></i> Dist<span style="color:red">
              *</span></label>
          <input type="text" class="form-control bg-nue" id="city" name="city" placeholder="Jamnagar" required>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="state">State</label>
            <input type="text" class="form-control bg-nue" id="state" name="state" default="gujarat" placeholder="Gujarat" required>
          </div>
          <div class="form-group col-md-3">
            <label for="zip">Zip-Code<span style="color:red"> *</span></label>
            <input type="text" class="form-control bg-nue" id="zip" name="zipcode" maxlength="6" minlength="6" placeholder="123233" inputmode="numeric" pattern="^(?(^00000(|-0000))|(\d{5}(|-\d{4})))$" required>
          </div>
        </div>

        <fieldset class="text-center text-capitalize">
          <legend style="font-size:20px;">Choose your Profession</legend>
          <div class="form-check form-check-inline">
            <label class="form-check-label" for="inlineRadio1">
              <input class="form-check-input" type="radio" name="profession" id="inlineRadio1" value="farmer" required>
              Farmer<img src="./image/icon3.png" width="70" height="70"></label>
          </div>
          <div class="form-check form-check-inline">
            <label class="form-check-label" for="inlineRadio2">
              <input class="form-check-input" type="radio" name="profession" id="inlineRadio2" value="vendor" required>
              Vendor<img src="./image/icon4.png" width="70" height="70"></label>
          </div>
      </div>

      </fieldset>


      <br><br>
      <button type="submit" class="btn btn-sign btn-block my-3">Sign up</button>
      <button type="reset" class="btn btn-warn btn-block my-3"><a href="login.php">Have an account? log in</a></button>
    </form>

    <!-- =====X=========X=========form=========X========X============== -->

  </div>
  <!-- ------------------------------------------------footer-------------------------------------------------- -->
  <?php
  include "./particial/_footer.html";
  ?>
  <!-- ------------------X-------------------X-----------footer--------------------X---------------------X--------- -->

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
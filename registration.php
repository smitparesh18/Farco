<?php
require "./particial/_dbconnect.php";
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:login.php");
    exit;
} else {
    $loggedin = true;
    $showAlert = false;
    $showError = false;
}
if ($_SESSION['profession'] == "vendor") {
    header("location:vendor_registration.php");
}
require "./particial/_navbar.php";
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $phone_no = $_POST["phone_no"];
    $farm_location = $_POST['address'];
    $dist = $_POST['dist'];
    $vegetable = $_POST['vegetable'];
    $quantity = $_POST['quantity'];

    $imagename = $_FILES['img1']['name'];
    $tempimgname = $_FILES['img1']['tmp_name'];

    $imagename_2 = $_FILES['img2']['name'];
    $tempimgname_2 = $_FILES['img2']['tmp_name'];

    move_uploaded_file($tempimgname, "Farmer_product_img/$imagename");
    move_uploaded_file($tempimgname_2, "Farmer_product_img/$imagename_2");
    if (isset($vegetable)) {
        $usql = "SELECT `product_price` FROM `product` WHERE `product_name`='$vegetable';";
        $uresult = mysqli_query($conn, $usql);
        if ($uresult) {
            while ($urow = mysqli_fetch_assoc($uresult)) {
                $pprice = $urow['product_price'];
                $estimated_price = $quantity * $pprice;
            }
        }
    }
    $sql = "INSERT INTO `farmer_product_registration`(`user_id`, `phone_no`, `farm_location`, `dist`, `f_product`, `quantity`, `estimated_price`, `image_1`, `image_2`, `r_date`) VALUES ('$user_id','$phone_no','$farm_location','$dist','$vegetable','$quantity','$estimated_price','$imagename','$imagename_2',current_timestamp())";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $showAlert = true;
    } else {
        $showError = "error : " . mysqli_error($conn);
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="_root.css"> -->
    <link rel="stylesheet" href="./css/_registration.css">
    <link rel="stylesheet" href="./css/_scroll.css">
    <link rel="stylesheet" href="./css/farmer.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <!-- Google Fonts Link -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;700;800&display=swap" rel="stylesheet" />
    <!-- Line Awesome CDN Link -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Farco-Registration</title>
</head>
<style>
    .radio-btn>i {
        color: #ffffff;
        background-color: #8373e6;
        font-size: 20px;
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%) scale(4);
        border-radius: 50px;
        padding: 3px;
        transition: 0.2s;
        pointer-events: none;
        opacity: 0;
    }
</style>

<!-- ------------------------------------------------------------path for scrollbar----------------------------------------------------- -->
<?php
include "html/scrollbar.html";
?>
<!-- ------------------------------------------------------------path for scrollbar----------------------------------------------------- -->
<?php
if ($showAlert) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong style="font-size:25px">Success!</strong>
    <span style="font-size:20px;">Your registration has been successfull complated. <br> click here to check your request status <i class="fa fa-hand-o-right" aria-hidden="true"></i> <a style="color:blue;text-decoration:underline;" href="order_details.php">order_details</a></span>
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
<h1><span class="htext">Register Your Product Here</span></h1>
<div class="container my-4">
    <!-- =======================form=============================== -->

    <form action="" method="post" name="FormName" id="myform" enctype="multipart/form-data">
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
        </div>
        <div class="form-group">
            <label for="address1"><i class="fa fa-map-marker" aria-hidden="true"></i> Farm Location<span style="color:red">
                    *</span></label>
            <input type="text" class="form-control bg-nue" id="address1" placeholder="Navagam, Kalavad" name="address" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="city"><i class="fa fa-map-marker" aria-hidden="true"></i> Dist<span style="color:red">
                        *</span></label>
                <input type="text" class="form-control bg-nue" id="city" name="dist" placeholder="Jamnagar" required>
            </div>

            <div class="form-group">
                <br>
                <fieldset class="text-center text-capitalize">
                    <legend style="font-size:25px; font-weight:bold;"><img src="./image/girl.png" alt="" width="80px" height="80px"> Choose your Crops<img src="./image/icon2.png" alt="" width="80px" height="80px"></legend>


                    <h3 class="text-center" style="color:#1ef50b; ">Choose the Vegetable you want to sell</h3>
                    <h6 class="text-center" style="color:red; ">*The price shown is for 20Kg. quantity</h6>
                    <hr style="background:#1ef50b; height:5px;" width="100%">

                    <?php

                    $sql = "SELECT * FROM `product`";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['product_type'] == "vegetable") {
                            $picture = $row['product_img'];
                            echo '
                    <label class="custom-radio">
                <input type="radio" name="vegetable" value="' . $row["product_name"] . '">
                <span class="radio-btn"><i class="las la-check" style="background-color:crimson"></i>
                    <div class="hobbies-icon">
                        <img src="fruits_and_vegetables/' . $picture . '" title="' . $row["product_desc"] . '" width="80" height="70" loading="lazy"></i>
                        <h3 style="text-align:center;display:block;">' . $row["product_name"] . '</h3>
                        <h3 style="color:green;font-weight:bold;">' . $row["product_price"] . '<i class="fa fa-inr" aria-hidden="true"></i></h3>
                        </div>
                </span>
            </label>
            ';
                        }
                    }
                    ?>

                    <br><br>
                    <h3 class="text-center" style="color:crimson;">Choose the Fruits you went to sell</h3>
                    <hr style="background:crimson; height:5px;" width="100%">

                    <?php

                    $sql = "SELECT * FROM `product`";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['product_type'] == "fruits") {
                            $picture = $row['product_img'];
                            echo '
                    <label class="custom-radio">
                <input type="radio" name="vegetable" value="' . $row["product_name"] . '">
                <span class="radio-btn"><i class="las la-check"style="background-color:crimson"></i>
                    <div class="hobbies-icon">
                        <img src="fruits_and_vegetables/' . $picture . '" title="' . $row["product_desc"] . '" width="80" height="70" loading="lazy"></i>
                        <h3 style="text-align:center;display:block;">' . $row["product_name"] . '</h3>
                        <h3 style="color:green;font-weight:bold;">' . $row["product_price"] . '<i class="fa fa-inr" aria-hidden="true"></i></h3>
                        </div>
                </span>
            </label>
            ';
                        }
                    }
                    ?>
                </fieldset>
            </div>
            <div class="form-group" style="width:100%">
                <label style="display:block;" for="quantity"><i class="fa fa-archive" aria-hidden="true"></i> Quantity(man(20kg))</label> <input type="number" class="form-control bg-nue" id="quantity" placeholder="20" maxlength="10" minlength="10" name="quantity" required style="width:80%;display:inline;"> (1man = 20kg)
            </div>
            <div class="form-group" style="width:100%">
                <label style="display:block;" for="img1"><i class="fa fa-image" aria-hidden="true"></i> upload product quality image</label> <input type="file" class="form-control bg-nue" id="img1" placeholder="upload product quality image" name="img1" required style="width:80%;display:inline;">
            </div>
            <div class="form-group" style="width:100%">
                <label style="display:block;" for="img2"><i class="fa fa-image" aria-hidden="true"></i> upload product quality image 2</label> <input type="file" class="form-control bg-nue" id="img2" placeholder="upload product quality image 2" name="img2" required style="width:80%;display:inline;">
            </div>

            <button type="Submit" class="btn btn-outline-danger btn-block my-3" style="font-weight:bold;">Register</button>
    </form>
    <!-- =====X=========X=========form=========X========X============== -->

</div>
</div>
<!-- ------------------------------------------------footer-------------------------------------------------- -->
<br><br>

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
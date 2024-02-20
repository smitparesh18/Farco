<?php
include "./particial/_dbconnect.php";

$showAlert = false;
$showError = false;
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:login.php");
    exit;
} else {
    $user_id = $_SESSION['user_id'];
    $profession = $_SESSION['profession'];
}
if ($_SESSION['profession'] == "farmer") {
    header("location:registration.php");
}
require "./particial/_navbar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Registration</title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/_scroll.css">
    <link rel="stylesheet" href="css/_product_price_list.css">
</head>

<style>
    @media(prefers-color-scheme:light) {
        .section-bg {
            padding: 60px 0;
            background: var(--light-bg-color);
            box-shadow: var(--light-shadow);
        }

        .section-title {
            margin-bottom: 25px;
            border-bottom: 10px solid crimson;
            color: crimson;
        }

        .veg {
            color: rgb(30, 223, 12);
            border-bottom: 10px solid rgb(30, 223, 12);
        }

        .section-title h2 {
            position: relative;
            font-size: 1.5rem;
            line-height: 1.4;
            font-weight: 700;
            letter-spacing: 1px;
            z-index: 1;
            text-transform: capitalize;
            display: inline-block;
            font-family: "Didact Gothic", sans-serif;
        }

        .single-product {
            box-shadow: var(--light-shadow-hover);
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 50px;
        }

        .product_image {
            box-shadow: inset 2px 2px 5px #dbdfe2, inset -3px -3px 7px #fdffff !important;
            border-radius: 50%;
            width: 100%;
            max-width: 400px;
            height: 21vh;
        }

        @media screen and (max-width: 575px) and (min-width: 324px) {
            .product_image {
                height: auto;
            }
        }

        .product-thumb {
            border-radius: 50%;
            box-shadow: 2px 2px 5px #dbdfe2, -3px -3px 7px #fdffff !important;
        }

        .single-product .product-thumb {
            margin-bottom: 20px;
        }

        .single-product .product-title {
            margin-bottom: 20px;
            text-align: center;
            align-items: center;
        }

        .single-product .product-title h3 {
            font-family: "Didact Gothic", sans-serif;
            font-size: 20px;
            font-weight: 300;
        }

        .single-product .product-title h3 a {
            color: crimson;
            font-weight: bold;
            text-decoration: none;
        }

        .single-product .product-title h3 a:hover {
            color: #f104aa;
        }

        .single-product:hover {
            box-shadow: var(--light-shadow);
        }

        img {
            display: inline-block;
            max-width: 100%;
        }

        .product-btns {
            display: flex;
            justify-content: center;
        }

        a {
            text-decoration: none;
            cursor: pointer;
            transition: .3s;
            color: var(--light-font-color);
        }

        .btn-small {
            display: inline-block;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            text-decoration: none;
            transition: 0.4s;
            cursor: no-drop;
            box-shadow: none;
        }

        .btn-small:hover {
            color: #7289ab;
            text-decoration: none;
        }

        .btn-small:hover span {
            display: inline-block;
            transform: scale(0.98);
            cursor: no-drop;
        }

        .button-center {
            justify-content: center;
            text-align: center;
        }

        input[type="number"] {
            background: var(--light-bg-color);
            /* box-shadow: 8px 8px 16px #c3c3c3,/ */
            box-shadow: var(--light-input-shadow-hover);
            border: .5px solid whitesmoke;
            outline: none;
        }

        input[type="number"]:hover,
        input[type="number"]:active {
            box-shadow: var(--light-input-shadow);
        }

        input[type="number"]::placeholder {
            text-align: center;
            color: #f104aa;
        }

    }

    @media(prefers-color-scheme:dark) {

        input[type="number"] {
            background: var(--dark-bg-color);
            box-shadow: var(--dark-shadow);
            color: #dbdfe2;
            text-align: center;
            /* box-shadow: 8px 8px 16px #c3c3c3,/ */
            outline: none;
            padding: 4%;
            border: none;
            width: 100%;
        }

        input[type="number"]:hover,
        input[type="number"]:active,
        input[type="number"]:focus {
            box-shadow: var(--dark-shadow-hover);
            color: antiquewhite;
            text-align: center;
            caret-color: #f104aa;
        }

        input[type="number"]::placeholder {
            text-align: center;
            color: #da0b99;
        }
    }
</style>
<!-- ------------------------------------------------------------path for scrollbar----------------------------------------------------- -->
<?php
include "html/scrollbar.html";
?>
<!-- ------------------------------------------------------------path for scrollbar----------------------------------------------------- -->

<body>
    <?php
    if ($showAlert) {
        echo '<div class="alert alert-dismissible fade show" style="border:2px solid;" role="alert">
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
    <section class="section-bg" style="margin:2em 0em 5em;">
        <form action="" method="post">
            <div class="container">
                <div class="form-group">
                    <label for="address1"><i class="fa fa-map-marker" aria-hidden="true"></i> Shop Location<span style="color:red">
                            *</span></label>
                    <input type="text" class="form-control bg-nue" id="address1" placeholder="Navagam, Kalavad" name="address" required>
                </div>
                <div class="form-group">
                    <label for="phone_no"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.47 17.47 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969z" />
                        </svg> Phone_no<span style="color:red"> *</span></label>
                    <input type="tel" class="form-control bg-nue" id="phone_no" maxlength="10" minlength="10" name="phone_no" placeholder="9988776666" required>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section-title veg">
                            <center>
                                <h2>Enter Your Vegetable Requirements</h2>
                            </center>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <?php
                    $sql = "SELECT * FROM `product`";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['product_type'] == "vegetable") {
                            $picture = $row['product_img'];
                            echo '            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="single-product">
                        <div class="product-thumb" style="padding:5%;">
                            <center><img class="product_image"  src="fruits_and_vegetables/' . $picture . '" alt="' . $row["product_name"] . '" loading="lazy"  style="padding:5%;"> </center>
                        </div>
                        <div class="product-title">
                            <h3><a href="">' . $row["product_desc"] . '(' . $row["product_name"] . ')</a></h3>
                        </div>
                        <div class="product-btns">
                            <a href="" class="btn-small mr-2  not-allowed max" style="padding:5% 9%;border-radius:0px;background:#1fed56;border-radius: 16px;color:black;cursor: no-drop;"><i class="fa fa-sort-amount-asc" aria-hidden="true" style="transform: rotate(180deg);color:green;"></i>' . $row["product_price"] . '<i class="fa fa-inr" aria-hidden="true"></i></a>
                        </div><br>
                         <label class="form-check form-check-inline" for"' . $row["product_name"] . '">
                                            <input class="form-check-input" type="number" name="' . $row["product_name"] . '" placeholder="' . $row["product_name"] . '" ">*20
                                            <input class="form-check-input" type="hidden" name="' . $row["product_name"] . '_price" value=' . $row["product_price"] . '>
                    </div>
                </div>';
                        }
                    }
                    ?>

                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="section-title">
                            <center>
                                <h2>Enter Your Fruits Requirements</h2>
                            </center>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php
                    $sql = "SELECT * FROM `product`";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['product_type'] == "fruits") {
                            $picture = $row['product_img'];
                            echo '            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="single-product">
                        <div class="product-thumb">
                            <center><img class="product_image" src="fruits_and_vegetables/' . $picture . '" alt="' . $row["product_name"] . '"  width="80%" height="130vh" loading="lazy" style="padding:10px;"> </center>
                        </div>
                        <div class="product-title">
                            <h3><a href="">' . $row["product_desc"] . ' (' . $row["product_name"] . ')</a></h3>
                        </div>
                        <div class="product-btns">
                            <a href="" class="btn-small mr-2  max" style="padding:5% 9%;border-radius: 16px;background:#1fed56;color:black;cursor: no-drop;"><i class="fa fa-sort-amount-asc" aria-hidden="true" style="transform: rotate(180deg);color:green;"></i>' . $row["product_price"] . '<i class="fa fa-inr" aria-hidden="true"></i></a>
                        </div>

                        <br>
                         <label class="form-check form-check-inline" for"' . $row["product_name"] . '">
                                            <input class="form-check-input" type="number" name="' . $row["product_name"] . '" placeholder="' . $row["product_name"] . '"  ">*20
                                            <input class="form-check-input" type="hidden" name="' . $row["product_name"] . '_price" value="' . $row["product_price"] . '">

                                            </div>
                </div>';
                        }
                    }
                    ?>
                </div>

            </div>

            <center><button type="submit" name="submit" class="btn btn-primary" style="display: block;width:90%;">Click Here to Submit your Request</button></center>
        </form>

        <?php
        if (isset($_POST['submit'])) {

            // ---------------------------------------------------------X --------------X----------------------------------------------vegetable---------------------------X------------------------------------X---------------------------------------------------------
            $Tomato = (int)$_POST["Tomato"];
            $Tomato_price = (int)$_POST["Tomato_price"] * (int)$_POST["Tomato"];

            $Potato = (int)$_POST["Potato"];
            $Potato_price = (int)$_POST["Potato_price"] * (int)$_POST["Potato"];

            $Onion = (int)$_POST["Onion"];
            $Onion_price = (int)$_POST["Onion_price"] * (int)$_POST["Onion"];

            $Eggplant = (int)$_POST["Eggplant"];
            $Eggplant_price = (int) $_POST["Eggplant_price"] * (int)$_POST["Eggplant"];

            $Gourd = (int)$_POST["Gourd"];
            $Gourd_price = (int) $_POST["Gourd_price"] * (int) $_POST["Gourd"];

            $Bitter_Gourd = (int) $_POST["Bitter_Gourd"];
            $Bitter_Gourd_price = (int)$_POST["Bitter_Gourd_price"] * (int) $_POST["Bitter_Gourd"];

            $Ridge_Gourd = (int)$_POST["Ridge_Gourd"];
            $Ridge_Gourd_price = (int) $_POST["Ridge_Gourd_price"] * (int)$_POST["Ridge_Gourd"];

            $Cabbage = (int)$_POST["Cabbage"];
            $Cabbage_price = (int)$_POST["Cabbage_price"] * (int)$_POST["Cabbage"];

            $Cauliflower = (int) $_POST["Cauliflower"];
            $Cauliflower_price = (int)$_POST["Cauliflower_price"] * (int)$_POST["Cauliflower"];

            $Cucumber = (int)$_POST["Cucumber"];
            $Cucumber_price = (int)$_POST["Cucumber_price"] * (int)$_POST["Cucumber"];

            $Carrots = (int) $_POST["Carrots"];
            $Carrots_price = (int)$_POST["Carrots_price"] * (int)$_POST["Carrots"];

            $Radish = (int)$_POST["Radish"];
            $Radish_price = (int) $_POST["Radish_price"] * (int)$_POST["Radish"];

            $Cluster_Beans = (int) $_POST["Cluster_Beans"];
            $Cluster_Beans_price = (int)$_POST["Cluster_Beans_price"] * (int) $_POST["Cluster_Beans"];

            $Green_chillies = (int)$_POST["Green_chillies"];
            $Green_chillies_price = (int)$_POST["Green_chillies_price"] * (int)$_POST["Green_chillies"];

            $Red_chili = (int) $_POST["Red_chili"];
            $Red_chili_price = (int)$_POST["Red_chili_price"] * (int) $_POST["Red_chili"];

            $Corider_Leaf = (int)$_POST["Corider_Leaf"];
            $Corider_Leaf_price = (int) $_POST["Corider_Leaf_price"] * (int)$_POST["Corider_Leaf"];

            $Ginger = (int)$_POST["Ginger"];
            $Ginger_price = (int)$_POST["Ginger_price"] * (int) $_POST["Ginger"];

            $Lemon = (int)$_POST["Lemon"];
            $Lemon_price = (int)$_POST["Lemon_price"] * (int)$_POST["Lemon"];

            $capsicum = (int)$_POST["capsicum"];
            $capsicum_price = (int)$_POST["capsicum_price"] * (int)$_POST["capsicum"];
            // ---------------------------------------------------------X --------------X----------------------------------------------vegetable---------------------------X------------------------------------X---------------------------------------------------------



            // -----------------------------------------------------------------------------------------------------------------------fruits----------------------------------------------------------------------------------------------------------------------------------
            $Banana = (int)$_POST["Banana"];
            $Banana_price = (int)$_POST["Banana_price"] * (int)$_POST["Banana"];

            $Mango = (int)$_POST["Mango"];
            $Mango_price = (int)$_POST["Mango_price"] * (int)$_POST["Mango"];

            $Watermelon = (int)$_POST["Watermelon"];
            $Watermelon_price = (int)$_POST["Watermelon_price"] * (int)$_POST["Watermelon"];

            $Pomegranate = (int)$_POST["Pomegranate"];
            $Pomegranate_price = (int)$_POST["Pomegranate_price"] * (int)$_POST["Pomegranate"];

            $Pineapple = (int)$_POST["Pineapple"];
            $Pineapple_price = (int)$_POST["Pineapple_price"] * (int)$_POST["Pineapple"];

            $Ugli = (int)$_POST["Ugli"];
            $Ugli_price = (int)$_POST["Ugli_price"] * (int)$_POST["Ugli"];

            $strawberry = (int)$_POST["strawberry"];
            $strawberry_price = (int)$_POST["strawberry_price"] * (int)$_POST["strawberry"];

            $Green_Grapes = (int)$_POST["Green_Grapes"];
            $Green_Grapes_price = (int)$_POST["Green_Grapes_price"] * (int)$_POST["Green_Grapes"];

            $Melon = (int)$_POST["Melon"];
            $Melon_price = (int)$_POST["Melon_price"] * (int)$_POST["Melon"];

            $Custard_Apple = (int)$_POST["Custard_Apple"];
            $Custard_Apple_price = (int)$_POST["Custard_Apple_price"] * (int)$_POST["Custard_Apple"];

            $Guava = (int)$_POST["Guava"];
            $Guava_price = (int)$_POST["Guava_price"] * (int)$_POST["Guava"];

            $apple = (int)$_POST["apple"];
            $apple_price = (int)$_POST["apple_price"] * (int)$_POST["apple"];

            $Black_Grapes = (int)$_POST["Black_Grapes"];
            $Black_Grapes_price = (int)$_POST["Black_Grapes_price"] * (int)$_POST["Black_Grapes"];

            $Red_Dates = (int)$_POST["Red_Dates"];
            $Red_Dates_price = (int)$_POST["Red_Dates_price"] * (int)$_POST["Red_Dates"];

            $Yellow_Dates = (int)$_POST["Yellow_Dates"];
            $Yellow_Dates_price = (int)$_POST["Yellow_Dates_price"] * (int)$_POST["Yellow_Dates"];

            $Dragon_Fruit = (int)$_POST["Dragon_Fruit"];
            $Dragon_Fruit_price = (int)$_POST["Dragon_Fruit_price"] * (int)$_POST["Dragon_Fruit"];

            $Orange = (int)$_POST["Orange"];
            $Orange_price = (int)$_POST["Orange_price"] * (int)$_POST["Orange"];

            $Papaya = (int)$_POST["Papaya"];
            $Papaya_price = (int)$_POST["Papaya_price"] * (int)$_POST["Papaya"];

            $final_total = $Tomato_price + $Potato_price + $Onion_price + $Eggplant_price + $Gourd_price + $Bitter_Gourd_price + $Ridge_Gourd_price + $Cabbage_price + $Cauliflower_price + $Cucumber_price + $Carrots_price + $Radish_price + $Cluster_Beans_price + $Green_chillies_price + $Red_chili_price + $Corider_Leaf_price + $Ginger_price + $Lemon_price + $capsicum_price + $Banana_price + $Mango_price + $Watermelon_price + $Pomegranate_price + $Pineapple_price + $Ugli_price + $strawberry_price + $Green_Grapes_price + $Melon_price + $Custard_Apple_price + $Guava_price + $apple_price + $Black_Grapes_price + $Red_Dates_price + $Yellow_Dates_price + $Dragon_Fruit_price + $Orange_price + $Papaya_price;

            // -----------------------------------X--------------------------------------------------X----------------------------------fruits----------------------------------X-----------------------------------------------------------X-------------------------------------


            $capsicum = (int) $_POST["capsicum"];
            $capsicum_price = (int)$_POST["capsicum_price"] * (int)$_POST["capsicum"];
            $sql = "INSERT INTO `vendor_request`(`user_id`, `phone_no`, `address`, `Tomato`,`Tomato_total`,`Potato`,`Potato_total`,`Onion`,`Onion_total`,`Eggplant`,`Eggplant_total`,`Gourd`,`Gourd_total`,`Bitter_Gourd`,`Bitter_Gourd_total`,`Ridge_Gourd`,`Ridge_Gourd_total`,`Cabbage`,`Cabbage_total`,`Cauliflower`,`Cauliflower_total`,`Cucumber`,`Cucumber_total`,`Carrots`,`Carrots_total`,`Radish`,`Radish_total`,`Cluster_Beans`,`Cluster_Beans_total`,`Green_chillies`,`Green_chillies_total`,`Red_chili`,`Red_chili_total`,`Corider_Leaf`,`Corider_Leaf_total`,`Ginger`,`Ginger_total`,`Lemon`,`Lemon_total`,`capsicum`,`capsicum_total`                        ,`Banana`,`Banana_total`,`Mango`,`Mango_total`,`Watermelon`,`Watermelon_total`,`Pomegranate`,`Pomegranate_total`,`Pineapple`,`Pineapple_total`,`Ugli`,`Ugli_total`,`strawberry`,`strawberry_total`,`Green_Grapes`,`Green_Grapes_total`,`Melon`,`Melon_total`,`Custard_Apple`,`Custard_Apple_total`,`Guava`,`Guava_total`,`apple`,`apple_total`,`Black_Grapes`,`Black_Grapes_total`,`Red_Dates`,`Red_Dates_total`,`Yellow_Dates`,`Yellow_Dates_total`,`Dragon_Fruit`,`Dragon_Fruit_total`,`Orange`,`Orange_total`,`Papaya`,`Papaya_total`,                   `Grand_Total`)
            values('" . $user_id . "','" . $_POST['phone_no'] . "','" . $_POST['address'] . "',$Tomato,$Tomato_price,$Potato,$Potato_price,$Onion,$Onion_price,$Eggplant,$Eggplant_price,$Gourd,$Gourd_price,$Bitter_Gourd,$Bitter_Gourd_price ,$Ridge_Gourd,$Ridge_Gourd_price,$Cabbage,$Cabbage_price,$Cauliflower,$Cauliflower_price,$Cucumber,$Cucumber_price,$Carrots,$Carrots_price,$Radish,$Radish_price,$Cluster_Beans,$Cluster_Beans_price,$Green_chillies,$Green_chillies_price,$Red_chili,$Red_chili_price,$Corider_Leaf,$Corider_Leaf_price,$Ginger,$Ginger_price,$Lemon,$Lemon_price,$capsicum,$capsicum_price            , $Banana,$Banana_price,$Mango,$Mango_price,$Watermelon,$Watermelon_price,$Pomegranate,$Pomegranate_price,$Pineapple,$Pineapple_price,$Ugli,$Ugli_price,$strawberry,$strawberry_price,$Green_Grapes,$Green_Grapes_price,$Melon,$Melon_price,$Custard_Apple,$Custard_Apple_price,$Guava,$Guava_price,$apple,$apple_price,$Black_Grapes,$Black_Grapes_price,$Red_Dates,$Red_Dates_price,$Yellow_Dates,$Yellow_Dates_price,$Dragon_Fruit,$Dragon_Fruit_price,$Orange,$Orange_price,$Papaya,$Papaya_price,              $final_total)";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
            } else {
                echo mysqli_error($conn);
            }
        }
        ?>
    </section>


    <!-- ----X-------------------------X-------------------this section in only for price table----------------X-------------------X----- -->
    <div class="container-fluid">
        <?php
        include "./particial/_footer.html";
        ?>
    </div>

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
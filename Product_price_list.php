<?php
include "./particial/_dbconnect.php";
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:login.php");
    exit;
} else {
    $profession = $_SESSION['profession'];
}
require "./particial/_navbar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Price list</title>
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

    }
</style>
<!-- ------------------------------------------------------------path for scrollbar----------------------------------------------------- -->
<?php
include "html/scrollbar.html";
?>
<!-- ------------------------------------------------------------path for scrollbar----------------------------------------------------- -->

<body>


    <section class="section-bg" style="margin:2em 0em 5em;">
        <div class="container">

            <div class="row">
                <div class="col-xl-12">
                    <div class="section-title veg">
                        <center>
                            <h2>Vegetables Price List (per 20kg.)</h2>
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
                        if ($profession == "farmer") {
                            echo '            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="single-product">
                            <div class="product-thumb">
                                <center><img class="product_image" src="fruits_and_vegetables/' . $picture . '" alt="' . $row["product_name"] . '"  width="80%" height="130vh" loading="lazy" style="padding:10px;"> </center>
                            </div>
                            <div class="product-title">
                                <h3><a href="">' . $row["product_desc"] . ' (' . $row["product_name"] . ')</a></h3>
                            </div>
                            <div class="product-btns">
                                <a href="" class="btn-small mr-2  max" style="padding:5% 9%;border-radius: 16px;background:#1fed56;color:black;cursor: no-drop;"><i class="fa fa-sort-amount-asc" aria-hidden="true" style="transform: rotate(180deg);color:green;"></i>' . $row["max_price"] . '<i class="fa fa-inr" aria-hidden="true"></i></a>
                                <a href="" class="btn-small mr-2 min" style="padding:5% 9%;border-radius: 16px;background: #ed1f60;color:white;cursor: no-drop;"><i class="fa fa-sort-amount-desc" aria-hidden="true" style="color:#fc53ab"></i>' . $row["min_price"] . '<i class="fa fa-inr" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>';
                        } else {
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
                    </div>
                </div>';
                        }
                    }
                }
                ?>

            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="section-title">
                        <center>
                            <h2>Fruits Price List (per 20kg.)</h2>
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
                        if ($profession == "farmer") {
                            echo '            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                        <div class="single-product">
                            <div class="product-thumb">
                                <center><img class="product_image" src="fruits_and_vegetables/' . $picture . '" alt="' . $row["product_name"] . '"  width="80%" height="130vh" loading="lazy" style="padding:10px;"> </center>
                            </div>
                            <div class="product-title">
                                <h3><a href="">' . $row["product_desc"] . ' (' . $row["product_name"] . ')</a></h3>
                            </div>
                            <div class="product-btns">
                                <a href="" class="btn-small mr-2  max" style="padding:5% 9%;border-radius: 16px;background:#1fed56;color:black;cursor: no-drop;"><i class="fa fa-sort-amount-asc" aria-hidden="true" style="transform: rotate(180deg);color:green;"></i>' . $row["max_price"] . '<i class="fa fa-inr" aria-hidden="true"></i></a>
                                <a href="" class="btn-small mr-2 min" style="padding:5% 9%;border-radius: 16px;background: #ed1f60;color:white;cursor: no-drop;"><i class="fa fa-sort-amount-desc" aria-hidden="true" style="color:#fc53ab"></i>' . $row["min_price"] . '<i class="fa fa-inr" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>';
                        } else {
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
                    </div>
                </div>';
                        }
                    }
                }
                ?>
            </div>

        </div>
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
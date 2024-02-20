<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/farmer.css">
    <!-- Google Fonts Link -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;700;800&display=swap" rel="stylesheet" />
    <!-- Line Awesome CDN Link -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" />

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <div class="main-container">
        <h2>What's your favourite hobbie?</h2>
        <div class="radio-buttons">
            <?php
            require "./particial/_dbconnect.php";
            $sql = "SELECT * FROM `product`";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['product_type'] == "fruits") {
                    $picture = $row['product_img'];
                    echo '
                    <label class="custom-radio">
                <input type="radio" name="vegetable" value="' . $row["product_name"] . '">
                <span class="radio-btn"><i class="las la-check"></i>
                    <div class="hobbies-icon">
                        <img src="fruits_and_vegetables/' . $picture . '" title="' . $row["product_desc"] . '" width="80" height="70" loading="lazy"></i>
                        <h3 style="text-align:center;display:block;">' . $row["product_name"] . '</h3>
                        <h3 style="color:green;font-weight:bold;">' . $row["product_price"] . '<i class="las la-biking" aria-hidden="true"></i></h3>
                        </div>
                </span>
            </label>
            ';
                }
            }
            ?>
            <!-- <label class="custom-radio">
                <input type="radio" name="radio" checked />
                <span class="radio-btn"><i class="las la-check"></i>
                    <div class="hobbies-icon">
                        <i class="las la-biking"></i>
                        <h3>Biking</h3>
                    </div>
                </span>
            </label> -->
        </div>
    </div>
</body>

</html>
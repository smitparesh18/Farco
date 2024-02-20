<?php
if (isset($_GET['img'])) {
    $img = $_GET['img'];
} else {
    header("location:404.html");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        margin: 0%;
        padding: 0%;
    }

    .container {
        width: 100%;
        height: 100vh;
        background: url("img/20.jpg"), no-repeat;
        background-position: center, center;
        background-size: cover;
    }

    .image {
        background: transparent;
        backdrop-filter: blur(4.0px);
        padding: 5% 5% 5% 5%;
    }

    .image img {
        width: 100%;
        height: 80vh;
    }
</style>

<body>
    <div class="container">
        <?php
        echo "<div class='image'><img src='../Farmer_product_img/" . $img . "' alt=''></div>";
        ?>
    </div>
</body>

</html>
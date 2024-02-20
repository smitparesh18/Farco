<?php

require "../particial/_dbconnect.php";
$sql = "SELECT *FROM product";
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $product = $row['product_name'];
        $img = $row['product_img'];
        $type = $row['product_type'];
        $sql2 = "INSERT INTO `storage`(`product_name`, `product_img`, `product_type`)
        VALUES ('$product','$img','$type')";
        $result2 = mysqli_query($conn, $sql2);
    }
}

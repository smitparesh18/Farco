<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">

        <input type="text" name="product_name" id="" placeholder="product_name" required><br>
        <textarea name="product_desc" id="" placeholder="product_desc" cols="30" rows="10"></textarea><br>
        <input type="number" name="product_price" id="" placeholder="product_price" required><br>
        <fieldset>
            <legend>select product type</legend>
            <input type="radio" name="product_type" id="" value="vegetable" required>vegetable<br>
            <input type="radio" name="product_type" id="" value="fruits">fruits
        </fieldset><br>
        <input type="file" name="img1" id="" required><br>
        <input type="submit" value="upload" name="submit">
    </form>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $servername = "http://farco.atwebpages.com/";
    $username = "3774788_farco";
    $password = "farco1234";
    $database = "3774788_farco";
    $conn = mysqli_connect($servername, $username, $password, $database);
    if ($conn) {
        $product_name = $_POST['product_name'];
        $product_desc = $_POST['product_desc'];
        $product_price = $_POST['product_price'];
        $product_type = $_POST['product_type'];

        $imagename = $_FILES['img1']['name'];
        $tempimgname = $_FILES['img1']['tmp_name'];

        move_uploaded_file($tempimgname, "../fruits_and_vegetables/$imagename");

        $sql = "INSERT INTO `product`(`product_name`, `product_desc`, `product_price`, `product_type`, `product_img`) VALUES ('$product_name','$product_desc',$product_price,'$product_type','$imagename')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "image uploaded suceessfully";
        } else {
            echo mysqli_error($conn);
        }
    } else
        die("sorry connection failed");
}
?>
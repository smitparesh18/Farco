<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />

  <title>Document</title>
</head>

<body>
  <form action="">
    <?php
    $servername = "http://farco.atwebpages.com/";
    $username = "3774788_farco";
    $password = "farco1234";
    $database = "3774788_farco";
    $conn = mysqli_connect($servername, $username, $password, $database);
    $sql = "SELECT * FROM `product`";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    while ($row = mysqli_fetch_assoc($result)) {
      $picture = $row['product_img'];
      echo '<div class="form-check form-check-inline">
                                <label class="form-check form-check-inline" for"' . $row["product_name"] . '">
                                <input class="form-check-input" type="radio" name="' . $row["product_type"] . '" id="' . $row["product_name"] . '">'
        . $row["product_name"] . '<img src="../fruits_and_vegetables/' . $picture . '" width="60" height="60" loading="lazy"></label>
                      </div>';
    }

    ?>
  </form>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>
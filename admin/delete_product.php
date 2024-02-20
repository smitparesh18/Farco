<?php

include "../particial/_dbconnect.php"; // Using database connection file here

if(isset($_GET['id'])) {
   mysqli_query($conn,"DELETE FROM `product` WHERE `product_id` = '".$_GET['id']."'");
   header("location: blank.php");
   exit();
}

?>
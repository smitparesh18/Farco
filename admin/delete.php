<?php

include "../particial/_dbconnect.php"; // Using database connection file here

if (isset($_GET['id'])) {
   mysqli_query($conn, "DELETE FROM `registration` WHERE `user_id` = '" . $_GET['id'] . "'");
   header("location: manage_user.php");
   exit();
}

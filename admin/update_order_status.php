<?php

include "../particial/_dbconnect.php"; // Using database connection file here

if (isset($_GET['rno'])) {
    $result = mysqli_query($conn, "UPDATE `farmer_product_registration` SET `r_status`='" . $_GET['stat'] . "' WHERE `p_registation_no`='" . $_GET['rno'] . "'");
    if ($result) {
        header("location: order_status.php?success=true");
        exit();
    } else {
        echo mysqli_error($conn);
    }
}

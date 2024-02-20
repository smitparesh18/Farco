<?php

include "../particial/_dbconnect.php"; // Using database connection file here

if (isset($_GET['admin_id'])) {
    $result = mysqli_query($conn, "UPDATE `farco_admin` SET `add/remove_product`='" . $_GET['stat'] . "' WHERE `admin_id`='" . $_GET['admin_id'] . "'");
    if ($result) {
        header("location: ../owner.php?success=true");
        exit();
    } else {
        echo mysqli_error($conn);
    }
}

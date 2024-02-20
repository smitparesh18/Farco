<?php

include "../particial/_dbconnect.php"; // Using database connection file here

if (isset($_GET['rno'])) {
    $result = mysqli_query($conn, "UPDATE `vendor_request` SET `request_status`='" . $_GET['stat'] . "' WHERE `registration_no`='" . $_GET['rno'] . "'");
    if ($result) {
        header("location: manage_vendor_order.php?success=true");

        exit();
    } else {
        echo mysqli_error($conn);
    }
}

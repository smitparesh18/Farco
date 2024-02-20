<?php

include "../particial/_dbconnect.php"; // Using database connection file here

if (isset($_GET['id'])) {
    $s_result = mysqli_query($conn, "SELECT *FROM `slider` WHERE `no.` = '" . $_GET['id'] . "'");
    while ($row = mysqli_fetch_assoc($s_result)) {
        $record = $row["no."];
        $img = $row["image"];
        if (unlink('slider_img/' . $img . '')) {
            echo "file deleted successfully";
        } else {
            echo "operation failed";
        }
        $result = mysqli_query($conn, "DELETE FROM `slider` WHERE `no.` = '" . $record . "'");
    }
    header("location: index.php");
    exit();
} else {
    header("location: index.php");
}

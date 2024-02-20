
<?php
require "../particial/_dbconnect.php";
session_start();
if ($_SESSION['loggedin']) {
    $user_id = $_SESSION['user_id'];
}
if (!$_SESSION['username']) {
    header("location:../admin/login.php");
}
require "vendor/autoload.php";
$status = $_GET['status'];
$sql = "SELECT * FROM farmer_product_registration WHERE `r_status`=  '$status'";
$result = mysqli_query($conn, $sql);
$html = '
<style>
    .flex-box {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    .flex-1 {
        width: 45%;
    }

    .flex-2 {
        width: 45%;
        margin-left: 50%;
    }

    .table {
        border: 2px solid gray;
    }

    table thead {
        border: 2px solid gray;
        font-size:5px;
        border-bottom: 3px solid lightblue;
    }

    * {
        padding: 0;
        margin: 0px;
    }

    .head5 {
        border: 2px soldi black;
        padding: 5px 15px;
    }
</style>
<div class="container-fluid">
    <div class="flex-box" style="display:flex;flex-direction:row;">
        <div class="flex-1" border:1px solid gray>
            <center><img src="logo.png" width="160px" alt=""  style="height:60px;"></center>
        </div>
    </div>
        <h3 style="text-align:center">Order  Status:' . $status . '</h3>
    <hr>
</div>
<div class="containr">
    <div class="container my-3">
        <table class="table">
                <thead >
                    <tr style="">
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:5px;">F_Name</th>
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:5px;">Phone no</th>
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:5px;">Reg no.</th>
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:5px;">Product</th>
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:5px;">Quantity</th>
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:5px;">Price per 20kg</th>
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:5px;">Estimated Total</th>
                        <th colspan="2" style="font-size:12px;border:1px solid gray;padding:5px;" >Tax<i class="fa fa-inr" aria-hidden="true"></i></th>
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:5px;">Total</th>
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:5px;">Current Order Status</th>
                    </tr>
                    <tr style="">
                        <th  style="font-size:12px;border:1px solid gray;padding:5px;">cgst(4%)</th>
                        <th style="font-size:12px;border:1px solid gray;padding:5px;">sgst(4%)</th>
                    </tr>
                </thead>
                <tbody>';
while ($row = mysqli_fetch_array($result)) {
    $price = $row['estimated_price'] / $row['quantity'];
    $gst = (4 * $row['estimated_price']) / 100;
    $total = $row['estimated_price'] + $gst + $gst;
    $user_id = $row['user_id'];
    $inner_result = mysqli_query($conn, "SELECT `Name`, `phone_no` FROM `registration` WHERE `user_id`=$user_id");
    while ($inner_row = mysqli_fetch_assoc($inner_result)) {
        $html .= '
                <tr>
                    <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $inner_row["Name"] . '</td>
                    <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $inner_row["phone_no"] . '</td>
                    <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $row["p_registation_no"] . '</td>
                    <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $row['f_product'] . '</td>
                    <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $row['quantity'] . '</td>
                    <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $price . '</td>
                    <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $row['estimated_price'] . '</td>
                    <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $gst . '</td>
                    <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $gst . '</td>
                    <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $total . '</td>
                    <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $row['r_status'] . '</td>
                </tr>';
    }
}
$html .= '</tbody>
        </table><br>
        *This is computer generated report and does not required a signature.
        <br><h7 style="align:right;">' . date("d-M-Y") . '</h7>
        <hr style="height: 5px;">
        <hr>
    </div>
</div>
</html>
    ';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHtml($html);
$file = time() . ".pdf";
$mpdf->output($file, 'I');

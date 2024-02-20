<?php
require "../particial/_dbconnect.php";
session_start();
if ($_SESSION['loggedin']) {
    $user_id = $_SESSION['user_id'];
    $r_no = $_GET['reg_no'];
}
if (!isset($user_id) && !isset($r_no)) {
    header("location:login.php");
}
require "vendor/autoload.php";
$reg_no = $_GET['reg_no'];
$sql = "SELECT farmer_product_registration.user_id, farmer_product_registration.p_registation_no, farmer_product_registration.phone_no, farmer_product_registration.farm_location, farmer_product_registration.dist, farmer_product_registration.f_product, farmer_product_registration.quantity, farmer_product_registration.estimated_price, farmer_product_registration.image_1, farmer_product_registration.image_2, farmer_product_registration.r_date, farmer_product_registration.r_status,registration.Name
FROM farmer_product_registration INNER JOIN registration ON registration.user_id='" . $user_id . "' AND farmer_product_registration.p_registation_no='" . $r_no . "'
ORDER BY farmer_product_registration.p_registation_no;";
$result = mysqli_query($conn, $sql);
var_dump($result);
echo $user_id;
echo $r_no;
while ($row = mysqli_fetch_array($result)) {
    $price = $row['estimated_price'];
    $calculate = 4 * $price;
    $calculate = $calculate / 100;
    $total = $price + $calculate + $calculate;
    $html = '
    <style>
    .flex-box{
        display:flex;
        flex-direction:row;
        justify-content:center;
        align-items:center;
    }
    .flex-1
    {
            width:45%;
    }
    .flex-2{
        width:45%;
        margin-left:50%;
    }

        .table{
            border:2px solid gray;
        }
        table thead
        {
            border:2px solid gray;
            font-size=5px;
            border-bottom:3px solid lightblue;
        }
        *{
            padding:0;
            margin:0px;
        }
        .head5{
            border:2px soldi black;
            padding:5px 15px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <div class="container">
        <h5 align="center" div="head5" style="font-weight:600;">Payment Receipt</h5>
        <hr><br>
        <div class="flex-box" style="display:flex;flex-direction:row;">
            <div class="flex-1" border:1px solid gray>
            <img src="logo.png" width="360px" alt="" style="display:inline;align-self:left;margin-top:30px;height:160px;">
            </div>
            <div class="flex-2" style="margin-top:-120px;">
            <h3><b>FARCO LTD.</b></h3>
            <p>Address: Navagam(361160)</p>
            <p>Email: replay.farco.in@gmail.com</p>
            <p>Mobile: 9106975689</p>
            <p>Website: www.farco.in</p></div>
        </div>
        <hr>
    </div>
    <div class="containr">
        <b>Registration Details:-</b>
        <br>Farmer_name:- ' . $row['Name'] . '
        <br>Registration no. :- ' . $row["p_registation_no"] . '
        <br>Farm Address:- ' . $row['farm_location'] . '
        <br>
        <B> Registration Date:- 12/12/2020</b>
        <div class="container my-3">
            <table class="table table-bordered">
                <thead >
                    <tr style="border:1px solid gray;">
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:15px;">Registration no.</th>
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:15px;">Product</th>
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:15px;">Quantity</th>
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:15px;">Price per 20kg</th>
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:15px;">Estimated Total</th>
                        <th colspan="2" style="font-size:12px;border:1px solid gray;padding:15px;" >Tax</th>
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:15px;">Total</th>
                        <th rowspan="2" style="font-size:12px;border:1px solid gray;padding:15px;">Current Order Status</th>
                    </tr>
                    <tr style="border:1px solid gray;">
                        <th  style="font-size:12px;border:1px solid gray;padding:15px;">cgst(4%)</th>
                        <th style="font-size:12px;border:1px solid gray;padding:15px;">sgst(4%)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td  style="font-size:12px;border:1px solid gray;padding:5px;">' . $row["p_registation_no"] . '</td>
                        <td  style="font-size:12px;border:1px solid gray;padding:5px;">' . $row['f_product'] . '</td>
                        <td  style="font-size:12px;border:1px solid gray;padding:5px;">' . $row['quantity'] . '</td>
                        <td  style="font-size:12px;border:1px solid gray;padding:5px;">300</td>
                        <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $row['estimated_price'] . '</td>
                        <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $calculate . '</td>
                        <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $calculate . '</td>
                        <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $total . '</td>
                        <td style="font-size:12px;border:1px solid gray;padding:5px;">' . $row['r_status'] . '</td>
                    </tr>
                </tbody>
            </table><br>
            *This is computer generated invoice and does not required a signature.
            <hr style="height: 5px;">
            <hr>
        </div>
    </div>';
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHtml($html);
    $file = time() . ".pdf";
    $mpdf->output($file, 'I');
}

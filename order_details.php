      <?php
        session_start();
        if ($_SESSION['loggedin']) {
            $user_id = $_SESSION['user_id'];
            $profession = $_SESSION['profession'];
        }
        if (!isset($user_id)) {
            header("location:login.php");
        }
        if ($profession == 'vendor') {
            header("location:order_details(v).php");
        }
        require "particial/_dbconnect.php";
        ?>
      <!DOCTYPE html>
      <html lang="en">

      <head>
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="css/_root.css">
          <link rel="stylesheet" href="css/_order.css">
          <link rel="icon" href="./image/icon.png" />
          <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
          <!-- <link rel="stylesheet" href="/css/_root.css"> -->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
          <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
          <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
          <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
          <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
          <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
          <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
          <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>

          <title>Order Details</title>
      </head>

      <style>
          * {
              text-transform: capitalize;
          }

          @media(prefers-color-scheme:light) {
              body {
                  background: #e6e7ee;
              }
          }

          @media(prefers-color-scheme:dark) {
              body {
                  background: #161625;
              }
          }
      </style>

      <body>
          <div class="container my-3">
              <table id="example" class="table table-striped  dt-responsive nowrap" style="width:100%">
                  <center>
                      <h1 style="border-bottom: 5px solid crimson;font-size:x-large;">Your All Order details</h1>
                  </center>
                  <thead class="table_head">
                      <tr>
                          <th rowspan="2">NO</th>
                          <th rowspan="2">Reg_no.</th>
                          <th rowspan="2">product</th>
                          <th rowspan="2">quantity</th>
                          <th rowspan="2">estimated_price</th>
                          <th colspan="2" style="text-align: center;background:rgb(250,0,0);">Tax Rate <i class="fa fa-inr" aria-hidden="true"></i></th>
                          <th rowspan="2">total</th>
                          <th rowspan="2">registration_date</th>
                          <th rowspan="2">Name</th>
                          <th rowspan="2">phone_no</th>
                          <th rowspan="2">Farm_location</th>
                          <th rowspan="2">Dist</th>
                          <th rowspan="2">product Image1</th>
                          <th rowspan="2">product Image2</th>
                          <th rowspan="2">Current Status</th>
                          <th rowspan="2" style="color:red;">Download your Payment receipt</th>
                      </tr>
                      <tr>
                          <th style="font-size:12px;border:none;padding:15px;background:rgb(250,0,0);">cgst(4%)</th>
                          <th style="font-size:12px;border:none;padding:15px;background:rgb(250,0,0);">sgst(4%)</th>
                      </tr>
                  </thead>
                  <tbody class="table_body">

                      <?php
                        $sql = "SELECT farmer_product_registration.user_id, farmer_product_registration.p_registation_no, farmer_product_registration.phone_no, farmer_product_registration.farm_location, farmer_product_registration.dist, farmer_product_registration.f_product, farmer_product_registration.quantity, farmer_product_registration.estimated_price, farmer_product_registration.image_1, farmer_product_registration.image_2, farmer_product_registration.r_date, farmer_product_registration.r_status,registration.Name
FROM farmer_product_registration INNER JOIN registration ON registration.user_id='" . $user_id . "'
ORDER BY farmer_product_registration.p_registation_no DESC;";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                        } else {
                            echo mysqli_error($conn);
                        }

                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $img1 = $row["image_1"];
                            $img2 = $row["image_2"];
                            $rno = $row["p_registation_no"];
                            $product_img;
                            $sql1 = "SELECT `product_img` FROM `product` WHERE `product_name`='" . $row['f_product'] . "'";
                            $result1 = mysqli_query($conn, $sql1);
                            // var_dump($result1);
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $product_img = $row1['product_img'];
                                $price = $row['estimated_price'];
                                $calculate = 4 * $price;
                                $calculate = $calculate / 100;
                                $total = $price + $calculate + $calculate;
                            }
                            $Aceept = "accept";
                            $Reject = "reject";
                            echo '
                                  <tr><td style="color:#e74a3b;">' . $i . '</td>
                                  <td style="color:#000000; font-weight:bold;">' . $row["p_registation_no"] . '</td>
                                  <td><span  style="color:crimson;font-weight:bold"><img src="fruits_and_vegetables/' . $product_img . '" width="40px" height="40px" > ' . $row['f_product'] . '</span></td>
                                  <td><span style="color:blue;font-weight:bold">' . $row['quantity'] . '<span></td>
                                  <td><span  style="color:#363535;font-weight:bold">' . $row['estimated_price'] . ' <i class="fa fa-inr" aria-hidden="true"></i></span></td>
                                  <td><span  style="color:#363535;font-weight:bold">' . $calculate . ' <i class="fa fa-inr" aria-hidden="true"></i></span></td>
                                  <td><span  style="color:#363535;font-weight:bold">' . $calculate . ' <i class="fa fa-inr" aria-hidden="true"></i></i></span></td>
                                  <td style="background:gray;color:white;"><span  style="color:#ffffff;font-weight:bold;">' . $total . ' <i class="fa fa-inr" aria-hidden="true"></i></span></td>
                                  <td>' . $row['r_date'] . '</td>
                                  <td><span style="color:purple;font-weight:bold">' . $row['Name'] . '</span></td>
                                  <td><span style="color:#ff0066;font-weight:bold">' . $row['phone_no'] . '</span></td>
                                  <td><span style="color:#662200;font-weight:bold">' . $row['farm_location'] . '</span></td>
                                  <td><span style="color:#248f24;font-weight:bold">' . $row['dist'] . '</span></td>
                                  <td><div id="zoom" style="display: inline;"><a href="admin/show_image.php?img=' . $img1 . '"><img src="Farmer_product_img/' . $img1 . '" alt="" width="100px" height="50px";  ></a></div></td>
                                  <td><div id="zoom" style="display: inline;"><a href="admin/show_image.php?img=' . $img2 . '"><img src="Farmer_product_img/' . $img2 . '" alt=""  width="100px" height="50px";  ></a></div></td>
                                    ';
                            if ($row['r_status'] == 'done') {

                                echo '<td><span  style="color:green;font-weight:bold"> ' . $row['r_status'] .
                                    '</span></td>
                                     <td>
                                    <a href="invoice/invoice_generate.php?reg_no=' . $row["p_registation_no"] . '" class="btn btn-success">Payment receipt</a>
                                    </td>';
                            }
                            if ($row['r_status'] == 'Pending') {

                                echo '<td style="color:blue"><span  style="color:blue;font-weight:bold"> ' . $row['r_status'] .
                                    '</span></td>
                                      <td><input type="button" disabled class="btn btn-success" name="Invoice" value="invoice"></td>';
                            }
                            if ($row['r_status'] == "reject") {

                                echo '<td><span  style="color:red;font-weight:bold"> ' . $row['r_status'] . '</span></td>
                                <td><input type="button" disabled class="btn btn-success" name="Invoice" value="invoice"></td>';
                            }
                            if ($row['r_status'] == "accept") {

                                echo '<td><span  style="color:green;font-weight:bold"> ' . $row['r_status'] . '</span></td>
                                <td><input type="button" disabled class="btn btn-success" name="Invoice" value="invoice"></td>';
                            }


                            $i++;
                        }
                        ?>

                  </tbody>
              </table>
          </div>
          <center class="my-3"><a href="welcome.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> back to home page</a></center>
      </body>

      </html>
      <script src="https://use.fontawesome.com/82ef0688b5.js"></script>
      <script>
          $(document).ready(function() {
              $('#example').DataTable();
          });
      </script>
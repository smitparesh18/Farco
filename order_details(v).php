      <?php
        session_start();
        if ($_SESSION['loggedin']) {
            $user_id = $_SESSION['user_id'];
            $profession = $_SESSION['profession'];
        }
        if ($profession == 'farmer') {
            header("location:order_details.php");
        }
        if (!isset($user_id)) {
            header("location:login.php");
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
          <div class="container-fluid slider_table border-left-info my-1" style="border-radius: .35rem; padding:0px;background:#ffffff">
              <h1 class="text-center" style="border-bottom: 5px solid crimson;font-size:x-large;">Your All Order details</h1>
              <table id="myTable" class="display responsive nowrap" style="width:100%;padding:10px;">
                  <thead>
                      <tr>
                          <th>No.</th>
                          <!-- <th>user_id</th>
                                    <th>registration_no</th>
                                    <th>phone_no</th>
                                    <th>address</th>
                                    <th>request_date</th>
                                    <th>request_status</th>
                                    <th>Tomato</th>
                                    <th>Tomato_total</th>
                                    <th>Potato</th>
                                    <th>Potato_total</th>
                                    <th>Onion</th>
                                    <th>Onion_total</th>
                                    <th>Eggplant</th>
                                    <th>Eggplant_total</th>
                                    <th>Gourd</th>
                                    <th>Gourd_total</th>
                                    <th>Bitter_Gourd</th>
                                    <th>Bitter_Gourd_total</th>
                                    <th>Ridge_Gourd</th>
                                    <th>Ridge_Gourd_total</th>
                                    <th>Cabbage</th>
                                    <th>Cabbage_total</th>
                                    <th>Cauliflower</th>
                                    <th>Cauliflower_total</th>
                                    <th>Cucumber</th>
                                    <th>Cucumber_total</th>
                                    <th>Carrots</th>
                                    <th>Carrots_total</th>
                                    <th>Radish</th>
                                    <th>Radish_total</th>
                                    <th>Cluster_Beans</th>
                                    <th>Cluster_Beans_total</th>
                                    <th>Green_chillies</th>
                                    <th>Green_chillies_total</th>
                                    <th>Red_chili</th>
                                    <th>Red_chili_total</th>
                                    <th>Corider_Leaf</th>
                                    <th>Corider_Leaf_total</th>
                                    <th>Ginger</th>
                                    <th>Ginger_total</th>
                                    <th>Lemon</th>
                                    <th>Lemon_total</th>
                                    <th>capsicum</th>
                                    <th>capsicum_total</th>
                                    <th>Banana</th>
                                    <th>Banana_total</th>
                                    <th>Mango</th>
                                    <th>Mango_total</th>
                                    <th>Watermelon</th>
                                    <th>Watermelon_total</th>
                                    <th>Pomegranate</th>
                                    <th>Pomegranate_total</th>
                                    <th>Pineapple</th>
                                    <th>Pineapple_total</th>
                                    <th>Ugli</th>
                                    <th>Ugli_total</th>
                                    <th>strawberry</th>
                                    <th>strawberry_total</th>
                                    <th>Green_Grapes</th>
                                    <th>Green_Grapes_total</th>
                                    <th>Melon</th>
                                    <th>Melon_total</th>
                                    <th>Custard_Apple</th>
                                    <th>Custard_Apple_total</th>
                                    <th>Guava</th>
                                    <th>Guava_total</th>
                                    <th>apple</th>
                                    <th>apple_total</th>
                                    <th>Black_Grapes</th>
                                    <th>Black_Grapes_total</th>
                                    <th>Red_Dates</th>
                                    <th>Red_Dates_total</th>
                                    <th>Yellow_Dates</th>
                                    <th>Yellow_Dates_total</th>
                                    <th>Dragon_Fruit</th>
                                    <th>Dragon_Fruit_total</th>
                                    <th>Orange</th>
                                    <th>Orange_total</th>
                                    <th>Papaya</th>
                                    <th>Papaya_total</th>
                                    <th>Grand_Total</th> -->
                          <?php
                            $sql = "SELECT column_name
                                    FROM INFORMATION_SCHEMA.COLUMNS
                                    WHERE TABLE_NAME = 'vendor_request'";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                $count = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $count++;
                                    if ($count == 2) {
                                        echo "<th>Name</th>";
                                    }
                                    echo "<th>" . $row['column_name'] . "</th>";
                                }
                            } else
                                echo  mysqli_error($conn);
                            ?>
                          <th style="background:red;color:white;">SGST(4%)</th>
                          <th style="background:red;color:white;">CGST(4%)</th>
                          <th style="background:green;color:white;">Total</th>
                      </tr>
                  </thead>
                  <tbody>

                      <?php
                        $Aceept = "accept";
                        $Reject = "reject";
                        $sql1 = "SELECT *FROM `vendor_request` where `user_id`=$user_id";
                        $result1 = mysqli_query($conn, $sql1);
                        $count1 = 0;
                        while ($row1 = mysqli_fetch_assoc($result1)) {
                            $count1++;
                            $rno = $row1['registration_no'];

                            $gst = (4 * $row1['Grand_Total']) / 100;
                            $total = $row1['Grand_Total'] + $gst + $gst;
                            echo "<tr>

                            <td style='color:black;'>" . $count1 . "</td>
                            <td style='color:#000000ff;font-weight:bold;'>" . $row1['user_id'] . "</td>";

                            // $user_id1 = $row['user_id'];
                            $sql2 = "SELECT `Name` FROM `registration` WHERE `user_id`=$user_id";
                            $result2 = mysqli_query($conn, $sql2);
                            while ($name = mysqli_fetch_assoc($result2)) {
                                echo "<td style='color:#5f4b8bff;font-weight:bold;'>" . $name['Name'] . "</td>";
                            }

                            echo "
                            <td style='color:green;font-weight:bold;''>" . $row1['registration_no'] . "</td>
                            <td style='color:blue;font-weight:bold;'>" . $row1['phone_no'] . "</td>
                            <td style='color:#00203fff;font-weight:bold;'>" . $row1['address'] . "</td>
                            <td style='color:#990011ff;font-weight:bold;'>" . $row1['request_date'] . "</td>";
                            if ($row1['request_status'] == "Pending") {
                                echo "<td style='background:blue;color:white;text-align:center;'>" . $row1['request_status'] . "</td>";
                            }
                            if ($row1['request_status'] == "accept") {
                                echo "<td style='background:orange;color:white;text-align:center;'>" . $row1['request_status'] . "</td>";
                            }
                            if ($row1['request_status'] == "reject") {
                                echo "<td style='background:red;color:white;text-align:center;'>" . $row1['request_status'] . "</td>";
                            }
                            if ($row1['request_status'] == "Done") {
                                echo "<td style='background:green;color:white;text-align:center;'>" . $row1['request_status'] . "</td>";
                            }
                            // <td style='color:red;text-align:center;'>" . $row1['request_status'] . "</td>
                            echo "<td>" . $row1['Tomato'] . "</td>
                            <td>" . $row1['Tomato_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Potato'] . "</td>
                            <td>" . $row1['Potato_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Onion'] . "</td>
                            <td>" . $row1['Onion_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Eggplant'] . "</td>
                            <td>" . $row1['Eggplant_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Gourd'] . "</td>
                            <td>" . $row1['Gourd_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Bitter_Gourd'] . "</td>
                            <td>" . $row1['Bitter_Gourd_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Ridge_Gourd'] . "</td>
                            <td>" . $row1['Ridge_Gourd_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Cabbage'] . "</td>
                            <td>" . $row1['Cabbage_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Cauliflower'] . "</td>
                            <td>" . $row1['Cauliflower_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Cucumber'] . "</td>
                            <td>" . $row1['Cucumber_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Carrots'] . "</td>
                            <td>" . $row1['Carrots_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Radish'] . "</td>
                            <td>" . $row1['Radish_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Cluster_Beans'] . "</td>
                            <td>" . $row1['Cluster_Beans_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Green_chillies'] . "</td>
                            <td>" . $row1['Green_chillies_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Red_chili'] . "</td>
                            <td>" . $row1['Red_chili_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Corider_Leaf'] . "</td>
                            <td>" . $row1['Corider_Leaf_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Ginger'] . "</td>
                            <td>" . $row1['Ginger_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Lemon'] . "</td>
                            <td>" . $row1['Lemon_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['capsicum'] . "</td>
                            <td>" . $row1['capsicum_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Banana'] . "</td>
                            <td>" . $row1['Banana_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Mango'] . "</td>
                            <td>" . $row1['Mango_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Watermelon'] . "</td>
                            <td>" . $row1['Watermelon_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Pomegranate'] . "</td>
                            <td>" . $row1['Pomegranate_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Pineapple'] . "</td>
                            <td>" . $row1['Pineapple_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Ugli'] . "</td>
                            <td>" . $row1['Ugli_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['strawberry'] . "</td>
                            <td>" . $row1['strawberry_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Green_Grapes'] . "</td>
                            <td>" . $row1['Green_Grapes_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Melon'] . "</td>
                            <td>" . $row1['Melon_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Custard_Apple'] . "</td>
                            <td>" . $row1['Custard_Apple_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Guava'] . "</td>
                            <td>" . $row1['Guava_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['apple'] . "</td>
                            <td>" . $row1['apple_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Black_Grapes'] . "</td>
                            <td>" . $row1['Black_Grapes_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Red_Dates'] . "</td>
                            <td>" . $row1['Red_Dates_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Yellow_Dates'] . "</td>
                            <td>" . $row1['Yellow_Dates_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Dragon_Fruit'] . "</td>
                            <td>" . $row1['Dragon_Fruit_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Orange'] . "</td>
                            <td>" . $row1['Orange_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td>" . $row1['Papaya'] . "</td>
                            <td>" . $row1['Papaya_total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td><span style='background-color:yellow;color:black';font-weight:bold;width:25px;'>" . $row1['Grand_Total'] . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></span></td>
                            <td style='background:red;color:white;'>" . $gst . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td style='background:red;color:white;'>" . $gst . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></td>
                            <td style='background:green;color:white;''>" . $total . "<i class='fa fa-inr' style='color:green;padding-left:4px;' aria-hidden='true'></i></td>
                            </tr>";
                        }

                        ?>

                  </tbody>
              </table>
          </div>
          </div>
          <center class="my-3"><a href="welcome.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> back to home page</a></center>
      </body>

      </html>
      <script src="https://use.fontawesome.com/82ef0688b5.js"></script>
      <script>
          $(document).ready(function() {
              $('#myTable').DataTable();
          });
      </script>
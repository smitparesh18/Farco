<?php

use setasign\Fpdi\PdfParser\Filter\Flate;

require "../particial/_dbconnect.php";
$success = false;
$error = false;
// ---------------X-------------------------------X----------------this code is only for update final details---------------------X------------------------------X----------------
if (isset($_POST['update'])) {
    // var_dump($_POST['update']);
    $reg_num = $_POST['registration_number'];
    $update_result = mysqli_query($conn, "UPDATE `vendor_request` SET `request_status`='Done' WHERE `registration_no`=$reg_num;");
    if ($update_result) {
        global $success;
        $success = true;
    } else {
        global $error;
        $error = mysqli_error($conn);
    }
}
// ---------------X-------------------------------X----------------this code is only for update final details---------------------X------------------------------X----------------
?>
<?php
session_start();
$username = $_SESSION['username'];
$sql = "SELECT * FROM `farco_admin` WHERE `email`='$username' OR `phone_no` = '$username'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $picture = $row['admin_img'];
    $fname = $row["fname"];
    $lname = $row["lname"];
    $confirm = $row['confirm_details(v)'];
    if ($confirm == "Revoked") {
        header("location:404.php");
    }
}
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:login.php");
    exit;
}
?>
<?php

$insert = false;
$error = false;
require "../particial/_dbconnect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../image/icon.png" type="image/x-icon">

    <title>Conform Final Order Details</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- this link is only for datatable -->

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');

    ::-webkit-scrollbar {
        display: none;
    }

    * {
        text-transform: capitalize;
    }

    .pagination {
        position: relative;
        float: right;
    }

    .container td a {
        text-decoration: none;
        padding: 5px;
        margin-right: 5px;
        color: white;
        border-radius: 5px;
    }

    #content-wrapper {
        background-image: url('img/29.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: repeat;
    }

    #content {
        backdrop-filter: blur(7.0px);
    }

    .form-control::placeholder {
        color: blanchedalmond;
    }

    input:active,
    input {
        color: aliceblue;
    }

    /*
  #content {
    background-image: url('img/1.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: repeat;
    backdrop-filter: blur(13px);
  } */
</style>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper" style="background:url('img/29.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: repeat;">

        <div class="modal fade editmodal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background: rgba( 255, 255, 255, 0.25 );
        box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
        backdrop-filter: blur( 4px );
        -webkit-backdrop-filter: blur( 4px );
        border-radius: 10px;
      color:white;">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color:chartreuse;font-weight:bold;">Edit Product details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="add_product.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="product_id" class="col-form-label">product_id:</label>
                                <input type="number" name="product_id" id="product_id" class="form-control" id="product_id" style="background: rgba( 255, 255, 255, 0.65 );
              box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
                  backdrop-filter: blur( 7.0px );
                              -webkit-backdrop-filter: blur( 7.0px );
                    border-radius: 10px;">
                            </div>
                            <div class="form-group">
                                <label for="product_name" class="col-form-label ">product_name:</label>
                                <input type="text" name="product_name" id="product_name" class="form-control" id="product_name" style="background: rgba( 255, 255, 255, 0.65 );
                            box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
                                  backdrop-filter: blur( 7.0px );
                          -webkit-backdrop-filter: blur( 7.0px );
                          border-radius: 10px;">
                            </div>
                            <div class="form-group">
                                <label for="product_desc" class="col-form-label ">product_desc:</label>
                                <textarea name="product_desc" id="product_desc" class="form-control" id="product_desc" style="background: rgba( 255, 255, 255, 0.65 );
                  box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
                    backdrop-filter: blur( 7.0px );
                    -webkit-backdrop-filter: blur( 7.0px );
              border-radius: 10px;"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="product_price" class="col-form-label ">product_price(vendor):</label>
                                <input type="number" name="product_price" id="product_price" class="form-control" id="product_price" style="background: rgba( 255, 255, 255, 0.65 );
                      box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
                      backdrop-filter: blur( 7.0px );
                      -webkit-backdrop-filter: blur( 7.0px );
                          border-radius: 10px;">
                            </div>
                            <div class="form-group">
                                <label for="product_price" class="col-form-label ">Min price(farmer):</label>
                                <input type="number" name="product_min_price" id="min_price" class="form-control" style="background: rgba( 255, 255, 255, 0.65 );
                      box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
                      backdrop-filter: blur( 7.0px );
                      -webkit-backdrop-filter: blur( 7.0px );
                          border-radius: 10px;">
                            </div>
                            <div class="form-group">
                                <label for="product_price" class="col-form-label ">Max Price(famrer):</label>
                                <input type="number" name="product_max_price" id="max_price" class="form-control" style="background: rgba( 255, 255, 255, 0.65 );
                      box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
                      backdrop-filter: blur( 7.0px );
                      -webkit-backdrop-filter: blur( 7.0px );
                          border-radius: 10px;">
                            </div>

                            <div class="form-group">
                                <label for="">change product type</label><br>
                                <label for="vegetable">vegetables</label>
                                <input type="radio" name="product_type" value="vegetable" id="vegetable" required style="background: rgba( 255, 255, 255, 0.65 );
                          box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
                          backdrop-filter: blur( 7.0px );
                                      -webkit-backdrop-filter: blur( 7.0px );
                        border-radius: 10px;"><br>
                                <label for="fruits">fruits</label>
                                <input type="radio" name="product_type" value="fruits" id="fruits" style="background: rgba( 255, 255, 255, 0.65 );
                    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
                    backdrop-filter: blur( 7.0px );
                    -webkit-backdrop-filter: blur( 7.0px );
                    border-radius: 10px;">
                            </div>
                            <button type="submit" class="btn btn-success" value="submit" name="updatedata">Save changes</button>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ##################################################################################################### -->




        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: rgba( 207, 14, 252, 0.00 );
      box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
      backdrop-filter: blur( 8.0px );
      -webkit-backdrop-filter: blur( 8.0px );
      border: 1px solid rgba( 255, 255, 255, 0.18 );">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-globe" style="color:rgba(255,255,255,.34);"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Farco Admin Panel</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add_product.php">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    <span>Add/Remove Products</span></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="manage_user.php">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>Manage Users</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="order_status.php">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                    <span>Manage Order(f)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage_vendor_order.php">
                    <i class="fa fa-cogs" aria-hidden="true"></i>
                    <span>Manage Order(v)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="final_status.php">
                    <i class="fa fa-pencil-alt"></i>
                    <span>Confirm Details(F)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="final_status(v).php">
                    <i class="fa fa-pencil-alt"></i>
                    <span>Confirm Details(V)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="live_storage.php">
                    <i class="fa fa-boxes"></i>
                    <span>Storage</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="owner.php">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <span>Access Control(Owner)</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Buttons</a>
            <a class="collapse-item" href="cards.html">Cards</a>
          </div>
        </div>
      </li> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-image"></i>
                    <span>Manage Interface</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="py-2 collapse-inner rounded" style="background:rgba(255,255,255,.15);">
                        <h6 class="collapse-header">Choose your background</h6>
                        <div style="display:flex; flex-wrap: wrap; flex-direction:row;align-items:center;justify-content:center;">

                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/1.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpg1()"></a>
                            <script>
                                function jpg1() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/1.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/1.jpg)";
                                }
                            </script>

                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/27.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpg27()"></a>
                            <script>
                                function jpg27() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/27.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/27.jpg)";
                                }
                            </script>


                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/29.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpg29()"></a>
                            <script>
                                function jpg29() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/29.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/29.jpg)";
                                }
                            </script>

                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/30.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpg30()"></a>
                            <script>
                                function jpg30() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/30.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/30.jpg)";
                                }
                            </script>


                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/31.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpg31()"></a>
                            <script>
                                function jpg31() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/31.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/31.jpg)";
                                }
                            </script>


                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/20.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpg20()"></a>
                            <script>
                                function jpg20() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/20.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/20.jpg)";
                                }
                            </script>



                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/28.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpg28()"></a>
                            <script>
                                function jpg28() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/28.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/28.jpg)";
                                }
                            </script>



                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/32.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpg32()"></a>
                            <script>
                                function jpg32() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/32.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/32.jpg)";
                                }
                            </script>



                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/2.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpg2()"></a>
                            <script>
                                function jpg2() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/2.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/2.jpg)";
                                }
                            </script>



                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/3.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpg3()"></a>
                            <script>
                                function jpg3() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/3.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/3.jpg)";
                                }
                            </script>



                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/6.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpg6()"></a>
                            <script>
                                function jpg6() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/6.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/6.jpg)";
                                }
                            </script>

                            <h6 class="collapse-header">Abstract & Vector BG</h6>

                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/a1.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpga1()"></a>
                            <script>
                                function jpga1() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/a1.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/a1.jpg)";
                                }
                            </script>

                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/a2.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpga2()"></a>
                            <script>
                                function jpga2() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/a2.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/a2.jpg)";
                                }
                            </script>

                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/a3.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpga3()"></a>
                            <script>
                                function jpga3() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/a3.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/a3.jpg)";
                                }
                            </script>

                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/a4.png'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpga4()"></a>
                            <script>
                                function jpga4() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/a4.png)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/a4.png)";
                                }
                            </script>

                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/a5.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpga5()"></a>
                            <script>
                                function jpga5() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/a5.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/a5.jpg)";
                                }
                            </script>


                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/a6.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpga6()"></a>
                            <script>
                                function jpga6() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/a6.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/a6.jpg)";
                                }
                            </script>

                            <a class="collapse-item" style="width:40px;margin-top:15px;
            height:40px;
            border-radius:50%;
            background:url('img/a7.jpg'),no-repeat;
            background-size:cover;
            background-position:center,center;
            border:2px solid rgba(255,255,255,.15);" onclick="jpga7()"></a>
                            <script>
                                function jpga7() {
                                    document.getElementById("content-wrapper").style.backgroundImage = "url(img/a7.jpg)";
                                    document.getElementById("wrapper").style.backgroundImage = "url(img/a7.jpg)";
                                }
                            </script>
                            <br>

                            <!-- --------------------this code is only for managing a backdrop-filter:blur()---------------------------- -->
                            <h6 class="collapse-header">Manage bg-blur</h6>
                            <input type="range" id="blurValue" class="blurValue" min="1" max="45" step="1" onChange="changed()"></input>
                            <script>
                                function changed() {
                                    var obj = document.getElementById('content');
                                    obj.style["-webkit-backdrop-filter"] = "blur(" + document.getElementById("blurValue").value + "px)";
                                    obj.style["-moz-backdrop-filter"] = "blur(" + document.getElementById("blurValue").value + "px)";
                                    obj.style["-o-backdrop-filter"] = "blur(" + document.getElementById("blurValue").value + "px)";
                                    obj.style["-ms-backdrop-filter"] = "blur(" + document.getElementById("blurValue").value + "px)";
                                    obj.style["backdrop-filter"] = "blur(" + document.getElementById("blurValue").value + "px)";
                                }
                            </script>
                            <!-- --------------------this code is only for managing a backdrop-filter:blur()---------------------------- -->
                        </div>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <!-- <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"> -->
                <nav class="navbar navbar-expand  topbar  static-top shadow" style="background:rgba(255,255,255,.15);
          box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" style="background: rgba( 255, 255, 255, 0.25 ); box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 ); backdrop-filter: blur( 4px ); border: 1px solid rgba( 255, 255, 255, 0.18 );">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw" style="color:yellow;"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw" style="color:lightgreen;"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline  medium" style="font-family: 'Pacifico', cursive;color:rgba( 255, 255, 255, 0.55 );text-decoration:underline;"><?php echo $fname;
                                                                                                                                                                                    echo " ";
                                                                                                                                                                                    echo $lname; ?></span>
                                <img class="img-profile rounded-circle" style="transform: scale(1.3,1.4);box-shadow:0px 0px 5px rgba(0,0,0,.5),inset 0px 0px 10px  rgba(0,0,0,.5);" src="admin_img/<?php echo $picture; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->


                <?php
                if ($success) {
                    echo '<div class="alert  alert-dismissible fade show" role="alert" style="color:#10fd00;
                                        background: rgba( 255, 255, 255, 0.25 );
                                        box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
                                        backdrop-filter: blur( 4px );
                                        font-weight: 800;
                                        font-size: x-large;
                                        border:2px solid #10fd00;
-                                                      webkit-backdrop-filter: blur( 4px );">
                                                 <strong>Success!</strong> Final Confirmation Done.
                                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                                 </button>
                                             </div>';
                }
                if ($error) {
                    echo '<div class="alert  alert-dismissible fade show" role="alert" style="color: #fd0000;
                                            font-weight: 800;
                                            font-size: x-large;
                                            background: rgba( 255, 20, 5, 0.25 );
                                            box-shadow: 0 8px 32px 0 rgb(31 38 135 / 37%);
                                            backdrop-filter: blur( 4px );
                                            border: 2px solid #fd0000;
                                            -webkit-backdrop-filter: blur( 4px );">
                                                  <strong>Sorry!</strong> ' . $error . '
                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>';
                }

                ?>

                <div class="container-fluid my-3 ml-2 mr-2" id="main" style="background: rgba( 255, 255, 255, 0.18 );
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
backdrop-filter: blur( 9.0px );
-webkit-backdrop-filter: blur( 9.0px );
border-radius: 10px;
border: 1px solid rgba( 255, 255, 255, 0.18 );
padding:15px;">
                    <h3 class="text-center text-gray-100" style="border-bottom:5px solid crimson; ">Final Conformation(Vendor)</h3>
                    <!-- Page Heading -->
                    <form method="post" action="final_status(v).php" class="text-gray-200">
                        <div class="form-group">
                            <label for="rno" class="text-gray-100">Vendor registration number</label>
                            <input type="number" name="rno" id="" placeholder="Enter registration number " class="form-control" id="rno" aria-describedby="emailHelp" style="color:white;background: rgba( 255, 255, 255, 0.25 );
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
backdrop-filter: blur( 4px );
border: 1px solid rgba( 255, 255, 255, 0.18 );">
                        </div>
                        <button type="submit" name="submit" value="submit" class="btn btn-block btn-success">Submit</button>
                    </form>
                </div>

                <?php
                if (isset($_POST['submit'])) {
                    if ($conn) {
                        $insert = false;
                        $error = false;
                        $rno = $_POST['rno'];
                        $sql = "SELECT * FROM `vendor_request` WHERE `registration_no`=$rno";
                        $result = mysqli_query($conn, $sql);
                        $num = mysqli_num_rows($result);
                        if ($result && $num == 1) {
                            // echo "success";
                            while ($row = mysqli_fetch_assoc($result)) {
                                $estimated_price = $row['Grand_Total'];
                                $r_no = $row['registration_no'];
                                $user_id = $row['user_id'];
                                $inner_result = mysqli_query($conn, "SELECT *FROM `registration` WHERE `user_id`=$user_id");
                                while ($inner_row = mysqli_fetch_assoc($inner_result)) {
                                    $user_name = $inner_row['Name'];
                                    echo '
                                        <div class="container-fluid my-3 ml-2 mr-2" id="main" style="background: rgba( 255, 255, 255, 0.18 );
                                            box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
                                            backdrop-filter: blur( 9.0px );
                                            -webkit-backdrop-filter: blur( 9.0px );
                                            border-radius: 10px;
                                            border: 1px solid rgba( 255, 255, 255, 0.18 );
                                            padding:15px;">
                    <h3 class="text-center text-gray-100" style="border-bottom:5px solid rgba(255,255,255,.5);">Confirm Final Details</h3>
                                        <form method="post" action="final_status(v).php"  class="text-gray-200">
                                    <div class="form-group">
                                                 <label for="name" class="text-gray-100">Vendor Name</label>
                                                    <input type="text"  id="name"  value="' . $user_name . '" disabled class="form-control"  aria-describedby="emailHelp" style="color:white;background: rgba( 255, 255, 255, 0.25 );
                                                    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
                                                    backdrop-filter: blur( 4px );
                                                    border: 1px solid rgba( 255, 255, 255, 0.18 );"></div>
                                        ';
                                }
                                $GST = ($row['Grand_Total'] * 4) / 100;
                                $total_price = $row['Grand_Total'] + ($GST * 2);
                                echo '
                                <div class="form-group">
                                    <label for="reg_num" class="text-gray-100">Product Registration Number</label>
                                    <input type="number" name="reg_no" id="reg_num" disabled class="form-control" id="reg_num" value="' .
                                    $row['registration_no'] . '"  aria-describedby="emailHelp" style="color:white;background: rgba( 255, 255, 255, 0.25 );
        box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
        backdrop-filter: blur( 4px );
        border: 1px solid rgba( 255, 255, 255, 0.18 );">
                                </div>
<div class="form-group">
                                    <label for="product_name" class="text-gray-100">Total Purchasing Price</label>
                                    <input type="text" name="product_name" disabled class="form-control" id="product_name" value="' .
                                    $row['Grand_Total'] . ' RS." placeholder="product_price" aria-describedby="emailHelp" style="color:white;background: rgba( 255, 255, 255, 0.25 );
        box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
        backdrop-filter: blur( 4px );
        border: 1px solid rgba( 255, 255, 255, 0.18 );">
                                </div>
                                <div class="form-group">
                                    <label for="product_name" class="text-gray-100">CGST(4%)</label>
                                    <input type="text" name="CGST" disabled class="form-control" id="product_name" value="' .
                                    $GST . ' RS." placeholder="CGST" aria-describedby="emailHelp" style="color:white;background: rgba( 255, 255, 255, 0.25 );
        box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
        backdrop-filter: blur( 4px );
        border: 1px solid rgba( 255, 255, 255, 0.18 );">
                                </div>
                                <div class="form-group">
                                    <label for="product_name" class="text-gray-100">SGST(4%)</label>
                                    <input type="text" name="SGST" disabled class="form-control" id="product_name" value="' .
                                    $GST . ' RS." placeholder="product_price" aria-describedby="emailHelp" style="color:white;background: rgba( 255, 255, 255, 0.25 );
        box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
        backdrop-filter: blur( 4px );
        border: 1px solid rgba( 255, 255, 255, 0.18 );">
                                </div>
                                <div class="form-group">
                                    <label for="product_name" class="text-gray-100">Grand Total</label>
                                    <input type="text" name="total_price" disabled class="form-control" id="product_name" value="' .
                                    $total_price . ' RS." placeholder="product_price" aria-describedby="emailHelp" style="color:white;background: rgba( 255, 255, 255, 0.25 );
        box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
        backdrop-filter: blur( 4px );
        border: 1px solid rgba( 255, 255, 255, 0.18 );">
                                </div>
                                <div class="form-group">
                                    <label for="r_date" class="text-gray-100">Registration Date</label>
                                    <input type="datetime" name="r_date" class="form-control" id="r_date" placeholder="r_date" value="' . $row['request_date'] . '" disabled aria-describedby="emailHelp" style="color:white;background: rgba( 255, 255, 255, 0.20 );
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
backdrop-filter: blur( 16.5px );">
                                </div>';
                                if ($row['request_status'] == 'Pending') {
                                    echo '<div class="form-group">
                                    <label for="r_date" class="text-gray-100">Request Staus</label>
                                    <input type="text" name="r_date" class="form-control" id="r_date" placeholder="r_date" value="' . $row['request_status'] . '" disabled aria-describedby="emailHelp" style="color:red;font-weight:bolder;background: rgba( 255, 0, 0, 0.20 );

backdrop-filter: blur( 16.5px );">
                                </div>
                                <input type="hidden" name="registration_number" value="' . $r_no . '">
                                <input type="submit" name="update" value="Update" disabled class="btn btn-block btn-danger">
                            </form></div>';
                                }
                                if ($row['request_status'] == 'accept') {
                                    echo '<div class="form-group">
                                    <label for="r_date" class="text-gray-100">Request Staus</label>
                                    <input type="text" name="r_date" class="form-control" id="r_date" placeholder="r_date" value="' . $row['request_status'] . '" disabled aria-describedby="emailHelp" style="color:white;font-weight:bolder;background: rgba( 0, 255, 0, 0.20 );

backdrop-filter: blur( 16.5px );">
                                </div>
                                <input type="hidden" name="registration_number" value="' . $r_no . '">
                                <input type="submit" name="update" value="Update" class="btn btn-block btn-success">
                            </form></div>';
                                }
                                if ($row['request_status'] == 'Done') {
                                    echo '<div class="form-group">
                                    <label for="r_date" class="text-gray-100">Request Staus</label>
                                    <input type="text" name="r_date" class="form-control" id="r_date" placeholder="r_date" value="' . $row['request_status'] . '" disabled aria-describedby="emailHelp" style="color:white;font-weight:bolder;background: rgba( 33, 33, 33, 0.50);
border:none;
backdrop-filter: blur( 16.5px );">
                                </div>
                                <input type="hidden" name="registration_number" value="' . $r_no . '">
                                <input type="submit" name="update" value="Update" disabled class="btn btn-block btn-dark">
                            </form></div>';
                                }
                            }
                        } else {
                            $error = true;
                            // $error = "Sorry!  Recoard Not Found";
                        }
                    }
                }
                ?>

                <!-- /.container-fluid -->




                <!-- Footer -->
                <!-- <footer class="sticky-footer" style="background: rgba( 255, 255, 255, 0.3 );
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
backdrop-filter: blur( 7.0px );
-webkit-backdrop-filter: blur( 7.0px );">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto text-gray-200">
                                <span>Copyright &copy; www.farco.in 2020</span>
                            </div>
                        </div>
                    </footer> -->
                <!-- End of Footer -->
            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->

    <!-- Custom scripts for all pages-->
    <!-- <script src="js/sb-admin-2.min.js"></script> -->

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>


</html>
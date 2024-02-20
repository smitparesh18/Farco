<?php
require "../particial/_dbconnect.php";
$slider_error = false;
$slider_success = false;
if (isset($_GET['success'])) {
    $slider_success = true;
}
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
    $manage_order = $row['manage_order(f)'];
    if ($manage_order == "Revoked") {
        header("location:404.php");
    }
}
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:login.php");
    exit;
}
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

    <title>manage registration</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css\style.css">

    <!-- -------------------------------this link is only for responsive data tables--------------------------------------- -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.js"></script>

    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
    <!-- -------------------------------this link is only for responsive data tables--------------------------------------- -->

</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');

    body {
        z-index: -1;
    }

    input.form-control::placeholder {
        color: aliceblue;
    }

    input[type='radio']:after {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        top: -2px;
        left: -1px;
        position: relative;
        border: 1px solid red;
        background: white;
        content: '';
        display: inline-block;
        visibility: visible;
    }

    ::-webkit-scrollbar {
        display: none;
    }

    input[type='radio']:checked:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        border: 1px solid red;
        background-color: red;
        content: '';
        display: inline-block;
        visibility: visible;
    }

    #zoom:active>img {
        position: fixed;
        top: 0%;
        left: 0%;
        height: auto;
        width: 100%;
        z-index: 999;
    }

    #content-wrapper {
        background-image: url('img/29.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
    }

    #content {
        backdrop-filter: blur(7.0px);
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" style="background:url('img/29.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: repeat;">

        <!-- Sidebar -->
        <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background: rgba( 207, 14, 252, 0.00 );
      box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
      backdrop-filter: blur( 8.0px );
      -webkit-backdrop-filter: blur( 8.0px );
      border: 1px solid rgba( 255, 255, 255, 0.18 );">

            <!-- Sidebar - Brand -->
            <a class=" sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-globe" style="color:rgba(255,255,255,.34);"></i>
                </div>
                <div class="sidebar-brand-text mx-3">FARCO ADMIN PANEL</div>
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
            <li class="nav-item">
                <a class="nav-link" href="manage_user.php">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>Manage Users</span></a>
            </li>
            <li class="nav-item active">
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
            <li class="nav-item">
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
                <nav class="navbar navbar-expand topbar mb-4 static-top shadow" style="background:rgba(255,255,255,.15);
          box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" style="background: rgba( 255, 255, 255, 0.25 );
                box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
                backdrop-filter: blur( 4px );
                border: 1px solid rgba( 255, 255, 255, 0.18 );">
                            <div class=" input-group-append">
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
                                        <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
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

                <!-- Begin Page Content -->
                <!-- ---------------------------this code is only for reject/approve status ------------------------------------------- -->
                <?php
                if ($slider_success) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                     <strong>Success!</strong> Registration Status successfully Changed.
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                     </div>';
                }
                ?>
                <div class="container-fluid m-2" style="background: rgba( 0, 0, 0, 0.05 );
backdrop-filter: blur( 9.0px );
-webkit-backdrop-filter: blur( 9.0px );

border-radius: 10px;
border: 1px solid rgba( 255, 255, 255, 0.18 );
padding:15px;">
                    <div class="container-fluid slider_table border-left-info my-1" style="border-radius: .35rem; padding:0px;">
                        <h3 class="heading text-center ">Manage Farmers Registration</h3>
                        <table id="myTable" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>User_id</th>
                                    <th>Reg_no.</th>
                                    <th>Name</th>
                                    <th>phone_no</th>
                                    <th>Farm_location</th>
                                    <th>Dist</th>
                                    <th>product</th>
                                    <th>quantity</th>
                                    <th>estimated_price</th>
                                    <th>product Image1</th>
                                    <th>product Image2</th>
                                    <th>r_date</th>
                                    <th>Current Status</th>
                                    <th style="color:red;">Update Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql = "SELECT farmer_product_registration.user_id, farmer_product_registration.p_registation_no, farmer_product_registration.phone_no, farmer_product_registration.farm_location, farmer_product_registration.dist, farmer_product_registration.f_product, farmer_product_registration.quantity, farmer_product_registration.estimated_price, farmer_product_registration.image_1, farmer_product_registration.image_2, farmer_product_registration.r_date, farmer_product_registration.r_status,registration.Name
FROM farmer_product_registration INNER JOIN registration ON registration.user_id=farmer_product_registration.user_id
ORDER BY farmer_product_registration.p_registation_no;";
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
                                    $Aceept = "accept";
                                    $Reject = "reject";
                                    if ($row['r_status'] == 'Pending')
                                        echo '
                                  <tr><td style="color:#e74a3b;">' . $i . '</td>
                                  <td style="color:crimson; font-weight:bold;">' . $row["user_id"] . '</td>
                                  <td style="color:#000000; font-weight:bold;">' . $row["p_registation_no"] . '</td>
                                  <td><span style="color:purple;font-weight:bold">' . $row['Name'] . '</span></td>
                                  <td><span style="color:#ff0066;font-weight:bold">' . $row['phone_no'] . '</span></td>
                                  <td><span style="color:#662200;font-weight:bold">' . $row['farm_location'] . '</span></td>
                                  <td><span style="color:#248f24;font-weight:bold">' . $row['dist'] . '</span></td>
                                  <td><span  style="color:crimson;font-weight:bold">' . $row['f_product'] . '</span></td>
                                  <td><span style="color:blue;font-weight:bold">' . $row['quantity'] . '<span></td>
                                  <td><span  style="color:#363535;font-weight:bold">' . $row['estimated_price'] . '<i class="fas fa-rupee-sign"></i></span></td>
                                  <td><div id="zoom" style="display: inline;"><a href="show_image.php?img=' . $img1 . '"><img src="../Farmer_product_img/' . $img1 . '" alt="" width="100px" height="50px";  ></a></div></td>
                                  <td><div id="zoom" style="display: inline;"><a href="show_image.php?img=' . $img2 . '"><img src="../Farmer_product_img/' . $img2 . '" alt=""  width="100px" height="50px";  ></a></div></td>
                                  <td>' . $row['r_date'] . '</td>

                                  <td><span  style="color:red;font-weight:bold"> ' . $row['r_status'] . '</span></td>
                                    <td>
                                    <a href="update_order_status.php?rno=' . $rno . '&stat=' . $Aceept . '" class="btn btn-success">Accept</a>
                                    <a href="update_order_status.php?rno=' . $rno . '&stat=' . $Reject . '" class="btn btn-danger">Reject</a>
                                    </td>';

                                    $i++;
                                }
                                ?>

                            </tbody>
                        </table>

                    </div>
                </div>

                <!-- -------------------------this code is only for submit form without submit button -->
                <script>
                    function myFunction() {
                        var status = confirm("do you went confirm this order");
                        if (status == true) {
                            document.getElementById("status_form").submit();
                        }
                    }
                </script>
                <!-- -------------------------this code is only for submit form without submit button -->

                <!-- ---------------------------------this script is only for full size image-------------------------- -->

                <!-- ---------X------------X------------this script is only for full size image---------X-------------X---- -->

                <!-- ---------------------------this code is only for datatable table ------------------------------------->
                <script>
                    $('#myTable').DataTable({
                        responsive: true
                    });
                </script>
                <!-- --X-------X------------------this code is only for datatable table --------X------------X----------------->
                <!-- /.container-fluid -->
                <!-- --------X-------------------this code is only for reject/approve status -----------X-------------------------------- -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer text-gray-100" style="background: rgba( 255, 255, 255, 0.3 );
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
backdrop-filter: blur( 7.0px );
-webkit-backdrop-filter: blur( 7.0px );">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; www.farco.in 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

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

</body>

</html>
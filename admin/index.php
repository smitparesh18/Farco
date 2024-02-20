<?php
require "../particial/_dbconnect.php";
$slider_error = false;
$slider_success = false;
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
  $dashboard = $row['dashboard'];
  if ($dashboard == "Revoked") {
    header("location:404.php");
  }
}
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location:login.php");
  exit;
}
?>
<?php
$sql = "SELECT *FROM `product` where `product_type`='vegetable';";
$result = mysqli_query($conn, $sql);
$vegetable = mysqli_num_rows($result);
$sql2 = "SELECT *FROM `product` where `product_type`='fruits';";
$result2 = mysqli_query($conn, $sql2);
$fruit = mysqli_num_rows($result2);
?>

<!-- ----------------------this coding is only for slider form---------------------------------------- -->
<?php
if (isset($_POST['slider-submit'])) {
  if ($conn) {
    $img_title = $_POST['img-title'];
    $img_text = $_POST['img-text'];

    $imagename = $_FILES['image']['name'];
    $tempimgname = $_FILES['image']['tmp_name'];

    move_uploaded_file($tempimgname, "slider_img/$imagename");

    $sql = "INSERT INTO `slider`(`title`, `content`, `image`) VALUES ('$img_title','$img_text','$imagename')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $slider_success = true;
    } else {
      $slider_error = mysqli_error($conn);
    }
  } else {
    die("sorry connection failed");
  }
}
?>
<!-- ---------X-----------X--------this coding is only for slider form----------X--------------X---------------- -->
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="../image/icon.png" type="image/x-icon">

  <title>FARCO Admin - Dashboard</title>


  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css\index_style.css">

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

  .card {
    /* background-image: url('img/4.jpg'); */
    background-repeat: no-repeat;
    background-size: cover;
    background: transparent;
    backdrop-filter: blur(15px) brightness(100%) saturate(200%);
    background-position: center, center;

  }

  ::-webkit-scrollbar {
    display: none;
  }

  .card-body {
    background: rgba(255, 255, 255, 0.00);
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    backdrop-filter: blur(7.0px) brightness(100%) saturate(200%);
    -webkit-backdrop-filter: blur(7.0px);
    border-radius: 0px;
  }

  #content-wrapper {
    background-image: url('img/29.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: repeat;
  }

  #content {
    background: rgba(0, 0, 0, 0.05);
    backdrop-filter: blur(13px);
  }

  input.form-control::placeholder {
    color: aliceblue;
  }

  /*
  #main {
    position: relative;
    background-image: url('img/1.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: repeat;
  }

  #main::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(7px);
  } */
  /*
  #main>* {
    z-index: 100;
  } */
</style>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper" style="background:url('img/29.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: repeat;">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: rgba( 207, 14, 252, 0.00 );
      box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
      backdrop-filter: blur( 8.0px )  brightness(100%) saturate(150%);
      -webkit-backdrop-filter: blur( 8.0px )  brightness(100%) saturate(150%);
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
      <li class="nav-item active">
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
              <input type="text" class="form-control border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" style="background: rgba( 255, 255, 255, 0.25 );
                box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
                backdrop-filter: blur( 4px );
                border: 1px solid rgba( 255, 255, 255, 0.18 );">
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
                      <button class="btn btn-success" type="button">
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
                <img class="img-profile rounded-circle" style="transform: scale(1.3,1.4);box-shadow:0px 0px 5px rgba(0,0,0,.5),inset 0px 0px 10px  rgba(0,0,0,.2);" src="admin_img/<?php echo $picture; ?>">
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
        <div class="container-fluid" id="main">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0" style="color:rgba( 255, 255, 255, 0.25 );border-bottom:5px solid">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="z-index:2;"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>
          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Registerd Farmers</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-100"><?php
                                                                          $sql = "SELECT *FROM `registration` WHERE profession='farmer'";
                                                                          $result = mysqli_query($conn, $sql);
                                                                          echo mysqli_num_rows($result);
                                                                          ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Vendor</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-100"><?php
                                                                          $sql = "SELECT *FROM `registration` WHERE profession='vendor'";
                                                                          $result = mysqli_query($conn, $sql);
                                                                          echo mysqli_num_rows($result);
                                                                          ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Available Products</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-100"><?php
                                                                                    $sql = "SELECT *FROM `product`;";
                                                                                    $result = mysqli_query($conn, $sql);
                                                                                    echo mysqli_num_rows($result);
                                                                                    ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-100"><?php
                                                                          $sql = "SELECT `r_status` FROM `farmer_product_registration` WHERE `r_status`='Pending';";
                                                                          $result = mysqli_query($conn, $sql);
                                                                          $num = mysqli_affected_rows($conn);
                                                                          echo $num;
                                                                          ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: rgba( 255, 255, 255, 0.25 );
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 4px );
border: 1px solid rgba( 255, 255, 255, 0.18 );">
                  <h6 class="m-0 font-weight-bold text-light">Earnings Overview</h6>
                  <!-- <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header text-dark">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div> -->
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: rgba( 255, 255, 255, 0.25 );
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
backdrop-filter: blur( 4px );
-webkit-backdrop-filter: blur( 4px );
border: 1px solid rgba( 255, 255, 255, 0.18 );">
                  <h6 class="m-0 font-weight-bold text-primary"><span style="color:#bc5090;">Fruits</span> and <span style="color:#ff6361;">Vegetable</span></h6>
                  <!-- <div class=" dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div> -->
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small" style="color:azure;">
                    <span class="mr-2">
                      <i class="fas fa-circle" style="color:#ff6361;"></i> <?php echo $vegetable ?> Vegetables
                    </span>
                    <span class="mr-2" style="color:azure;">
                      <i class="fas fa-circle" style="color:#bc5090;"></i> <?php echo $fruit ?> Fruits
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- ----------------------this coding is only for slider form---------------------------------------- -->
          <div class="container-fluid slider_container" style="border: 1px solid rgba( 255, 255, 255, 0.18 );margin:0px;padding:0%;">
            <?php
            if ($slider_error) {
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                       <strong>Sorry!</strong> We get this error ' . $error . '
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                       </button>
                       </div>';
            }
            ?>
            <form method="post" class="slider_form" enctype="multipart/form-data">
              <?php
              if ($slider_success) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                     <strong>Success!</strong> Slider data successfully added.
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                     </div>';
              }
              if ($slider_error) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     <strong>Sorry!</strong> Error ' . $slider_error . '
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                     </div>';
              }
              ?>
              <h3 class="text-center heading">Add Slider Content</h3>
              <div class="mb-3">
                <label for="img-title" class="form-label">Slider image title</label>
                <input type="text" name="img-title" maxlength="75" id="img-title" required placeholder="type here....." aria-describedby="emailHelp">
              </div>
              <div class="mb-3">
                <label for="img-text" class="form-label">Slider img text</label>
                <textarea name="img-text" class="" maxlength="150" id="img-text" required placeholder="type here....."></textarea>
              </div>
              <div class="mb-3">
                <label for="image" class="form-label" style="color:orange">*Select image file only</label>
                <input type="file" name="image" class="form-control form-control-sm" id="image" required>
              </div>
              <button class="btn btn-block" type="submit" name="slider-submit" style="background:orange;color:white;font-weight:bold;">Submit</button>
            </form>
          </div>
          <!-- ----X---------X---------this coding is only for slider form-----------X--------------------X--------- -->


          <!-- ---------------------------------------------this code is only for slider datatable------------------------------------------- -->

          <div class="container-fluid slider_table border-left-info" style="border-radius: .35rem; padding:0px;">
            <h3 class="heading text-center ">Remove Slider Content</h3>
            <table id="myTable" class="display responsive nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Title</th>
                  <th>Slider Content</th>
                  <th>Slide Image</th>
                  <th style="color:red;">DELETE</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $slider_table = mysqli_query($conn, "SELECT *FROM slider;");
                $i = 1;
                while ($slider_data = mysqli_fetch_assoc($slider_table)) {
                  $slider_img = $slider_data["image"];
                  $delete_slide = $slider_data["no."];
                  echo '
                  <tr><td style="color:#e74a3b;">' . $i . '</td>
                  <td style="color:crimson; font-weight:bold;">' . $slider_data["title"] . '</td>
                  <td style="color:#000000; font-weight:bold;">' . $slider_data["content"] . '</td>
                  <td><img src="slider_img/' . $slider_img . '" alt="" width="20%" height="20%";></td>
                  <td><a href="delete_slide.php?id=' . $delete_slide . '" class="btn btn-danger">Delete</a></td></tr>';
                  $i++;
                }
                ?>

              </tbody>
            </table>

          </div>


          <script>
            $('#myTable').DataTable({
              responsive: true
            });
          </script>
          <!-- --------X-------------------------X------------this code is only for slider datatable----------------------X--------------X------ -->

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                  <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>

              <!-- Color System -->
              <div class="row">
                <div class="col-lg-6 mb-4">
                  <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                      Primary
                      <div class="text-white-50 small">#4e73df</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-success text-white shadow">
                    <div class="card-body">
                      Success
                      <div class="text-white-50 small">#1cc88a</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-info text-white shadow">
                    <div class="card-body">
                      Info
                      <div class="text-white-50 small">#36b9cc</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                      Warning
                      <div class="text-white-50 small">#f6c23e</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                      Danger
                      <div class="text-white-50 small">#e74a3b</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-secondary text-white shadow">
                    <div class="card-body">
                      Secondary
                      <div class="text-white-50 small">#858796</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-light text-black shadow">
                    <div class="card-body">
                      Light
                      <div class="text-black-50 small">#f8f9fc</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-dark text-white shadow">
                    <div class="card-body">
                      Dark
                      <div class="text-white-50 small">#5a5c69</div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-lg-6 mb-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
                  </div>
                  <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
                  <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
                </div>
              </div>

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                  <p>FARCO ADMIN PANEL makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
                  <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- /.container-fluid -->



        <!-- Footer -->
        <footer class="sticky-footer" style="background: url('img/5.jpg'),rgba(255,255,255,.8);
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
backdrop-filter: blur( 12.0px );
-webkit-backdrop-filter: blur( 12.0px );">
          <div class="container my-auto">
            <div class="copyright text-center text-gray-100 my-auto">
              <span>Copyright &copy; www.farco.in 2020</span>
            </div>
          </div>
        </footer>
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

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>


<script>
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  // Pie Chart Example
  var ctx = document.getElementById("myPieChart");
  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ["Vegetables", "Fruits"],
      datasets: [{
        data: [<?php echo $vegetable ?>, <?php echo $fruit ?>],
        backgroundColor: ['#ff6361', '#bc5090'],
        hoverBackgroundColor: ['#2e59d9', '#17a673'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  });
</script>

</html>
<?php
include "./particial/_dbconnect.php";
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location:login.php");
  exit;
} else {
  $loggedin = true;
}
?>
<?php
require "./particial/_navbar.php";
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="./css/_scroll.css">
  <link rel="stylesheet" href="./css/_root.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.css">
  <link rel="stylesheet" href="./css/_card.css" />

  <title>Welcome
    <?php
    // $name = $_SESSION['username'];
    // $sql = "SELECT Name FROM `registration` WHERE `email`='$name' OR `phone_no`='$name'";
    // $result = mysqli_query($conn, $sql);
    // while ($row = mysqli_fetch_assoc($result)) {
    //   echo $row['Name'];
    // }
    ?></title>
</head>
<style>
  ::selection {
    background: #15e09c;
    color: #23233b;
  }

  .carousel-item {
    padding: 2%;
  }

  .carousel-inner .carousel-item img {
    width: 90vw;
    height: 90vh;
    border-radius: 5px;
  }

  .carousel-caption {
    margin-bottom: 0.6em;
  }

  .border-gradient {
    border: 10px solid;
    border-image-slice: 1;
    border-width: 5px;
  }

  .border-gradient-green {
    border-image-source: linear-gradient(to left, #b721ff, #21d4fd);
  }

  @media screen and (max-width: 767px) {
    .carousel-caption h3 {
      font-size: 20px;
      font-weight: 400;
    }

    .carousel-caption p {
      font-size: 16px;
      font-weight: 300;
    }

    .heading {
      font-size: 20px;
    }
  }

  @media screen and (max-width: 367px) {

    .carousel-caption h3 {
      font-size: 15px;
      font-weight: 200;
    }

    .carousel-caption p {
      font-size: 13px;
      font-weight: 100;
    }

    .heading {
      font-size: 10px;
    }
  }

  @media(prefers-color-scheme:dark) {
    .carousel-inner {
      box-shadow: 8px 8px 8px #09090f,
        -8px -8px 8px #23233b;
      border-radius: 5px;
    }

    .carousel-inner:hover {
      box-shadow: inset 8px 8px 8px #09090f,
        inset -8px -8px 8px #23233b;
    }

    .mxgraph {
      background-color: #161625 !important;
    }

    .graph {
      padding: 15px;
      box-shadow: 8px 8px 8px #09090f,
        -8px -8px 8px #23233b;
    }

    .heading {
      padding: 10px;
      display: block;
      box-shadow: 8px 8px 8px #09090f,
        -8px -8px 8px #23233b;
      border: 3px solid rgb(#92fe9d 50%, #00c9ff 50%);
    }

    body {
      padding: 0;
      margin: 0;
      background-color: #161625 !important;
      color: white;
      font-family: 'DM Mono', monospace;
    }

    a {
      text-decoration: none;
    }

    .card-list {
      display: flex;
      padding: 3rem;
      overflow-x: scroll;
    }

    .card-list::-webkit-scrollbar {
      width: 10px;
      height: 10px;
    }

    .card-list::-webkit-scrollbar-thumb {
      background-color: rgba(255, 255, 255, .55);
      border-radius: 5px;
    }

    .card-list::-webkit-scrollbar-track {
      background-color: rgba(255, 255, 255, .25);
      border-radius: 5px;
    }

    .card {
      height: 450px;
      width: 400px;
      min-width: 250px;
      padding: 1.5rem;
      border-radius: 16px;
      /* background-image: linear-gradient(-225deg, #A445B2 0%, #D41872 52%, #FF0066 100%); */
      /* background: url('./admin/img/28.jpg'), no-repeat; */
      border-radius: 13px;
      background: var(--dark-bg-color);
      box-shadow: var(--dark-shadow);
      background-position: center, center;
      background-size: cover;
      display: flex;
      /* border: 4px solid rgba(255, 255, 255, .25); */
      flex-direction: column;
      transition: .2s;
      margin: 0;
      /* box-shadow: -5px -5px 14px #7a7a8c; */
      scroll-snap-align: start;
      clear: both;
      position: relative;
    }

    .card:focus-within~.card,
    .card:hover~.card {
      transform: translateX(130px);
    }

    .card:hover {
      transform: translateY(-1rem);
    }

    .card:not(:first-child) {
      margin-left: -130px;
    }


    .card-header {
      margin-bottom: auto;
      overflow-y: auto;
      overflow-x: hidden;

    }

    .card-header::-webkit-scrollbar {
      width: 10px;
    }

    .card-header::-webkit-scrollbar-track {
      background-color: rgba(255, 255, 255, .25);
      border-radius: 5px;
    }

    .card-header::-webkit-scrollbar-thumb {
      background-color: rgba(255, 255, 255, .55);
      border-radius: 5px;
    }

    .card-header p {
      font-size: 10px;
      padding: 5px;
      margin: 0 0 1rem;
      color: #ff8a00;
    }

    .card-header h2 {
      font-size: 20px;
      height: 150px;
      width: 200px;
      overflow: visible;
      min-width: 250px;
      margin: .25rem 0 auto;
      text-decoration: none;
      color: inherit;
      border: 0;
      display: inline-block;
      cursor: pointer;
      color: #7a7a8c;

    }

    .card-author {
      margin: 3rem 0 0;
      display: grid;
      grid-template-columns: 75px 1fr;
      align-items: center;
      position: relative;
    }

    .author-avatar {
      grid-area: auto;
      align-self: start;
      position: relative;
      box-sizing: border-box;
    }

    .author-avatar img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: block;
      overflow: hidden;
      margin: 16px 10px;
    }

    .author-name {
      grid-area: auto;
      box-sizing: border-box;
      color: #e52e71;
    }

    .author-name-prefix {
      font-style: normal;
      font-weight: 700;
      color: #00ff4c;
    }

    .half-circle {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 48px;
      fill: none;
      stroke: crimson;
      stroke-width: 8;
      stroke-linecap: round;
      pointer-events: none;
    }

    .tags {
      margin: 1rem 0 2rem;
      padding: .5rem 0 1rem;
      line-height: 2;
      margin-bottom: 0;
    }

    .tags a {
      font-style: normal;
      font-weight: 700;
      font-size: .5rem;
      color: #7a7a8c;
      text-transform: uppercase;
      font-size: .66rem;
      border: 3px solid #28242f;
      border-radius: 2rem;
      padding: .2rem .85rem .25rem;
      position: relative;
    }

    .tags a:hover {
      background: linear-gradient(90deg, #ff8a00, #e52e71);
      text-shadow: none;
      -webkit-text-fill-color: transparent;
      -webkit-background-clip: text;
      background-clip: text;
      border-color: white;
    }

  }

  @media(prefers-color-scheme:light) {
    .carousel-inner {
      border-radius: 15px;
      box-shadow: 5px 5px 10px #dbdfe2,
        -5px -5px 10px #fdffff;
    }

    .carousel-inner:hover {

      box-shadow: inset 5px 5px 10px #dbdfe2,
        inset -5px -5px 10px #fdffff;
    }

    .mxgraph {
      background: linear-gradient(315deg, #ffffff, #e4e6e6);
      box-shadow: var(--light-shadow);
      /* box-shadow: -6px -6px 44px #b9baba,
        6px 6px 44px #ffffff; */
    }

    .graph {
      padding: 15px;
      background: linear-gradient(315deg, #ffffff, #e4e6e6);
      box-shadow: var(--light-shadow);
      /* box-shadow: -6px -6px 44px #b9baba,
        6px 6px 44px #ffffff; */
    }

    .heading {
      padding: 10px;
      display: block;
      background: linear-gradient(315deg, #ffffff, #e4e6e6);
      box-shadow: var(--light-shadow);
      border: 3px solid rgb(#92fe9d 50%, #00c9ff 50%);
    }

    .carousel-indicators li {
      border: 0px solid #f7f7f7;
      border-radius: 0px;
      margin-bottom: 25px;
    }

    .carousel-indicators li:hover {
      border: 1px solid #f7f7f7;
      box-shadow: var(--light-shadow-hover);
    }

    .heading {
      color: #00ff4c;
      text-decoration: underline;
    }

    body {
      padding: 0;
      margin: 0;
      background-color: #e6e7ee !important;
      color: white;
      font-family: 'DM Mono', monospace;
    }

    a {
      text-decoration: none;
    }

    .card-list {
      display: flex;
      padding: 3rem;
      overflow-x: scroll;
    }


    .card-list::-webkit-scrollbar {
      width: 10px;
      height: 10px;
    }

    .card-list::-webkit-scrollbar-thumb {
      background-color: rgba(0, 0, 0, .55);
      border-radius: 5px;
    }

    .card-list::-webkit-scrollbar-track {
      background-color: rgba(0, 0, 0, .25);
      border-radius: 5px;
    }

    .card {
      height: 450px;
      width: 400px;
      min-width: 250px;
      padding: 1.5rem;
      border-radius: 16px;
      /* background-image: linear-gradient(-225deg, #A445B2 0%, #D41872 52%, #FF0066 100%); */
      background: var(--light-bg-color);
      background-position: center, center;
      background-size: cover;
      box-shadow: var(--light-shadow-hover);
      display: flex;
      /* border: 4px solid rgba(0, 0, 0, .25); */
      flex-direction: column;
      transition: .2s;
      margin: 0;
      /* box-shadow: -5px -5px 14px #aaa7a7; */
      scroll-snap-align: start;
      clear: both;
      position: relative;
    }

    .card:focus-within~.card,
    .card:hover~.card {
      transform: translateX(130px);
    }

    .card:hover {
      transform: translateY(-1rem);
      box-shadow: var(--light-shadow);
    }

    .card:not(:first-child) {
      margin-left: -130px;
    }


    .card-header {
      margin-bottom: auto;
      overflow: auto;
    }

    .card-header::-webkit-scrollbar {
      width: 10px;
    }

    .card-header::-webkit-scrollbar-track {
      background-color: rgba(255, 255, 255, .25);
      border-radius: 5px;
    }

    .card-header::-webkit-scrollbar-thumb {
      background-color: rgba(255, 255, 255, .55);
      border-radius: 5px;
    }

    .card-header p {
      font-size: 14px;
      padding: 5px;
      margin: 0 0 1rem;
      color: #85038a;
    }

    .card-header h2 {
      font-size: 17px;
      text-indent: 35px;
      height: 150px;
      width: 200px;
      overflow: visible;
      min-width: 250px;
      margin: .25rem 0 auto;
      text-decoration: none;
      color: rgb(49, 49, 49);
      border: 0;
      display: inline-block;
      cursor: pointer;

    }

    .card-author {
      margin: 3rem 0 0;
      display: grid;
      grid-template-columns: 75px 1fr;
      align-items: center;
      position: relative;
    }

    .author-avatar {
      grid-area: auto;
      align-self: start;
      position: relative;
      box-sizing: border-box;
    }

    .author-avatar img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      /* filter: grayscale(100%); */
      /* display: block; */
      overflow: hidden;
      margin: 16px 10px;
    }

    .author-name {
      grid-area: auto;
      color: #e52e71;
      box-sizing: border-box;
      /* -webkit-backdrop-filter: blur(5px); */
      /* backdrop-filter: blur(5px); */
    }

    .author-name-prefix {
      font-style: normal;
      font-weight: 700;
      color: #23233b;
    }

    .half-circle {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 48px;
      fill: none;
      stroke: crimson;
      stroke-width: 7;
      stroke-linecap: round;
      pointer-events: none;
    }

    .tags {
      margin: 1rem 0 2rem;
      padding: .5rem 0 1rem;
      line-height: 2;
      margin-bottom: 0;
    }

    .tags a {
      font-style: normal;
      font-weight: 700;
      font-size: .5rem;
      color: #7a7a8c;
      text-transform: uppercase;
      font-size: .66rem;
      border: 3px solid #28242f;
      border-radius: 2rem;
      padding: .2rem .85rem .25rem;
      position: relative;
    }

    .tags a:hover {
      background: linear-gradient(90deg, #ff8a00, #e52e71);
      text-shadow: none;
      -webkit-text-fill-color: transparent;
      -webkit-background-clip: text;
      background-clip: text;
      border-color: white;
    }
  }
</style>

<body>
  <!-- ------------------------------------------------------------path for scrollbar----------------------------------------------------- -->
  <?php
  include "html/scrollbar.html";
  ?>
  <!-- ------------------------------------------------------------path for scrollbar----------------------------------------------------- -->

  <!-- <h4>Welcome  -->
  <?php
  // include "./particial/_dbconnect.php";
  // $name = $_SESSION['username'];
  // $sql = "SELECT Name FROM `registration` WHERE `email`='$name' OR `phone_no`='$name'";
  // $result = mysqli_query($conn, $sql);
  // while ($row = mysqli_fetch_assoc($result)) {
  //   echo $row['Name'];
  // }
  //
  ?>
  <!-- </h4> -->


  <div class="container-fluid" style="margin:25px 0px;">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php
        $num = mysqli_query($conn, "SELECT *FROM slider");
        $count = mysqli_num_rows($num);
        for ($i = 0; $i < $count; $i++) {
          if ($i == 0) {
            echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $i . '" class="active"></li>';
          } else
            echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $i . '"></li>';
        }
        ?>
      </ol>
      <div class="carousel-inner">
        <!-- <div class="carousel-item active">
          <img src="image/farmer1.jpeg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none  d-md-block" style="background: rgba(0,0,0,.5);">
            <h3 style="color:white;font-weight:900;">Farmers feed our Family</h3>
            <p style="color:white;font-weight:600;">Indian Farmers and Indian Soldiers are heart of India</p>
          </div>
        </div> -->
        <?php
        $result = mysqli_query($conn, "SELECT *FROM slider");
        static $i = 0;
        while ($rows = mysqli_fetch_assoc($result)) {
          $slider_image = $rows['image'];
          $slider_title = $rows['title'];
          $slider_content = $rows['content'];

          if ($i == 0) {
            echo '<div class="carousel-item active">
              <img src="admin/slider_img/' . $slider_image . '" class="d-block w-100 c_img" alt="..." >
              <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,.5);">
                <h3 style="color:white;font-weight:900;">' . $slider_title . '</h3>
                <p style="color:white;font-weight:600;">' . $slider_content . '</p>
              </div>
            </div>';
          } else {
            echo '<div class="carousel-item">
              <img src="admin/slider_img/' . $slider_image . '" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,.5);">
                <h3 style="color:white;font-weight:900;">' . $slider_title . '</h3>
                <p style="color:white;font-weight:600;">' . $slider_content . '</p>
              </div>
            </div>';
          }
          $i++;
          if ($i == $count) {
            break;
          }
        }
        ?>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

  <!-- --------------------------------------------differentiate system------------------------------------->
  <div class="container-fluid graph" style="margin:3% 0% 3%;">
    <h2 class="heading text-center border-gradient border-gradient-green" style="margin:35px;">Difference between <strike style="color:rgb(72, 253, 0);"><span style="color:rgb(72, 253, 0);">Current System</span></strike> and <span style="color: #fc26aa;">Our System</span></h2>
    <div class="d-flex justify-content-center images" style="flex-wrap: wrap;">
      <div class="graph1" style="margin: 30px auto;padding:5px;">
        <h3 class="heading text-center" style="color:rgb(72, 253, 0)">Current System</h3><br>
        <!-- <div class="mxgraph" style="max-width:100%;border:1px solid transparent;" data-mxgraph="{&quot;highlight&quot;:&quot;#0000ff&quot;,&quot;nav&quot;:true,&quot;resize&quot;:true,&quot;toolbar&quot;:&quot;zoom layers lightbox&quot;,&quot;edit&quot;:&quot;_blank&quot;,&quot;xml&quot;:&quot;&lt;mxfile host=\&quot;app.diagrams.net\&quot; modified=\&quot;2020-12-01T16:33:49.892Z\&quot; agent=\&quot;5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36\&quot; etag=\&quot;k6q5afkkSyM2gysmGQMZ\&quot; version=\&quot;13.10.5\&quot; type=\&quot;device\&quot;&gt;&lt;diagram id=\&quot;C1zvv2I88nZVZuKsC2eV\&quot; name=\&quot;Page-1\&quot;&gt;1Zldk5o8FIB/jfNeyYR8ELhk0W13xo8d7bb1qsNCVKYoFrHi/voGCGAA910t6tQLJSfJSch5zjlJ7CBrFX8K7c1yGLjM70Dgxh3U60AIDU3jP4nkICSU6JlkEXpuJlNLwdR7Y0KIhHTnuWwrNYyCwI+8jSx0gvWaOZEks8Mw2MvN5oEvj7qxF6wmmDq2X5d+89xomUl1SEv5Z+YtlvnIqmZkNa+283MRBru1GG8drFlWs7JzNSATbJe2G+yPxkP9DrLCIIiyp1VsMT9Z13zFsn6PJ2qLKYdsHX2kw6/gYfXVHq3HsY1/zLfwZTbddoWW37a/E0vRgZrP9T3MA66Wzzo6iEXSfu2CvKK7TU1o8gYq3sRlJX9aJL+DsWUOusOnXm/Q7w77E+uzOfqSq+ZzzLRnbcXyFANBPm9ueF542C+9iE03tpPU7Dl8XLaMVj4vqfzR3m4yGuZezFwxNyvwgzBVhObph8u3URj8LEyrAi7asNBbsYiFiXpvveDyRDz3fP9Iw6Op6QAUGo5qLExgWlO3Q76oLIxYXDU4dyIW8IHDA28iapGmKpBkvYQLEZgV9yWOKsSKaLSUYDQUmvuC8INFMUQJBH8QTJzBB/x7PvQmPqzxaPrCubgfEhVDaxoAltWMSs32mFteJy3ZnhDFkExPdVC3PSIKbLA9AlcyPLqS4b/2R73xLcwum5cRFafeekaEqJldt4DVmsvXzE70wr3vaXhypYxgPg+t/6a8upoNXsO8SclFKZuZk15Dp5uBQ3lg0O3GIIBgj9BWkk5LKUSVU0ihRcohqqI3JhF6JZ60K/E0Gk+G5oBXJ2AlU6yhw7ojc1gXc44mn/rTm5OkuTrVcCu8FFvJ5uyECU4M1E6YwgrCElbIaE5PmN4yTOGTWL2WpmwjYT2aEx58TuNSiF+vgdAJVE5xUSeoCiF+4O/ZSA2gADy2FYxkZLqqiuvMqEZTHMIKhn/PDFpM+75DZ6tBPOpj6wl4zo+u3sBM1VRr10zOk7zk+PZ26zmyhfiahIfvyXIrJC/OxOqnhV4slQ55Kfaio268NMs18ueyU1I4dE44NgCEAsn/U2hCRxyoYYPB+UbVTvtEdrhg0fPJgLJJNMx9Fov35y/gFiTBrCzG0RREVQx1Ir7he9Rsg13osP/35Gx+77QT+pgrHeXrDB4hRkCdsFwWMt+OvN/yBUATcmKE58BLw0iOOAaVZFuJdNl7i17Hx/KqIkNWpNKKImG4qqLUA4rXvtwp1KYrgHO9og26LYrIuXTPbXE8vzLdl7r9Sa+oUPwB/Mk9accQVSBVFQqM4kPJZfDjHLbci4B+W/ib7jf+pZRQHELOcJriSHOvlHA+/Np94VeVnMt8D4yoYhx99Evxr2vW8Xuar+0PTdc+90gGyORnGPU8rosD1r/DNbpzUFcgOWJNjvHk0h0NhtWLLXItiN92L/r34dOzQ99WKGTmZOOsG4+GlzMM4BHFQElWqX2Sr0xsxVH6+WVoMvNiUGnLUkP5kp09+qAXwHtHdyqTz1dOuXhDoyoGlbVRoyX8ebH8uzBrXv4fi/p/AA==&lt;/diagram&gt;&lt;/mxfile&gt;&quot;}"></div> -->
        <center><img src="image/dum.png" alt="" width="50%" height="auto"></center>
      </div>
      <!-- <script type="text/javascript" src="https://viewer.diagrams.net/js/viewer-static.min.js"></script> -->
      <hr style="height: auto;width:5px;background:#fc26aa">
      <div class="graph2" style="margin: 30px auto;padding:5px;">
        <h3 class="heading text-center" style="color: #fc26aa;">Farco based System</h3><br>
        <!-- <div class="mxgraph" style="max-width:100%;border:1px solid transparent;" data-mxgraph="{&quot;highlight&quot;:&quot;#0000ff&quot;,&quot;nav&quot;:true,&quot;resize&quot;:true,&quot;toolbar&quot;:&quot;zoom layers lightbox&quot;,&quot;edit&quot;:&quot;_blank&quot;,&quot;xml&quot;:&quot;&lt;mxfile host=\&quot;app.diagrams.net\&quot; modified=\&quot;2020-12-01T16:45:15.685Z\&quot; agent=\&quot;5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36\&quot; etag=\&quot;v7lAG7Wk0rLBRhhyc8Y_\&quot; version=\&quot;13.10.5\&quot; type=\&quot;device\&quot;&gt;&lt;diagram id=\&quot;C1zvv2I88nZVZuKsC2eV\&quot; name=\&quot;Page-1\&quot;&gt;zZhZc5swEIB/jR/NgIQ4HhPHPWaaY+JJ2zx1ZBCYKUYUcIzz6yuQOMRhO66b2A8JWi0raffb1doTOFvnnxMcr26pS8IJUN18Am8mAGi6Bdm/QrITEtsQEj8JXCFrBIvglQhhpbYJXJJKihmlYRbEstChUUScTJLhJKFbWc2jobxqjH3SEywcHPalPwI3W3GpBcxG/oUE/qpaWTNsPrPEzm8/oZtIrBfRiPCZNa7MqFyQrrBLt6314HwCZwmlGX9a5zMSFn6tPMbf+zQyW285IVF2zAt/6PX6O76L7nOs//JS8PS8SKeAW3nB4Ua4YgKMkNm79igzy3ad7YSTjD8bWk1M0zKEV0xBs+K8mWRPvvhfWllWgtn93eLpdv5YTbB9LrvKTMZXrcRA2gBg52FAsMH1dhVkZBFjp5jZMiiZbJWtQzbS2CNOY06JF+TELfYchOGMhjQpDUGiuYiYTJ5mCf1dh1xTa1FL2TZMiI16P22Hixi8kCQjeTeyLFsIXZMs2TEVMQuRrgC79UHcgsgbHYnxtoFQg0gRUVq1EYQCKyzQ9+vFGgbYg8DgDUjA90Li+/zu5v4ygPA8YjjOkUC4pr1U1XMBgRRbYgDo5sczoI8y0IvRv0Hx6eqRFYXFaMCH2DgbBDFJAuYvkhTvBJHPptRhBjq4sOphufoQGxZYQuNcxcLQJTKmmqb30dDsATA0XdHBv7MB/cU8dMzn9bf8bq7PvqqB82tqDbDRDUnkXhW3Mhs5IU7TwJEjQfIg+1l4W0Fi9NyauclFIMrBTorKkKvri7UMcuKI9gLsC1yGE59kDyMArHBcWPBCkotzXLMj1UQAPhbrGAo0NR1YSPzls8zTrRMWw+fqVMWgOWM5qg45Sk1KN4lDDmcsPxfXe908WT9vvz445usaJuTqMXaiqbhgiCs1RH0GW4ghtU9YJUtIiLPgRW6jhpATKzzQoCwXFeK6Khc/0Klo/NzirXZz0zGkAzlXUId+Ee+unTIB6lMflRODXh2ql6fnhApaWaEqtg3flhmusTTQocz4zxnQu2A9UF6wxc7rRSXqO0ielgawnwbjfe9HUa8DTTGhxCvznIJORV9TbFO2Ztrvij8abRfSGEdnbBlZuzC7P9Ax8iUvp1nwLIe0esvWzNJCOmoSoNcZDKTAnkbSVOQvE8bQd4mhLhIYin2GZmGQDONCmoXa1W9oFurAXXSzcEzZPFgO4ceWQ6jI1VCzWUkDavMxTy2Nsl3Wb7xrXTQP0z+Cz96MGOO0AUnCqKFqBKQ6w6S2A52YYafd5vvulcu+zYHd+QKvGqfRCnXZkIY6hkZoZazgXUstLhTSPRs25KZbA9befXX1IUBv0kfyD5Psge/4yFRjw+ZHUq7e/AoN538B&lt;/diagram&gt;&lt;/mxfile&gt;&quot;}"></div> -->
        <img src="image/farco.png" alt="" width="70%" height="auto">
      </div>
      <!-- <script type="text/javascript" src="https://viewer.diagrams.net/js/viewer-static.min.js"></script> -->
    </div>
  </div>
  <!-- --------------X--------------------X----------differentiate system-----------X----------------X---------->

  <!-- -------------------------------------------------card--------------------------------------------------- -->
  <div class="container-fluid cards py-5" style="margin:3% 0% 3%;height:100vh;">
    <h3 class="heading text-center border-gradient border-gradient-green my-5" style="color:rgb(72, 253, 0);">Our Team Member</h3><br>
    <div class="blog-slider my-5">
      <div class="blog-slider__wrp swiper-wrapper">

        <div class="blog-slider__item swiper-slide">
          <div class="blog-slider__img">
            <img src="./admin/admin_img/2.jpg" alt="">
          </div>
          <div class="blog-slider__content">
            <span class="blog-slider__code">26 December 2019</span>
            <div class="blog-slider__title">Tathya Sukla</div>
            <div class="blog-slider__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi? </div>
            <a href="#" class="blog-slider__button">READ MORE</a>
          </div>
        </div>

        <div class="blog-slider__item swiper-slide">
          <div class="blog-slider__img">
            <img src="./admin/admin_img/3.jpg" alt="">
          </div>
          <div class="blog-slider__content">
            <span class="blog-slider__code">26 December 2019</span>
            <div class="blog-slider__title">Smit Chudasma</div>
            <div class="blog-slider__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi?</div>
            <a href="#" class="blog-slider__button">READ MORE</a>
          </div>
        </div>

        <div class="blog-slider__item swiper-slide">
          <div class="blog-slider__img">
            <img src="./admin/admin_img/1.png" alt="">
          </div>
          <div class="blog-slider__content">
            <span class="blog-slider__code">26 December 2019</span>
            <div class="blog-slider__title">Shyam Tala</div>
            <div class="blog-slider__text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae voluptate repellendus magni illo ea animi?</div>
            <a href="#" class="blog-slider__button">READ MORE</a>
          </div>
        </div>

      </div>
      <div class="blog-slider__pagination"></div>
    </div>
  </div>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
  <script type="text/javascript" src="./css/script.js"></script>

  <!-- --------------------x--------------------------x--------card-------------x------------------x----------- -->

  <!-- ------------------------------------------this section in only for price table------------------------------------------------ -->
  <div class="container-fluid" style="margin:3em 0 3em;">
    <h2 class="heading text-center border-gradient border-gradient-green" style="margin:35px;">Customer Feedback</h2>
    <section class="card-list">
      <article class="card">
        <header class="card-header">
          <p>Sep 11th 2020</p>
          <h2>Never forget Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae expedita ullam dolorum quasi asperiores quidem nostrum officia nulla culpa tempore! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae, saepe.
          </h2>
        </header>

        <div class="card-author">
          <a class="author-avatar" href="#">
            <img src="./admin/img/1.jpg" />
          </a>
          <svg class="half-circle" viewBox="0 0 106 57">
            <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
          </svg>

          <div class="author-name">
            <div class="author-name-prefix">Farmer</div>
            ABC XYZ
          </div>
        </div>
      </article>

      <article class="card">
        <header class="card-header">
          <p>Sep 11th 2020</p>
          <h2>Never forget Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae expedita ullam dolorum quasi
            asperiores quidem nostrum officia nulla culpa tempore! Lorem ipsum dolor sit amet consectetur, adipisicing elit.
            Repudiandae, saepe.
          </h2>
        </header>

        <div class="card-author">
          <a class="author-avatar" href="#">
            <img src="./admin/img/1.jpg" />
          </a>
          <svg class="half-circle" viewBox="0 0 106 57">
            <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
          </svg>

          <div class="author-name">
            <div class="author-name-prefix">Farmer</div>
            ABC XYZ
          </div>
        </div>
      </article>

      <article class="card">
        <header class="card-header">
          <p>Sep 11th 2020</p>
          <h2>Never forget Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae expedita ullam dolorum quasi
            asperiores quidem nostrum officia nulla culpa tempore! Lorem ipsum dolor sit amet consectetur, adipisicing elit.
            Repudiandae, saepe.
          </h2>
        </header>

        <div class="card-author">
          <a class="author-avatar" href="#">
            <img src="./admin/img/1.jpg" />
          </a>
          <svg class="half-circle" viewBox="0 0 106 57">
            <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
          </svg>

          <div class="author-name">
            <div class="author-name-prefix">Farmer</div>
            ABC XYZ
          </div>
        </div>
      </article>
      <article class="card">
        <header class="card-header">
          <p>Sep 11th 2020</p>
          <h2>Never forget Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae expedita ullam dolorum quasi
            asperiores quidem nostrum officia nulla culpa tempore! Lorem ipsum dolor sit amet consectetur, adipisicing elit.
            Repudiandae, saepe.
          </h2>
        </header>

        <div class="card-author">
          <a class="author-avatar" href="#">
            <img src="./admin/img/1.jpg" />
          </a>
          <svg class="half-circle" viewBox="0 0 106 57">
            <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
          </svg>

          <div class="author-name">
            <div class="author-name-prefix">Farmer</div>
            ABC XYZ
          </div>
        </div>
      </article>
      <article class="card">
        <header class="card-header">
          <p>Sep 11th 2020</p>
          <h2>Never forget Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae expedita ullam dolorum quasi
            asperiores quidem nostrum officia nulla culpa tempore! Lorem ipsum dolor sit amet consectetur, adipisicing elit.
            Repudiandae, saepe.
          </h2>
        </header>

        <div class="card-author">
          <a class="author-avatar" href="#">
            <img src="./admin/img/1.jpg" />
          </a>
          <svg class="half-circle" viewBox="0 0 106 57">
            <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
          </svg>

          <div class="author-name">
            <div class="author-name-prefix">Farmer</div>
            ABC XYZ
          </div>
        </div>
      </article>

      <article class="card">
        <header class="card-header">
          <p>Sep 11th 2020</p>
          <h2>Never forget Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae expedita ullam dolorum quasi
            asperiores quidem nostrum officia nulla culpa tempore! Lorem ipsum dolor sit amet consectetur, adipisicing elit.
            Repudiandae, saepe.
          </h2>
        </header>

        <div class="card-author">
          <a class="author-avatar" href="#">
            <img src="./admin/img/1.jpg" />
          </a>
          <svg class="half-circle" viewBox="0 0 106 57">
            <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
          </svg>

          <div class="author-name">
            <div class="author-name-prefix">Farmer</div>
            ABC XYZ
          </div>
        </div>
      </article>


      <article class="card">
        <header class="card-header">
          <p>Sep 11th 2020</p>
          <h2>Never forget Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae expedita ullam dolorum quasi
            asperiores quidem nostrum officia nulla culpa tempore! Lorem ipsum dolor sit amet consectetur, adipisicing elit.
            Repudiandae, saepe.
          </h2>
        </header>

        <div class="card-author">
          <a class="author-avatar" href="#">
            <img src="./admin/img/1.jpg" />
          </a>
          <svg class="half-circle" viewBox="0 0 106 57">
            <path d="M102 4c0 27.1-21.9 49-49 49S4 31.1 4 4"></path>
          </svg>

          <div class="author-name">
            <div class="author-name-prefix">Farmer</div>
            ABC XYZ
          </div>
        </div>
      </article>

    </section>
  </div>

  <!-- ----X-------------------------X-------------------this section in only for price table----------------X-------------------X----- -->
  <div class="container-fluid">
    <?php
    include "./particial/_footer.html";
    ?>
  </div>
  <!-- -----------------------------------------------------script for scrollbar------------------------------------------- -->
  <script type="text/javascript">
    let progress = document.getElementById('progressbar');
    let totalHeight = document.body.scrollHeight - window.innerHeight;
    window.onscroll = function() {
      let progressHeight = (window.pageYOffset / totalHeight) * 100;
      progress.style.height = progressHeight + "%";
    }
  </script>
</body>

</html>
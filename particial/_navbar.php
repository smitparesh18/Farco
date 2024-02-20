<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Bootstrap CSS -->
  <link rel="icon" href="./image/icon.png" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./css/_root.css">
</head>
<style>
  @media (prefers-color-scheme: light) {
    body {
      background: var(--light-bg-color);
    }

    .navbar {
      border-radius: 0px;
      background-color: var(--light-bg-color);
      box-shadow: var(--light-shadow);
    }


    .logo {
      padding: 10px 11px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: ubuntu mono;
      background: var(--light-bg-color);
      box-shadow: var(--light-shadow);
    }

    .logo:hover {
      box-shadow: var(--light-shadow-hover);
    }


    :root {
      --colorMain: #c0c0c0;
      --brShadow: 1px 1px 2px rgba(67, 233, 123, 1);
      --tlShadow: 1px 1px 2px rgba(56, 249, 215, 1);
    }

    .text {
      color: rgba(67, 233, 123, 1);
      font-size: 1.5em;
      border-bottom: 2px solid rgba(56, 249, 215, 1);
      font-weight: bold;
      font-family: sans-serif;
      text-transform: uppercase;
      text-shadow: var(--brShadow),
        var(--tlShadow);
      position: relative;

      &::before,
      &::after {
        position: absolute;
        background: var(--colorMain);
        content: '';
        border-radius: 10%;

      }

      &::before {
        left: 0;
        width: 100px;
        height: 100px;
        top: -150px;
        z-index: 10;
        box-shadow: inset var(--brShadow),
          inset var(--tlShadow);

      }

      &::after {
        left: -50px;
        width: 200px;
        height: 200px;
        top: -200px;
        box-shadow: var(--brShadow),
          var(--tlShadow);
      }
    }

    .text span {
      color: rgba(56, 249, 215, 1);
      border-bottom: 2px solid rgba(67, 233, 123, 1);
    }


    .image {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 40px;
      height: 40px;
      background-image: linear-gradient(45deg, #3023AE 0%, #f09 100%);
      border-radius: 68% 32% 50% 50% / 34% 83% 17% 66%;
      z-index: 999;
      animation: animate1 5s linear infinite;
    }

    .image::before {
      content: '';
      position: absolute;
      z-index: -1;
      width: 40px;
      height: 40px;
      transform: rotate(329deg);
      background-image: linear-gradient(to right, rgba(67, 233, 123, 1) 0%, rgba(56, 249, 215, 1) 100%);
      border-radius: 68% 32% 50% 50% / 34% 83% 17% 66%;
      animation: animate1 8s linear infinite;
    }

    .logo_image img {
      animation: animate2 5s linear infinite;
    }

    @keyframes animate1 {
      100% {
        transform: rotate(360deg);

      }

      0% {
        transform: rotate(0deg);
      }
    }

    @keyframes animate2 {
      100% {
        transform: rotate(-360deg);

      }

      0% {
        transform: rotate(-0deg);
      }
    }

    li {
      border: 1px solid #f7f7f7;
      border-radius: 10px;
      box-shadow: var(--light-shadow);
      margin-left: 10px;
    }

    li:hover {
      border: 1px solid #f7f7f7;
      border-radius: 10px;
      box-shadow: var(--light-shadow-hover);
      margin-left: 10px;
    }

    .sign {
      border: 2px solid rgb(28, 172, 15);
      background-color: var(--light-bg-color);
      box-shadow: var(--light-shadow);
      font-weight: bold;
      transition: all 0.2;
      border-radius: 10px;
      font-family: monospace;
    }

    .sign:hover {
      background: var(--light-bg-color);
      box-shadow: var(--light-shadow-hover);
      border: 1px solid #e6e7ee;
    }

    .sign a {
      color: rgb(28, 172, 15);
    }

    .login {
      border: 2px solid rgb(0, 17, 250);
      background-color: var(--light-bg-color);
      box-shadow: var(--light-shadow);
      font-weight: bold;
      border-radius: 10px;
      font-family: monospace;
    }

    .login:hover {
      background: var(--light-bg-color);
      box-shadow: var(--light-shadow-hover);
    }

    .login a {
      color: rgb(0, 17, 250);
    }

    a {
      font-size: 20px;
      color: var(--light-font-color);
    }

    .logout {
      border: 2px solid crimson;
      background-color: var(--light-bg-color);
      box-shadow: var(--light-shadow);
      font-weight: bold;
      border-radius: 10px;
      font-family: monospace;
    }

    .logout:hover {
      background: var(--light-bg-color);
      box-shadow: var(--light-shadow-hover);
    }

    .logout>a {
      color: crimson;
    }
  }

  /* --------------------------------dark theme------------------------------------------- */

  @media (prefers-color-scheme: dark) {
    body {
      background-color: var(--dark-bg-color);
      color: var(--dark-font-color);
    }

    .navbar {
      border-radius: 0px;
      background: var(--dark-bg-color);
      box-shadow: var(--dark-shadow);
    }

    .logo {
      padding: 10px 11px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: ubuntu mono;
      background: var(--dark-bg-color);
      box-shadow: var(--dark-shadow);
    }

    .logo:hover {
      box-shadow: var(--dark-shadow-hover);
    }


    :root {
      --colorMain: #c0c0c0;
      --brShadow: 0px 0px 5px rgba(67, 233, 123, 1);
      --tlShadow: 0px 0px 5px rgba(56, 249, 215, 1);
    }

    .text span {
      color: rgba(56, 249, 215, 1);
      border-bottom: 2px solid rgba(67, 233, 123, 1);
    }

    .text {
      color: rgba(67, 233, 123, 1);
      border-bottom: 2px solid rgba(56, 249, 215, 1);
      font-size: 1.5em;
      font-weight: bold;
      font-family: sans-serif;
      text-transform: uppercase;
      /* text-shadow: var(--brShadow), */
      /* var(--tlShadow); */
      position: relative;

      &::before,
      &::after {
        position: absolute;
        background: var(--colorMain);
        content: '';
        border-radius: 10%;

      }

      &::before {
        left: 0;
        width: 100px;
        height: 100px;
        top: -150px;
        z-index: 10;
        box-shadow: inset var(--brShadow),
          inset var(--tlShadow);

      }

      &::after {
        left: -50px;
        width: 200px;
        height: 200px;
        top: -200px;
        box-shadow: var(--brShadow),
          var(--tlShadow);
      }
    }

    .image {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 40px;
      height: 40px;
      background-image: linear-gradient(45deg, #3023AE 0%, #f09 100%);
      border-radius: 68% 32% 50% 50% / 34% 83% 17% 66%;
      z-index: 999;
      animation: animate_1 5s linear infinite;
    }

    .image::before {
      content: '';
      position: absolute;
      z-index: -1;
      width: 40px;
      height: 40px;
      transform: rotate(329deg);
      background-image: linear-gradient(to right, rgba(67, 233, 123, 1) 0%, rgba(56, 249, 215, 1) 100%);
      border-radius: 68% 32% 50% 50% / 34% 83% 17% 66%;
      animation: animate_1 5s linear infinite;
      animation: animate 5s linear infinite;
    }

    .logo_image img {
      animation: animate_2 5s linear infinite;
    }

    @keyframes animate_2 {
      100% {
        transform: rotate(-360deg);
        /* filter: hue-rotate(-360deg); */
      }

      0% {
        transform: rotate(-0deg);
      }
    }

    @keyframes animate_1 {
      100% {
        transform: rotate(360deg);
        /* filter: hue-rotate(360deg); */
      }

      0% {
        transform: rotate(0deg);
        /* filter: hue-rotate(0deg); */
      }
    }


    a {
      font-size: 20px;
      color: #6a6a6a;
    }

    li {
      background: var(--dark-bg-color);
      box-shadow: var(--dark-shadow);
      margin-left: 20px;
    }

    li:hover {
      background: var(--dark-bg-color);
      box-shadow: var(--dark-shadow-hover);
      color: crimson;
    }

    li a:hover {
      color: greenyellow;
    }

    .sign {
      background: var(--dark-bg-color);
      box-shadow: var(--dark-shadow);
      font-weight: bold;
      transition: all 0.2;
      border-radius: 17px;
      font-family: monospace;
    }

    .sign:hover {
      background: var(--dark-bg-color);
      box-shadow: var(--dark-shadow-hover);
      border: none;
    }

    .sign a {
      color: chartreuse;
    }

    .login {
      border-radius: 17px;
      font-weight: bold;
      font-family: monospace;
      background: var(--dark-bg-color);
      box-shadow: var(--dark-shadow);
      border: none;
    }

    .login:hover {
      background: var(--dark-bg-color);
      box-shadow: var(--dark-shadow-hover);
      border: none;
    }

    .login a {
      color: crimson;
    }

    .logout {
      border-radius: 17px;
      background: var(--dark-bg-color);
      box-shadow: var(--dark-shadow);
      border: none;
      font-weight: bold;
      font-family: monospace;
    }

    .logout:hover {
      background: var(--dark-bg-color);
      box-shadow: var(--dark-shadow-hover);
      border: none;
    }

    .logout a {
      color: red;
    }




  }
</style>

<body>
  <!-- --------------------------------------------------navbar----------------------------------------------------- -->
  <?php
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $loggedin = true;
  } else {
    $loggedin = false;
  }
  // sticky-top
  echo '<nav class="navbar navbar-expand-lg my-3 ">
      <a class="logo navbar-brand" href="welcome.php"
        >
          <div class="image">
                <div class="logo_image" style="background: transparent;">
                    <img src="logo/2.png" alt="" height="20" width="25">
                </div>
            </div>
            <div class="text" style="margin-left: 10px;"> FAR<span>CO</span></div>
        </a
      ><button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"
          ><span
            style="
              color: crimson;
              font-size: 1.8em;
              text-align: center;
              font-weight: 700;
            "
            >=</span
          ></span
        >
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-right">
          <li class="nav-item active">
            <a class="nav-link text-center" href="welcome.php"
              ><svg
                width="1em"
                height="1em"
                viewBox="0 0 16 16"
                class="bi bi-house-fill"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M8 3.293l6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"
                />
                <path
                  fill-rule="evenodd"
                  d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"
                />
              </svg>
              Home</a
            >
          </li>
          <li class="nav-item active">
            <a class="nav-link text-center" href="registration.php"
              ><svg
                width="1em"
                height="1em"
                viewBox="0 0 16 16"
                class="bi bi-check-circle-fill"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"
                />
              </svg>
              Registration</a
            >
          </li>
          <li class="nav-item active">
            <a class="nav-link text-center" href="Product_price_list.php"
              ><i class="fa fa-inr" aria-hidden="true"></i>
              Price List</a
            >
          </li>
          <li class="nav-item active">
            <a class="nav-link text-center" href="#"
              ><svg
                width="1em"
                height="1em"
                viewBox="0 0 16 16"
                class="bi bi-person-lines-fill"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7 1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm2 9a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"
                />
              </svg>
              Contact Us</a
            >
          </li>';

  if (!$loggedin) {
    echo '<li class="nav-item sign">
            <a class="nav-link text-center" href="signup.php"
              >Sign Up
              <i class="fa fa-sign-in" aria-hidden="true"></i>
            </a>
          </li>
          <li class="nav-item login">
            <a class="nav-link text-center" href="login.php"
              >Login
              <svg
                width="1em"
                height="1em"
                viewBox="0 0 16 16"
                class="bi bi-box-arrow-in-right"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"
                />
                <path
                  fill-rule="evenodd"
                  d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"
                /></svg
            ></a>
          </li>';
  }

  if ($loggedin) {
    echo '<li class="nav-item logout">
            <a class="nav-link text-center" href="logout.php"
              >Logout
              <svg
                width="1em"
                height="1em"
                viewBox="0 0 16 16"
                class="bi bi-box-arrow-right"
                fill="currentColor"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"
                />
                <path
                  fill-rule="evenodd"
                  d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"
                /></svg
            ></a>
          </li>


          <li class="nav-item logout">
            <a class="nav-link text-center" href="order_details.php"
              style="color:violet;"><img src="https://img.icons8.com/nolan/300/shopping-cart-promotion.png" width="40px" height="30px" style="filter:drop-shadow(0px 0px 2px rgba(25,255,255,.5));"/>order details</a>
          </li>
          ';
  }
  echo '</ul>
        <div>
    </nav>';
  ?>
  <!-- ----------X-------------------------X---------------navbar-------------------X--------------------X-------------- -->

  <!-- ------------------------------------------------footer------------------------------------------------------------------------ -->



  <!-- -------------X--------------------X---------------footer-----------------X---------------------------X---------------------------- -->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  <!-- ------------------------contact whatsapp widget ---------------------------->
  <script src="https://apps.elfsight.com/p/platform.js" defer></script>
  <div class="elfsight-app-73188eb6-1d7c-45f8-b231-3a1596ad17ac"></div>
  <script src="https://apps.elfsight.com/p/platform.js" defer></script>
  <!-- <div
      class="elfsight-app-e2bbe45e-90bd-4c5e-a265-cc4e8b1e3c62 mr-5"
      style="margin-left: 75px;"
    ></div> -->
</body>

</html>
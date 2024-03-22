<?php
include "include/includes.php";

session_start();
$mssg = '';

if (isset($_POST['login'])) {
  extract($_POST);
  $mysqli->query("SELECT * FROM `login` WHERE `username`='$email' AND `password`='$password'");
  if ($mysqli->affected_rows) {
    $_SESSION['admin'] = $email;
    header("location:index.php");
  } else {
    $mssg = "Email or Password incorrect";
  }
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>
    Parking lot management system
  </title>

  <meta name="description" content="" />

  <!-- Favicon -->

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
  <!-- Helpers -->

</head>

<body>
  <!-- Content -->

  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->

            <!-- /Logo -->
            <h5 class="mb-2 text-center">
              WELCOME
            </h5>
            <h1 class="mb-2 text-center">
              NERIM COLLEGE
            </h1>
            <h4 class="mb-2 text-center">
              Parking Lot Management System Admin Pannel
            </h4>
            <p class="mb-4 text-center">Please log-in to your account</p>

            <form id="formAuthentication" class="mb-3" action="" method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">Admin Username</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your username" autofocus />
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>

                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" aria-describedby="password" placeholder="Enter your password" />

                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit" name="login">
                  Log in
                </button>
                <?php echo $mssg; ?>
              </div>
              <p class="text-center">
                <span>Click here to : </span>
                <a href="gatekeeper/gatekeeperlogin.php">
                  <span>Login as gatekeeper<i class='bx bx-log-in-circle'></i></span>
                </a>
              </p>
            </form>


          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>
  </div>

  <!-- / Content -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->

</body>

</html>
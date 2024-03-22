<?php
include "../include/includes.php";
?>

<?php
session_start();
$mssg = '';

if (isset($_POST['submit'])) {
  extract($_POST);
  $username = $mysqli->real_escape_string($username);
  $password = $mysqli->real_escape_string($password);

  $res = $mysqli->query("SELECT * FROM `gatekeeper` WHERE `name`='$username' AND `password`='$password'");
  if ($mysqli->affected_rows) {
    while ($row = $res->fetch_assoc()) {
      $_SESSION['username'] = $username;
      $_SESSION['id'] = $row['id'];
      $_SESSION['shift'] = $row['shift'];
      header("location:dashboard/");
    }
  } else {
    $mssg = 'Username or password incorrect';
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
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
  <script src="assets/vendor/js/helpers.js"></script>
  <script src="assets/js/config.js"></script>

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
              Parking Lot Management System Gatekeeper Pannel
            </h4>
            <p class="mb-4 text-center">Please log-in to your account</p>

            <form method="POST">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Gatekeeper Username</label>
                <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your username" required>
              </div>
              <div class="mb-3 ">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password" required>
              </div>

              <button type="submit" name="submit" class="btn btn-primary d-grid w-100">
                Log in
              </button>
              <p style="color: red;"><?php echo $mssg; ?></p>
              <p class="text-center">
                <span>Click here to : </span>
                <a href="../signin.php">
                  <span>Login as admin<i class='bx bx-log-in-circle'></i></span>
                </a>
              </p>
            </form>

          </div>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>

  <!-- / Content -->
  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <!-- Vendors JS -->
  <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>
  <!-- Page JS -->
  <script src="assets/js/dashboards-analytics.js"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>
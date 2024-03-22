<?php

if (!isset($_SESSION['id'])) {
  header("location:logout.php");
} else {
  $id = $_SESSION['id'];
  $res = $mysqli->query("SELECT * FROM `gatekeeper` WHERE `id`='$id'");
  while ($row = $res->fetch_assoc()) {
    $phone = $row['number'];
    $shift = $row['shift'];
  }
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Parking lot management system</title>

  <meta name="description" content="" />

  <!-- Favicon -->

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />
  <script src="../../assets/vendor/js/helpers.js"></script>
  <script src="../../assets/js/config.js"></script>


</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">

          <span class="app-brand-text demo menu-text fw-bolder">NERIM College</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-item active">
            <a href="gatekeeperdashboard.php" class="menu-link menu-toggle">
              <i class='menu-icon tf-icons bx bxs-dashboard'></i>
              <div data-i18n="Account Settings">Gatekeeper dashboard</div>
            </a>
          </li>
        </ul>
        
      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-10">
                      <div class="card-body">
                        <h5 class="card-title text-primary">WELCOME TO PARKING LOT MANAGEMENT SYSTEM GATEKEEPER DASHBOARD</h5>

                      </div>
                      <div class="col-md-1"></div>
                    </div>
                  </div>

                </div>
                <div class="container-xxxl flex-grow-1 container-p-y">
                  <div class="row">
                    <div class="col-lg-12 mb-4 order-0">
                      <div class="card">
                        <div class="d-flex align-items-end row">
                          <div class="col-sm-12">
                            <div class="card-body">
                              <h5 class="card-title text-primary">GATEKEEPER PROFILE</h5>
                              <p class="mb-4">
                                Please check the gatekeeper profile and shift timings.
                              </p>
                              <div class="container">
                                <div class="row">
                                  <div class="col-lg-1"></div>
                                  <div class="card-body">
                                    <h5><small>Name: </small> <?php echo $_SESSION['username']; ?></h5>
                                    <h5><small>Phone: </small> <?php echo $phone; ?></h5>
                                    <h5><small>Shift: </small> <?php echo $shift; ?></h5>
                                  </div>
                                  <div class="col-md-2"></div>
                                </div>
                              </div>
                            </div>

                          </div>

                        </div>

                      </div>
                      <div class="row mt-4">
                        <div class="col-12">
                          <div class="row">
                            <div class="col-12">
                              <div class="card">
                                <div class="card-header">
                                  <h5 class="card-title text-primary">ENTRY PROFILE</h5>
                                  <p class="mb-4">
                                    Please check the client entry timings.
                                  </p>
                                </div>
                                <div class="card-body">
                                  <?php
                                  $res = $mysqli->query("SELECT * FROM `record` WHERE `vehicle`='2'");
                                  $bike = 0;
                                  $car = 0;
                                  if ($mysqli->affected_rows) {
                                    while ($row = $res->fetch_assoc()) {
                                      if ($row['entry_exit'] == 'entry') {
                                        $bike++;
                                      } else {
                                        $bike--;
                                      }
                                    }
                                  }
                                  $res = $mysqli->query("SELECT * FROM `record` WHERE `vehicle`='4'");
                                  if ($mysqli->affected_rows) {
                                    while ($row = $res->fetch_assoc()) {
                                      if ($row['entry_exit'] == 'entry') {
                                        $car++;
                                      } else {
                                        $car--;
                                      }
                                    }
                                  }

                                  ?>
                                  <h1 class="display-2">Bike - <?php echo $bike; ?></h1>

                                  <div class="col-6">
                                    <h1 class="display-2">Car - <?php echo $car; ?></h1>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="col-12 mt-4">
                        <div class="card">
                          <div class="card-header">
                            <h5 class="card-title text-primary">AVAILABALE PROFILE</h5>
                            <p class="mb-4">
                              Please check if there is space available for parking.
                            </p>
                          </div>
                          <div class="card-body">
                            <h1 class="display-2">Bike - <?php echo 30 - $bike; ?></h1>
                            <div class="col-6">
                              <h1 class="display-2">Car - <?php echo 20 - $car; ?></h1>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 mt-4">
                        <div class="card">
                          <div class="card-body">
                            <ul class="menu-inner py-1">
                              <li class="menu-item">
                              <i class='menu-icon tf-icons bx bx-log-out-circle'></i>
                                <a class="btn btn-md btn-outline-danger" href="logout.php" role="button">Logout</a>
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                </div>
              </div>
            </div>

            <!-- / Content -->


            <div class="content-backdrop fade"></div>
          </div>

        </div>


      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <!-- Page JS -->
    <script src="../../assets/js/dashboards-analytics.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>


</body>

</html>
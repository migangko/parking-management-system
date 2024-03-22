<?php

include "include/includes.php";

session_start();
if (!isset($_SESSION['admin'])) {
    header("location:logout.php");
}
$mssg = "";
if (isset($_POST['del'])) {
    extract($_POST);
    $mysqli->query("DELETE FROM `record` WHERE `sl_no`='$del'");
    header("refresh:0");
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

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
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

    <script src="assets/vendor/js/helpers.js"></script>
    <script src="assets/js/config.js"></script>

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

                    <a href="index.php" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Admin dashboards</span>
                    </li>
                    <li class="menu-item">
                        <a href="index.php" class="menu-link menu-toggle">
                        <i class='menu-icon tf-icons bx bxs-user-detail'></i>
                            <div data-i18n="Analytics">Client registration</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="gatekeeperregistration.php" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-id-card"></i>
                            <div data-i18n="Analytics">Gatekeeper registration</div>
                        </a>
                    </li>
                    <li class="menu-item active">
                        <a href="recordsdashboard.php" class="menu-link menu-toggle">
                        <i class='menu-icon tf-icons bx bxs-data'></i>
                            <div data-i18n="Analytics">Records</div>
                        </a>
                    </li>

                    <!-- Layouts -->

                    
                    <li class="menu-item">
                        <a href="logout.php" class="menu-link">
                        <i class='menu-icon tf-icons bx bx-log-out-circle'></i>
                            <div data-i18n="Account Settings">Logout</div>
                        </a>
                    </li>
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
                                <div class="container-xxxl flex-grow-1 container-p-y">
                                    <div class="row">
                                        <div class="col-lg-12 mb-4 order-0">
                                            <div class="card">
                                                <div class="d-flex align-items-end row">
                                                    <div class="col-sm-12">
                                                        <div class="card-body">
                                                            <h5 class="card-title text-primary"> SYSTEM MANAGEMENT RECORDS</h5>

                                                            <div class="container mt-5">
                                                                <div class="col-lg-1"></div>
                                                                <div class="table-responsive">
                                                                    <?php
                                                                    $res = $mysqli->query("SELECT * FROM ((`record` INNER JOIN `gatekeeper` ON record.gate_id=gatekeeper.id) INNER JOIN `registry` ON record.user_id=registry.user_id) ORDER BY `sl_no`");
                                                                    $x = 1;
                                                                    if ($mysqli->affected_rows) {
                                                                    ?>
                                                                        <table class="table table-striped">
                                                                            <thead class="table">
                                                                                <tr>
                                                                                    <th scope="col">Sl no</th>
                                                                                    <th scope="col">Date</th>
                                                                                    <th scope="col">Vehicle type</th>
                                                                                    <th scope="col">User Detail</th>
                                                                                    <th scope="col">Gatekeeper</th>
                                                                                    <th scope="col">Shift</th>
                                                                                    <th scope="col">Edit</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                                <?php

                                                                                while ($rows = $res->fetch_array()) {
                                                                                ?>
                                                                                    <tr>
                                                                                        <th scope="row"><?php echo $x++; ?></th>
                                                                                        <td>
                                                                                            <?php echo $rows['day'] ?>
                                                                                            <?php echo $rows['date'] ?><br>
                                                                                            <?php echo $rows['time'] ?>
                                                                                        </td>
                                                                                        <td><?php echo $rows['vehicle'] ?> Wheeler</td>
                                                                                        <td><?php echo $rows['name'] ?></td>
                                                                                        <td><?php echo $rows[12] ?></td>
                                                                                        <td>
                                                                                            <?php echo $rows['shift'] ?><br>
                                                                                            <?php echo $rows['entry_exit'] ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <form method="post">
                                                                                                <button type="submit" name="del" value="<?php echo $rows['sl_no']; ?>" class="btn btn-danger"><i class="bx bxs-trash"></i></button>
                                                                                            </form>
                                                                                        </td>
                                                                                    </tr>
                                                                            <?php }
                                                                            } else {
                                                                                echo "No data in the table";
                                                                            } ?>

                                                                            </tbody>
                                                                        </table>
                                                                </div>
                                                                <div class="col-md-2"></div>
                                                            </div>
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
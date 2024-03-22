<?php include "../../include/includes.php"; ?>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:logout.php");
}

date_default_timezone_set("Asia/Kolkata");

$day = date("l");
$date = date("d/m/Y");
$year = date("Y");
$month = date("m");
$time = date("h:i");
$gate_id = $_SESSION['id'];
$shift = $_SESSION['shift'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_POST['entry'])) {
    extract($_POST);
    $res = $mysqli->query("SELECT * FROM `record` WHERE `vehicle`='$vehicle'");
    $vehicle_count = 0;
    $count = $res->num_rows;
    if ($count) {
        while ($row = $res->fetch_assoc()) {
            if ($row['entry_exit'] == 'entry') {
                $vehicle_count += 1;
            } else {
                $vehicle_count -= 1;
            }
        }
        if (($vehicle == '4' && 2 - $vehicle_count > 0) || ($vehicle == '2' && 2 - $vehicle_count > 0)) {
            $mysqli->query("INSERT INTO `record`(`day`, `date`, `month`, `year`, `user_id`, `gate_id`, `shift`, `time`, `entry_exit`,`vehicle`) VALUES ('$day','$date','$month','$year','$id','$gate_id','$shift','$time','entry','$vehicle')");
            header("refresh:0");
        } else {
            echo "Parking full";
        }
    } else {
        $mysqli->query("INSERT INTO `record`(`day`, `date`, `month`, `year`, `user_id`, `gate_id`, `shift`, `time`, `entry_exit`,`vehicle`) VALUES ('$day','$date','$month','$year','$id','$gate_id','$shift','$time','entry','$vehicle')");
        header("refresh:0");
    }
}
if (isset($_POST['exit'])) {
    extract($_POST);
    $mysqli->query("INSERT INTO `record`(`day`, `date`, `month`, `year`, `user_id`, `gate_id`, `shift`, `time`, `entry_exit`,`vehicle`) VALUES ('$day','$date','$month','$year','$id','$gate_id','$shift','$time','exit', '$vehicle')");
    header("refresh:0");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $res = $mysqli->query("SELECT * FROM `record` WHERE `user_id`='$id' AND `date`='$date' ORDER BY `sl_no`");
    if ($mysqli->affected_rows) {
        while ($row = $res->fetch_assoc()) {
            $type = $row['entry_exit'];
        }
    } else {
        $type = "";
    }
    $res = $mysqli->query("SELECT * FROM `registry` WHERE `user_id`='$id'");
    if ($mysqli->affected_rows) {
        while ($row = $res->fetch_assoc()) {
            $name = $row['name'];
            $vehicle = $row['vehicle'];
            $number_plate = $row['number_plate'];
            $phone_number = $row['phone_number'];
            $driving_license = $row['dl_number'];
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
            <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

            <!-- Core CSS -->
            <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
            <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
            <link rel="stylesheet" href="../../assets/css/demo.css" />

            <!-- Vendors CSS -->
            <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

            <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />
            <script src="../../assets/vendor/js/helpers.js"></script>
            <script src="../../assets/js/config.js"></script>

        </head>

        <body>
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-lg-12 mb-9order-0">
                        <div class="card align-items-center">
                            <div class="d-flex row">
                                <div class="col-sm-12">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">
                                            WELCOME TO PARKING LOT MANAGEMENT SYSTEM OF NERIM COLLEGE
                                        </h5>
                                        <p class="mb-4">
                                            Please click enter vehicle for allocating a parking space or
                                            exit vehicle to remove from parking space.
                                        </p>
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $name; ?></h5>
                                            <p class="card-text">Vehicle type: <?php echo $vehicle . " Wheeler"; ?>
                                                <br>Number Plate: <?php echo $number_plate; ?>
                                                <br>Phone number: <?php echo $phone_number; ?>
                                                <br>Driving License: <?php echo $driving_license; ?>
                                            <form method="post">
                                                <input type="hidden" name="vehicle" value="<?php echo $vehicle; ?>">
                                                <button type="submit" name="entry" <?php echo $type != '' ? $type == 'entry' ? "disabled" : "" : ""; ?> class="btn btn-md btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Enter vehicle
                                                </button>
                                                <button type="submit" name="exit" <?php echo $type != '' ? $type == 'exit' ? "disabled" : "" : ""; ?> class="btn btn-md btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Exit vehicle
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="container mt-5 text-center">
                <h3 class="display-4">No data found...</h3>
            </div>
    <?php }
} else {
    include "gatekeeperdashboard.php";
} ?>

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
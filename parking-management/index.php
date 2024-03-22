<?php

include "include/includes.php";

session_start();
if (!isset($_SESSION['admin'])) {
  header("location:logout.php");
}

$mssg = "";
if (isset($_POST['add'])) {
  extract($_POST);
  $name = $mysqli->real_escape_string($name);
  $vehicle = $mysqli->real_escape_string($vehicle);
  $number_plate = $mysqli->real_escape_string($number_plate);
  $phone_number = $mysqli->real_escape_string($phone_number);
  $dl_number = $mysqli->real_escape_string($dl_number);

  $check = $mysqli->query("SELECT * FROM `registry` WHERE `dl_number`='$dl_number' OR `number_plate`='$number_plate'");
  if (!$mysqli->affected_rows) {
    $mysqli->query("INSERT INTO `registry`(`name`, `vehicle`, `number_plate`, `phone_number`, `dl_number`) VALUES ('$name','$vehicle','$number_plate','$phone_number','$dl_number')");
    header("refresh:0");
  } else {
    $mssg = "That registration already exists";
  }
}
if (isset($_POST['update'])) {
  extract($_POST);
  $name = $mysqli->real_escape_string($name);
  $vehicle = $mysqli->real_escape_string($vehicle);
  $number_plate = $mysqli->real_escape_string($number_plate);
  $phone_number = $mysqli->real_escape_string($phone_number);
  $dl_number = $mysqli->real_escape_string($dl_number);
  $check = $mysqli->query("SELECT * FROM `registry` WHERE `dl_number`='$dl_number' OR `number_plate`='$number_plate'");
  if (!$mysqli->affected_rows) {
    $mysqli->query("UPDATE `registry` SET `name`='$name',`vehicle`='$vehicle',`number_plate`='$number_plate',`phone_number`='$phone_number',`dl_number`='$dl_number' WHERE `user_id`='$update'");
    echo $mysqli->error;
    header("refresh:0");
  } else {
    $mssg = "That registration already exists";
  }
}

if (isset($_POST['del'])) {
  extract($_POST);
  $mysqli->query("DELETE FROM `registry` WHERE `user_id`='$del'");
  header("refresh:0");
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Parking lot management system</title>

  <meta name="description" content="" />


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
          <a href="index.php" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder">Nerim College</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Admin dashboards</span>
          </li>
          <li class="menu-item active">
            <a href="index.php" class="menu-link menu-toggle">
              <i class='menu-icon tf-icons bx bxs-user-detail'></i>
              <div data-i18n="Analytics">Client registration</div>
            </a>
          </li>
          <li class="menu-item ">
            <a href="gatekeeperregistration.php" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bxs-id-card"></i>
              <div data-i18n="Analytics">Gatekeeper registration</div>
            </a>
          </li>
          <li class="menu-item ">
            <a href="recordsdashboard.php" class="menu-link menu-toggle">
              <i class='menu-icon tf-icons bx bxs-data'></i>
              <div data-i18n="Analytics">Records</div>
            </a>
          </li>


          <!-- Layouts -->

          
          <li class="menu-item">
            <a href="logout.php" class="menu-link ">
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
                <div class="card">
                  <div class="d-flex align-items-end row">
                    <div class="col-sm-10">
                      <div class="card-body">
                        <h5 class="card-title text-primary">WELCOME TO PARKING LOT MANAGEMENT SYSTEM CLIENT REGISTRATION DASHBOARD</h5>
                        <p class="mb-4">
                          Please click the client registration button to register your vehicle credential details for allocating a parking space.
                        </p>


                        <button type="button" class="btn btn-md btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          <i class='menu-icon tf-icons bx bxs-user-detail'></i>
                          Client registration
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <form method="post" enctype="multipart/form-data">
                                <div class="modal-header">
                                  <h5 class="modal-title text-primary" id="exampleModalLabel">Please register your vehicle credentials</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Owner name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Owner Name" required>
                                  </div>
                                  <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Vehicle Type</label>
                                    <select name="vehicle" class="form-control" required>
                                      <option value="">Select type</option>
                                      <option value="4">4 Wheeler</option>
                                      <option value="2">2 Wheeler</option>
                                    </select>
                                  </div>
                                  <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Number Plate / RC</label>
                                    <input type="text" class="form-control" name="number_plate" placeholder="Number Plate" required>
                                  </div>
                                  <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                                    <input type="number" class="form-control" name="phone_number" placeholder="Phone Number" required>
                                  </div>
                                  <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Driving License</label>
                                    <input type="text" class="form-control" name="dl_number" placeholder="Driving License" required>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-md btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" name="add" class="btn btn-md btn-outline-primary">Save changes</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <?php echo "<p style='color:red;'>" . $mssg . "</p>"; ?>
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
                              <h5 class="card-title text-primary">CLIENT DETAILS</h5>
                              <p class="mb-4">
                                Please generate a unique QR code for a single client.
                              </p>
                              <div class="container">
                                <div class="row">
                                  <div class="col-lg-1"></div>
                                  <div class="table-responsive ">
                                    <table class="table table-striped">
                                      <thead class="table">
                                        <tr>
                                          <th scope="col">Sl no</th>
                                          <th scope="col">Owner Name</th>
                                          <th scope="col">Vehicle</th>
                                          <th scope="col">Number Plate</th>
                                          <th scope="col">Phone Number</th>
                                          <th scope="col">Driving License</th>
                                          <th scope="col">Edit</th>
                                          <th scope="col">Delete</th>
                                          <th scope="col">QR Code</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php


                                        $res = $mysqli->query("SELECT * FROM `registry`");
                                        $x = 1;
                                        while ($rows = $res->fetch_assoc()) {
                                        ?>
                                          <tr>
                                            <th scope="row"><?php echo $x++; ?></th>
                                            <td><?php echo $rows['name'] ?></td>
                                            <td><?php echo $rows['vehicle'] ?> Wheeler</td>
                                            <td><?php echo $rows['number_plate'] ?></td>
                                            <td><?php echo $rows['phone_number'] ?></td>
                                            <td><?php echo $rows['dl_number'] ?></td>
                                            <td>
                                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-<?php echo $rows['user_id']; ?>">
                                                <i class="bx bxs-edit"></i>
                                              </button>

                                              <!-- Modal -->
                                              <div class="modal fade" id="exampleModal-<?php echo $rows['user_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <form method="post" enctype="multipart/form-data">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $rows['name']; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <div class="mb-3">
                                                          <label for="exampleInputEmail1" class="form-label">Owner name</label>
                                                          <input type="text" class="form-control" value="<?php echo $rows['name']; ?>" name="name" placeholder="Owner Name" required>
                                                        </div>
                                                        <div class="mb-3">
                                                          <label for="exampleInputEmail1" class="form-label">Vehicle Type</label>
                                                          <select name="vehicle" class="form-control" value="<?php echo $rows['vehicle']; ?>" required>
                                                            <option value="">Select type</option>
                                                            <option value="4">4 Wheeler</option>
                                                            <option value="2">2 Wheeler</option>
                                                          </select>
                                                        </div>
                                                        <div class="mb-3">
                                                          <label for="exampleInputEmail1" class="form-label">Number Plate / RC</label>
                                                          <input type="text" class="form-control" value="<?php echo $rows['number_plate']; ?>" name="number_plate" placeholder="Number Plate" required>
                                                        </div>
                                                        <div class="mb-3">
                                                          <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                                                          <input type="number" class="form-control" value="<?php echo $rows['phone_number']; ?>" name="phone_number" placeholder="Phone Number" required>
                                                        </div>
                                                        <div class="mb-3">
                                                          <label for="exampleInputEmail1" class="form-label">Driving License</label>
                                                          <input type="text" class="form-control" value="<?php echo $rows['dl_number']; ?>" name="dl_number" placeholder="Driving License" required>
                                                        </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-md btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name="update" value="<?php echo $rows['user_id']; ?>" class="btn btn-md btn-outline-primary">Save changes</button>
                                                      </div>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </td>
                                            <td>
                                              <form method="POST">
                                                <button type="submit" value="<?php echo $rows['user_id']; ?>" class="btn btn-danger" name="del"><i class="bx bxs-trash"></i></button>
                                              </form>
                                            </td>
                                            <td>
                                              <button type="button" onclick="getQr(<?php echo $rows['user_id']; ?>)" class="btn btn-md btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModalg-<?php echo $rows['user_id']; ?>">
                                                Generate
                                              </button>

                                              <!-- Modal -->
                                              <div class="modal fade" id="exampleModalg-<?php echo $rows['user_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">QR Code</h5>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                      <img src="" id="image-<?php echo $rows['user_id']; ?>">
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>

                                            </td>
                                          </tr>
                                        <?php } ?>
                                      </tbody>
                                    </table>
                                  </div>
                                  <div class="col-lg-1"></div>
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

          <!-- Qr code api -->
          <script>
            async function getQr(id) {
              const response = await fetch('http://172.20.10.2:3001/generate/' + id)
              const result = await response.json()
              // const placeholder = document.getElementById('here-' + id)
              const image = document.getElementById('image-' + id)
              image.src = result
              // placeholder.innerHTML = result
            }
          </script>

          <!-- build:js assets/vendor/js/core.js -->
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
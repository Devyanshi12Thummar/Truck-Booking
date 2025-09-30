<?php
session_start();
require('connection.php');
$bookingid = $_GET["id"];

if (isset($_POST['btnsubmit'])) {

  $driver_id = $_POST["selectedDriver"];



  $sqli = "INSERT INTO assign_driver ( order_id,driver_id, booking_id,order_status) VALUES (`order_id`,'$driver_id', '$bookingid','0')";
  $res = mysqli_query($conn, $sqli);
  if ($res) {
    header("location:booking_request.php");
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
// if (!isset($_SESSION['managerfullname'])) {
//   // header("Location: Adminlogin.php");,
//   die();
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <style>
    /* Define the normal state styles */
    .custom-button {
      background-color: green;
      /* Set the background color to green */
      color: white;
      /* Set the text color to white */
      border: none;
      /* Remove the default button border */
      padding: 5px 15px;
      cursor: pointer;
      /* Change cursor to pointer on hover */
      transition: background-color 0.3s ease;
      /* Add a smooth transition effect for background-color */
    }

    /* Define the hover state styles */
    .custom-button:hover {
      background-color: darkgreen;
      /* Change the background color on hover */
    }

    .custom-buttonback {
      background-color: blue;
      /* Set the background color to green */
      color: white;
      /* Set the text color to white */
      border: none;
      /* Remove the default button border */
      padding: 5px 15px;
      cursor: pointer;
      /* Change cursor to pointer on hover */
      transition: background-color 0.3s ease;
      /* Add a smooth transition effect for background-color */
    }

    /* Define the hover state styles */
    .custom-buttonback:hover {
      background-color: blue;
      /* Change the background color on hover */
    }
  </style>


</head>

<body>
  <!-- <div class="container-scroller"> -->

  <!-- partial:partials/_navbar.html -->
  <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
      <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
        <a class="navbar-brand brand-logo" href="index.html">TBTS</a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo" /></a>
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-sort-variant"></span>
        </button>
      </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <ul class="navbar-nav mr-lg-4 w-100">
        <li class="nav-item nav-search d-none d-lg-block w-100">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="search">
                <i class="mdi mdi-magnify"></i>
              </span>
            </div>
            <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
          </div>
        </li>
      </ul>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown me-1">
          <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
            <i class="mdi mdi-message-text mx-0"></i>
            <span class="count"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="messageDropdown">
            <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
            <a class="dropdown-item">
              <div class="item-thumbnail">
                <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
              </div>
              <div class="item-content flex-grow">
                <h6 class="ellipsis font-weight-normal">David Grey
                </h6>
                <p class="font-weight-light small-text text-muted mb-0">
                  The meeting is cancelled
                </p>
              </div>
            </a>
            <a class="dropdown-item">
              <div class="item-thumbnail">
                <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
              </div>
              <div class="item-content flex-grow">
                <h6 class="ellipsis font-weight-normal">Tim Cook
                </h6>
                <p class="font-weight-light small-text text-muted mb-0">
                  New product launch
                </p>
              </div>
            </a>
            <a class="dropdown-item">
              <div class="item-thumbnail">
                <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
              </div>
              <div class="item-content flex-grow">
                <h6 class="ellipsis font-weight-normal"> Johnson
                </h6>
                <p class="font-weight-light small-text text-muted mb-0">
                  Upcoming board meeting
                </p>
              </div>
            </a>
          </div>
        </li>
        <?php
        $csql = "select count(*) count from truck_booking where assign_driver_status='0' and accept_order_status='0' and read_status='0' and DATE(booking_date)=DATE(NOW())";
        $cresult = mysqli_query($conn, $csql);
        $crow = mysqli_fetch_array($cresult);
        $_SESSION['count'] = $crow['count'];

        ?>
        <li class="nav-item dropdown me-4">
          <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
            <i class="mdi mdi-bell mx-0"></i>
            <?php
            if ($_SESSION['count'] > 0) {
            ?>
              <span class="count"></span>
            <?php
            }
            ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
            <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
            <!-- <a class="dropdown-item">
              <div class="item-thumbnail">
                <div class="item-icon bg-success">
                  <i class="mdi mdi-information mx-0"></i>
                </div>
              </div>
            </a> -->
            <?php
            if ($_SESSION['count'] > 0) {
            ?>

              <a class="dropdown-item" href="booking_request.php">
                <div class="item-thumbnail">
                  <div class="item-icon bg-warning">
                    <i class="mdi mdi-information mx-0"></i>
                    <!-- <i class="mdi mdi-settings mx-0"></i> -->
                  </div>
                </div>
                <div class="item-content" href="booking_request.php">
                  <h6 class="font-weight-normal">Notifications</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    <?php echo "new bookings <b>" . $_SESSION['count'] ?></b>
                  </p>
                </div>
              </a>
            <?php
            }
            ?>
            <!-- <a class="dropdown-item">
              <div class="item-thumbnail">
                <div class="item-icon bg-info">
                  <i class="mdi mdi-account-box mx-0"></i>
                </div>
              </div>
              <div class="item-content">
                <h6 class="font-weight-normal">New user registration</h6>
                <p class="font-weight-light small-text mb-0 text-muted">
                  2 days ago
                </p>
              </div>
            </a> -->
          </div>
        </li>
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
            <?php
            if (isset($_SESSION['gender'])) {

              if ($_SESSION['gender'] == "m") {
            ?>
                <img src="images/faces/face2.jpg" alt="profile" />
              <?php
              } else {
              ?>
                <img src="images/faces/face1.png" alt="profile" />
            <?php
              }
            }
            ?>
            <span class="nav-profile-name">
              <?php echo $_SESSION['managerfullname']; ?>
            </span>
          </a>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">

        <li class="nav-item">
          <a class="nav-link" href="Home.php">
            <i class="mdi mdi-home menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="driver_location.php">
            <i class="mdi mdi-google-maps menu-icon"></i>
            <span class="menu-title">Driver Loaction</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="booking_request.php">
            <i class="mdi mdi-book-open menu-icon"></i>
            <span class="menu-title">Booking</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Add_Driver.php">
            <i class="mdi mdi-car menu-icon"></i>
            <span class="menu-title">Add Driver</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="mdi mdi-book menu-icon"></i>
            <span class="menu-title">Booking Reports</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="Reports.php"> City Wise </a></li>
              <li class="nav-item"> <a class="nav-link" href="datewise.php">Date Wise</a></li>
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="Add_Truck.php">
            <i class="mdi mdi-truck menu-icon"></i>
            <span class="menu-title">Add Truck</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="View_Truck.php">
            <i class="mdi mdi-view-headline menu-icon"></i>
            <span class="menu-title">View Truck</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="show_driver.php">
            <i class="mdi mdi-account-multiple menu-icon"></i>
            <span class="menu-title">View Driver</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">

        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
              <div class="d-flex align-items-end flex-wrap">
                <div class="me-md-3 me-xl-5">
                  <h2>Online Drivers</h2>
                </div>

              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Assign Order to Driver</p>
                  <div class="table-responsive">
                    <form method='POST'>

                      <table id="recent-purchases-listing">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Driver Name</th>
                            <th>Driver email</th>
                            <th>Driver Contact</th>
                            <th>Driver City</th>
                            <th>Driver Licence No</th>
                            <th>Select one</th>
                            <!-- <th>Assign Driver</th> -->
                            <!-- <th>Reject</th> -->

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = "select * from truck_driver where driver_active_status='1'";
                          $result = mysqli_query($conn, $sql);
                          $i = 1;
                          while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $i . '</td>';
                            echo '<td>' . $row['driver_fullname'] . '</td>';
                            echo '<td>' . $row['driver_email'] . '</td>';
                            echo '<td>' . $row['driver_contactno_primary'] . '</td>';
                            echo '<td>' . $row['driver_city'] . '</td>';
                            echo '<td>' . $row['driver_license'] . '</td>';
                            $driver_id = $row['driver_id'];
                            // echo $driver_id;
                            echo '<td>';
                            echo '<center>';

                            echo "<input type='radio' name='selectedDriver' value='{$driver_id}'>";

                            echo '</center>';
                            echo '</td>';
                            $i++;
                            echo '</tr>';
                          }

                          ?>

                          <script src="js/jquery.cookie.js" type="text/javascript"></script>
                          <script>
                            setInterval(function() {
                              location.reload();
                            }, 10000);
                          </script>


                        </tbody>

                      </table>
                      <br>
                      <input type="submit" name='btnsubmit' value="Assign Driver" class="custom-button" style="margin-left: 00px;">
                      <!-- <input type="submit" name='btnsubmit' value="Assign Driver" class="custom-buttonback" style="margin-left: 00px;"> -->
                      <!-- <br> -->
                      <br>
                    </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">

        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/data-table.js"></script>
  <script src="js/jquery.dataTables.js"></script>
  <script src="js/dataTables.bootstrap4.js"></script>
  <!-- End custom js for this page-->

  <script src="js/jquery.cookie.js" type="text/javascript"></script>
</body>

</html>
<?Php




?>
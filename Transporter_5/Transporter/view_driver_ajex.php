<?php
session_start();
require('connection.php');
$bookingid = $_GET["id"];

if (isset($_POST['btnsubmit'])) {

  $driver_id = $_POST["selectedDriver"];

 

  $sqli="INSERT INTO assign_driver ( order_id,driver_id, booking_id,order_status) VALUES (`order_id`,'$driver_id', '$bookingid','0')";
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
                          <!-- <script>
                            setInterval(function() {
                              location.reload();
                            }, 5000);

                            
                          </script> -->


                        </tbody>

                      </table>
                      <input type="submit" name='btnsubmit' value="Assign Driver" class="custom-button" style="margin-left: 00px;">
                      <!-- <input type="submit" name='btnsubmit' value="Assign Driver" class="custom-buttonback" style="margin-left: 00px;"> -->

                    <br>
                    </form>

                  </div>
                 
        </div>
        
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>

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
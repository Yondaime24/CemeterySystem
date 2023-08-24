<?php 
  include('../functions/functions.php');

 $deceased_id = $_GET['deceased_id'];
 $reserve_id = $_GET['reserve_id'];
 $loc_id = $_GET['loc_id'];
 $user_id = $_GET['user_id'];

    if (!isLoggedIn()) {
      header('location: ../index.php');
    }

    if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}

    if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/images/logo.png">
    <link rel="icon" type="image/png" href="../assets/images/logo.png">

    <title>Cemetery System | Edit Reservation</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    <link href="css/badge.css" rel="stylesheet" media="all">

    <style>
      .error{
        color: red;
        font-style: italic;
      }
    </style>

</head>

<body class="animsition">
  <div class="page-wrapper">
              <div class="login-wrap">
                  <div class="login-content">
                      <div class="login-logo">
                        <a href="" style="pointer-events: none">
                          <img class="image" src="../assets/images/logo.png" width="50px">
                          <h4>Edit Deceased Details</h4>
                        </a>
                        <br>
                         <a href="deceasedGlosarry.php" class="btn btn-sm btn-primary">Return</a>
                      </div>

                    <div class="login-form">

     <?php
            $query=mysqli_query($db,"SELECT * FROM reservations WHERE reserve_id='".$reserve_id."'")or die(mysqli_error());
            while($row=mysqli_fetch_array($query)){
      ?>

    <form id="reservationForm" action="deceasedEdit.php" method="post">

            <center>
              <span><b>User Details</b></span>
            </center>

            <div class="form-group" hidden="hidden">
                <label for="userID" class="control-label mb-1">User ID</label>
                <input id="userID" name="user_id" type="text" class="form-control" value="<?php echo $_SESSION['user']['user_id']; ?>" readonly>
            </div>

             <div class="form-group" hidden="hidden">
                <label for="locId" class="control-label mb-1">Location ID</label>
                <input id="locId" name="loc_id" type="text" class="form-control" value="<?php echo $loc_id; ?>" readonly>
            </div>

            <div class="form-group">
              <label for="userID" class="control-label mb-1">Reserved By</label>
              <input id="userID" name="reserved_by" type="text" class="form-control" value="<?php echo $row['reserved_by']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="residentialAddress" class="control-label mb-1">Residential Address</label>
                <input id="residentialAddress" name="residential_address" type="text" class="form-control" value="<?php echo $row['residential_address']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="contactNumber" class="control-label mb-1">Contact Number</label>
                 <input name="contact_number" id="contactNumber" type="text" class="form-control" value="<?php echo $row['contact_number']; ?>" readonly="readonly">
            </div>

             <div class="form-group">
                <label for="inputNumber" class="control-label mb-1">Email Address</label>
                <input name="email_address" id="inputNumber" type="text" class="form-control" value="<?php echo $row['email_address']; ?>" readonly="readonly">
            </div>

             <center>
              <a href="viewUserProfile2.php?user_id=<?php echo $row['user_id']; ?>" class="btn btn-success btn-sm">View Profile</a>
            </center>
<?php } ?>
            <center>
              <span><b>Location</b></span>
            </center>

            <?php
                $query=mysqli_query($db,"SELECT * FROM location WHERE loc_id='".$loc_id."'")or die(mysqli_error());
                  while($row=mysqli_fetch_array($query)){
            ?>

            <div class="row">
              <div class="col-6">
                <div class="form-group">
                 <label for="inputBlock" class="control-label mb-1">Block</label>
                 <input name="block" id="inputBlock" type="text" class="form-control" value="<?php echo $row['block'];?>" readonly="readonly">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                 <label for="inputNumber" class="control-label mb-1">Number</label>
                 <input name="number" id="inputNumber" type="text" class="form-control" value="<?php echo $row['number'];?>" readonly="readonly">
                </div>
              </div>
             </div>

          <?php }?>

          <?php
            $query=mysqli_query($db,"SELECT * FROM deceased_details WHERE deceased_id='".$deceased_id."'")or die(mysqli_error());
            while($row=mysqli_fetch_array($query)){
          ?>

            <center>
              <span><b>Edit Deceased Details</b></span>
            </center>

             <div class="form-group validate" hidden="">
                <label for="reserveID" class="control-label mb-1">Deceased ID</label>
                <input id="reserveID" name="deceased_id" type="text" class="form-control" value="<?php echo $row['deceased_id'];?>">
            </div>

                          
            <div class="form-group validate">
                <label for="inputName" class="control-label mb-1">Deceased Name</label>
                <input id="inputName" name="full_name" type="text" class="form-control" value="<?php echo $row['full_name'];?>">
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group validate">
                 <label for="inputAge" class="control-label mb-1">Age</label>
                 <input name="age" id="inputAge" type="text" class="form-control" value="<?php echo $row['age'];?>">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group validate">
                  <label for="inputGender" class="control-label mb-1">Select Gender</label>
                <div class="form-check-inline form-check"> 
                    <label for="inline-radio2" class="form-check-label ">                          
                    <input type="radio" id="inline-radio2" name="gender" value="Male" class="form-check-input"
                     <?php  
                          if ($row['gender'] == 'Male') {
                            echo "checked";
                          }
                      ?>
                    >Male</label>

                    <label for="inline-radio2" class="form-check-label ">
                    <input type="radio" id="inline-radio2" name="gender" value="Female" class="form-check-input" style="margin-left: 40px;"
                        <?php  
                          if ($row['gender'] == 'Female') {
                            echo "checked";
                          }
                        ?>
                    >Female</label>
                 </div>
                </div>
              </div>
             </div>
            <div class="row">
              <div class="col-6">
              <div class="form-group validate">
                <label for="inputBirth" class="control-label mb-1">Select Date of Birth</label>
                 <input type="date" value="<?php echo strftime('%Y-%m-%d', strtotime($row['date_of_birth'])); ?>" name="date_of_birth" id="inputBirth" class="form-control">
              </div>
              </div>
              <div class="col-6">
              <div class="form-group validate">
                <label for="inputDeath" class="control-label mb-1">Select Date of Death</label>
                <input id="inputDeath" name="date_of_death" type="date" class="form-control" value="<?php echo strftime('%Y-%m-%d', strtotime($row['date_of_death'])); ?>">
              </div>
              </div>
             </div>

             <div class="form-group validate">
                <label for="inputBurial" class="control-label mb-1">Select Date Buried</label>
                <input id="inputBurial" name="date_buried" type="date" class="form-control" value="<?php echo strftime('%Y-%m-%d', strtotime($row['date_buried'])); ?>">
            </div>

            <?php }?>

              <div>
                <button  class="btn btn-primary btn-block" type="submit" name="updateDeceased">Update</button>
              </div>
              <div style="margin-top: 10px;">
                <a class="btn btn-block btn-secondary" href="deceasedGlosarry.php">Cancel</a>
              </div>
                </form>
                  </div>
              </div>
            <!-- END STATISTIC-->
            <footer class="sticky-footer" style="height: 20px;">
              <div class="container my-auto">
                <div class="copyright text-center my-auto">
                  <p>Copyright © 2021 Cemetery System. All rights reserved.</p>
                </div>
              </div>
            </footer>
            <!-- END PAGE CONTAINER-->
        </div> 

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
     <!-- validators -->
    <script src="../assets/vendor/jquery/jquery.validator.js"></script>
    <script src="../assets/vendor/jquery/additional-methods.min.js"></script>
    <!-- !validators -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery/formreservation2.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>
    <script src="vendor/vector-map/jquery.vmap.js"></script>
    <script src="vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="vendor/vector-map/jquery.vmap.world.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->

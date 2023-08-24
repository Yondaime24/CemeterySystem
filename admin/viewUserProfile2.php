<?php 
  include('../functions/functions.php');

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

    <title>Cemetery System | User Profile</title>

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
                          <h4>Cemetery System</h4>
                        </a>
                        <br>
                         <a href="deceasedGlosarry.php" class="btn btn-sm btn-primary">Return</a>
                      </div>

                    <div class="login-form">

    <form id="reservationForm" action="reservationForm.php" method="post">

            <center>
              <span><b>User Profile</b></span>

          <?php
            $query=mysqli_query($db,"SELECT * FROM users WHERE user_id='".$user_id."'")or die(mysqli_error());
            while($row=mysqli_fetch_array($query)){
          ?>
            
            <div class="image img-cir img-120">
                <?php if($row['photo'] != ""): ?>
                    <img src="../assets/images/<?php echo $row['photo'];?>"/>
                <?php else: ?>
                    <img src="../assets/images/profile.png"/>
                <?php endif; ?>
            </div> 
          

             <div class="form-group">
                <label for="locId" class="control-label mb-1"><u> Name </u></label>
                <span style="color: black"><?php echo $row['fname'];?> <?php echo $row['mname'];?> <?php echo $row['lname'];?></span>
             </div>

             <div class="row">
              <div class="col-6">
                <div class="form-group">
                <label for="locId" class="control-label mb-1"><u> Birthday </u></label>
                <span style="color: black"><?php echo date('F j, Y',strtotime($row['birthday'])) ?></span>
              </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                <label for="locId" class="control-label mb-1"><u> Gender </u></label>
                <span style="color: black"><?php echo $row['gender'];?></span>
                </div>
              </div>
             </div>

              <div class="form-group">
                <label for="locId" class="control-label mb-1"><u> Age </u></label>
                <span style="color: black"><?php echo $row['age'];?></span>
              </div>

              <div class="form-group">
                <label for="locId" class="control-label mb-1"><u> Residential Address </u></label>
                <span style="color: black"><?php echo $row['residential_address'];?></span>
              </div>

              <div class="form-group">
                <label for="locId" class="control-label mb-1"><u> Contact Number </u></label>
                <span style="color: black"><?php echo $row['contact_number'];?></span>
              </div>

              <div class="form-group">
                <label for="locId" class="control-label mb-1"><u> Email Address </u></label>
                <span style="color: black"><?php echo $row['email_address'];?></span>
              </div>

              <div class="form-group">
                <label for="locId" class="control-label mb-1"><u> Date Registered </u></label>
                <span style="color: black"><?php echo date('F j, Y',strtotime($row['date_registered'])) ?></span>
              </div>

               <div class="form-group">
                <label for="locId" class="control-label mb-1"><u> User Type </u></label>
                <?php  
                $userType = $row['user_type'];
                if ($row['user_type']=='user') {
                  echo "<span style=\"color: #3498db;\">$userType</span>";
                }else{
                  echo " <span style=\"color: #2ecc71;\">$userType</span>";
                }
                ?>
          
              </div>

             </center>

              <?php  
                $userType = $row['user_type'];
                if ($row['user_type']=='user') {
                  echo "  <a href=\"sendUserMessage.php?user_id=$row[user_id]\" class=\"btn btn-block btn-success\">Send Message</a>";
                }else{
                 echo "";
                }
                ?>

              <?php }?>

                </form>
                  </div>
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

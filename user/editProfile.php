<?php 
  include('../functions/functions.php');

    if (!isLoggedIn()) {
      header('location: ../index.php');
    }
    
    if (!isUser()) {
        $_SESSION['msg'] = "You must log in first";
        header('location: ../index.php');
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

    <title>Cemetery System | Edit Profile</title>

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
                         <a href="myProfile.php" class="btn btn-sm btn-primary">Return</a>
                      </div>

                    <div class="login-form">

      <form id="register" method="post" action="editProfile.php" enctype="multipart/form-data">

            <center>
              <span><b>Edit Profile</b></span>
            </center>

            <div class="form-group validate" hidden>
              <div class="form-label-group">
                <label for="user_id">User ID</label>
                <input type="text" id="user_id" class="form-control" value="<?php echo $_SESSION['user']['user_id']?>" name="user_id">
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" class="form-control" value="<?php echo $_SESSION['user']['fname']?>" autofocus="autofocus" name="fname"> 
                  </div>
                </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <label for="middleName">Middle Name</label>
                    <input type="text" id="middleName" class="form-control" value="<?php echo $_SESSION['user']['mname']?>" name="mname">
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                     <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" class="form-control" value="<?php echo $_SESSION['user']['lname']?>" autofocus="autofocus" name="lname"> 
                  </div>
                </div>
                <div class="col-md-6 validate">
                   <label for="age">Select Age</label>
                    <select class="form-control" name="age" id="age" autofocus="autofocus" style="cursor: pointer;">
                      <option><?php echo $_SESSION['user']['age']; ?></option>
                      <?php
                        for($x=18; $x <= 100; $x++)
                        {
                          ?>
                          <option><?php echo $x; ?></option>
                          <?php
                        }
                      ?>
                    </select>&nbsp; &nbsp; 
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <label for="birthday">Birthday</label>
                    <input type="date" id="birthday" class="form-control" value="<?php echo $_SESSION['user']['birthday']?>" autofocus="autofocus" name="birthday"> 
                  </div>
                </div>
                <div class="col-sm-6 validate">
                  <label for="input-type">Select Gender:</label>
                  <div id="input-type" class="row">
                    <div class="col-sm-6">
                      <label class="radio-inline">
                        <input type="radio" name="gender" value="Male"
                        <?php  

                          if ($_SESSION['user']['gender'] == 'Male') {
                            echo "checked";
                          }

                        ?>
                        > Male
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <label class="radio-inline">
                        <input type="radio" name="gender" value="Female"
                        <?php  

                          if ($_SESSION['user']['gender'] == 'Female') {
                            echo "checked";
                          }

                        ?>
                        > Female
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group validate">
              <div class="form-label-group">
                <label for="inputAddress">Residential address</label>
                <input type="text" id="inputAddress" class="form-control" value="<?php echo $_SESSION['user']['residential_address']?>" name="residential_address">
              </div>
            </div>

             <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <label for="emailAddress">Email Address</label>
                    <input type="email" id="emailAddress" class="form-control" value="<?php echo $_SESSION['user']['email_address']?>" autofocus="autofocus" name="email_address"> 
                  </div>
                </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <label for="contactNumber">Contact Number</label>
                    <input type="text" id="contactNumber" class="form-control" value="<?php echo $_SESSION['user']['contact_number']?>" name="contact_number">
                  </div>
                </div>
              </div>
            </div>

              <div>
                <button  class="btn btn-primary btn-block" type="submit" name="editProfile">Update</button>
              </div>
              <div style="margin-top: 10px;">
                <a class="btn btn-block btn-secondary" href="userHome.php">Cancel</a>
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
    <script src="../assets/vendor/jquery/register3.js"></script>
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

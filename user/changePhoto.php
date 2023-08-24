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

    <title>Cemetery System | Change Photo</title>

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
      img{
        cursor: pointer;
      }
      #profileLabel{
        cursor: pointer;
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
                         <a href="userHome.php" class="btn btn-sm btn-primary">Return</a>
                      </div>

                    <div class="login-form">

      <form id="register" method="post" action="changePhoto.php" enctype="multipart/form-data">

            <center>
              <span><b>Change Photo</b></span>
            </center>

            <div class="form-group validate" hidden="">
              <div class="form-label-group">
                <label for="inputAddress">Residential address</label>
                <input type="text" id="inputAddress" class="form-control" value="<?php echo $_SESSION['user']['user_id']?>" name="user_id">
              </div>
            </div>

      <center><div class="input-box">
            <?php
              $user_id=$_SESSION['user']['user_id'];
              $query = "SELECT * FROM users WHERE user_id='$user_id'";
              $result = mysqli_query($db,$query);
              while($res = mysqli_fetch_array($result)) {  
            ?>
              <?php if($res['photo'] != ""): ?>
                  <img src="../assets/images/<?php echo $_SESSION['user']['photo']; ?>" onclick="triggerClick()" id="profileDisplay"/>
                  <label id="profileLabel" for="profileImage">Click to Change Picture</label>
                  <input type="file" name="photo" onchange="displayImage(this)" id="profileImage" style="display: none;">
              <?php else: ?>
              <img src="../assets/images/profile.png" onclick="triggerClick()" id="profileDisplay">
              <label id="profileLabel" for="profileImage">Click to Change Picture</label>
              <input type="file" name="photo" onchange="displayImage(this)" id="profileImage" style="display: none;">
              <?php endif; ?>
            <?php
            }
            ?>
       </div></center>

              <div>
                <button  class="btn btn-primary btn-block" type="submit" name="updatePhoto">Update</button>
              </div>
              <div style="margin-top: 10px;">
                <a class="btn btn-block btn-secondary" href="userHome.php">Cancel</a>
              </div>

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

<script>   
  function triggerClick(){
  document.querySelector('#profileImage').click();

}

function displayImage(e) {
  if (e.files[0]){
    var reader = new FileReader();

    reader.onload = function(e) {
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
 </script>

</body>

</html>
<!-- end document-->

<?php 
  include('functions/functions.php');

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

    <title>Cemetery System | Add User</title>

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
      .eye1{
        color: #3498db;
        position: absolute;
        top: 45px;
        right: 10px;
        cursor: pointer;
      }
      .eye1:hover{
        color: #2ecc71;
      }
      .eye2{
        color: #3498db;
        position: absolute;
        top: 45px;
        right: 10px;
        cursor: pointer;
      }
       .eye2:hover{
        color: #2ecc71;
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
                         <a href="adminPanel.php" class="btn btn-sm btn-primary">Return</a>
                      </div>

                    <div class="login-form">

      <form id="register" method="post" action="addUser.php" enctype="multipart/form-data">

            <center>
              <span><b>Add User</b></span>
            </center>

            <div class="form-group">
            <div class="col-md-6 validate">
                  <label for="user_type" style="visibility: hidden;">Select Age</label>
                    <select class="form-control" name="user_type" id="user_type" autofocus="autofocus" style="cursor: pointer;">
                     <option value="" disabled selected>Select User Type</option>
                     <option value="admin">Admin</option>
                     <option value="user">User</option>
                    </select>&nbsp; &nbsp; 
                </div>
              </div>


            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <label for="firstName">First Name</label>
                    <input type="text" id="firstName" class="form-control" placeholder="Enter First Name" autofocus="autofocus" name="fname"> 
                  </div>
                </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <label for="middleName">Middle Name</label>
                    <input type="text" id="middleName" autofocus="autofocus" class="form-control" placeholder="Enter Middle Name" name="mname">
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                     <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" class="form-control" placeholder="Enter Last Name" autofocus="autofocus" name="lname"> 
                  </div>
                </div>
                 <div class="col-md-6 validate">
                  <label for="age" style="visibility: hidden;">Select Age</label>
                    <select class="form-control" name="age" id="age" autofocus="autofocus" style="cursor: pointer;">
                      <option value="" disabled selected>Select Age</option>
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
                    <label for="birthday">Enter Birthday</label>
                    <input type="date" id="birthday" class="form-control" placeholder="Birthday" autofocus="autofocus" name="birthday"> 
                  </div>
                </div>
                <div class="col-sm-6 validate">
                  <label for="input-type">Select Gender:</label>
                  <div id="input-type" class="row">
                    <div class="col-sm-6">
                      <label class="radio-inline" style="margin-left: 20px;">
                        <input type="radio" name="gender" value="Male"> Male
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <label class="radio-inline">
                        <input type="radio" name="gender" value="Female"> Female
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group validate">
              <div class="form-label-group">
                <label for="inputAddress">Residential address</label>
                <input type="text" id="inputAddress" class="form-control" placeholder="Enter Residential Address" name="residential_address">
              </div>
            </div>

             <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <label for="emailAddress">Email Address</label>
                    <input type="email" id="emailAddress" class="form-control" placeholder="Enter Email Address" autofocus="autofocus" name="email_address"> 
                  </div>
                </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <label for="contactNumber">Contact Number</label>
                    <input type="text" id="contactNumber" class="form-control" placeholder="Enter Contact Number" name="contact_number">
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                <div class="form-label-group">
                 <label for="passWord">Enter Password</label>
                 <input type="password" id="passWord" class="form-control" placeholder="Password" name="password">
                  <div class="input-group-append">
                      <span><i class="fas fa-eye eye1" id="eye" onclick="toggle1()"></i></span>
                  </div>
                </div>
               </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <label for="username">Enter Username</label>
                    <input type="text" id="username" class="form-control" placeholder="Username" autofocus="autofocus" name="username"> 
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group" style="margin-bottom: 30px;">
              <div class="form-row">
                <div class="col-md-6 validate">
                   <div class="form-label-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                  <div class="input-group-append">
                     <span><i class="fas fa-eye eye2" id="eye2" onclick="toggle2()"></i></span>
                  </div>
                  </div>
                </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group text-center">
                    <img style="margin-top: 40px; border-radius: 50px; cursor: pointer;" width="150" src="../assets/images/profile.png" onclick="triggerClick()" id="profileDisplay" />
                    <label id="profileLabel" for="profileImage" style="cursor: pointer;">Profile Picture</label>
                    <input type="file" name="photo" onchange="displayImage(this)" id="profileImage" style="display: none;">
                  </div>
                </div>
              </div>
            </div>

              <div>
                <button  class="btn btn-primary btn-block" type="submit" name="adminAddUser">Add</button>
              </div>
              <div style="margin-top: 10px;">
                <a class="btn btn-block btn-secondary" href="adminPanel.php">Cancel</a>
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
    <script src="../assets/vendor/jquery/adduser.js"></script>
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

    <script>   
      function triggerClick2(){
      document.querySelector('#profileImage2').click();

    }

    function displayImage2(e) {
      if (e.files[0]){
        var reader = new FileReader();

        reader.onload = function(e) {
          document.querySelector('#profileDisplay2').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
      }
    }
     </script>

  <script>
    var state=false;
    function toggle1(){
      if (state) {
        document.getElementById("passWord").setAttribute("type","password");
        document.getElementById("eye").style.color='#3498db';
        state = false;
      }else{
        document.getElementById("passWord").setAttribute("type","text");
        document.getElementById("eye").style.color='#2ecc71';
        state = true;
      }
    }
  </script>

    <script>
    var state=false;
    function toggleModal1(){
      if (state) {
        document.getElementById("passWord2").setAttribute("type","password");
        document.getElementById("regEye").style.color='#3498db';
        state = false;
      }else{
        document.getElementById("passWord2").setAttribute("type","text");
        document.getElementById("regEye").style.color='#2ecc71';
        state = true;
      }
    }
  </script>

  <script>
    var state2=false;
    function toggle2(){
      if (state2) {
        document.getElementById("confirm_password").setAttribute("type","password");
        document.getElementById("eye2").style.color='#3498db';
        state2 = false;
      }else{
        document.getElementById("confirm_password").setAttribute("type","text");
        document.getElementById("eye2").style.color='#2ecc71';
        state2 = true;
      }
    }
  </script>

    <script>
    var state2=false;
    function toggleModal2(){
      if (state2) {
        document.getElementById("confirm_password2").setAttribute("type","password");
        document.getElementById("regEye2").style.color='#3498db';
        state2 = false;
      }else{
        document.getElementById("confirm_password2").setAttribute("type","text");
        document.getElementById("regEye2").style.color='#2ecc71';
        state2 = true;
      }
    }
  </script>


</body>

</html>
<!-- end document-->

<?php 
  include('functions/functions.php');

  if (isset($_POST['contact_btn'])) {

  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $contact_number = $_POST['contact_number'];
  $message = $_POST['message'];

  $query = "INSERT INTO `contact_us`(`fullname`, `email`, `contact_number`, `message`) VALUES ('$fullname','$email','$contact_number','$message')";

  $result = mysqli_query($db, $query);

  if ($result) {

    echo "<script>alert('Your message has been sent!')</script>";
    echo "<script>window.open('index.php','_self')</script>";
    
  }else{

  }

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
    <link rel="apple-touch-icon" sizes="76x76" href="assets/images/logo.png">
    <link rel="icon" type="image/png" href="assets/images/logo.png">

     <title>Cemetery System</title>

    <!-- Bootstrap core CSS-->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/contact5.css">
    <link rel="stylesheet" type="text/css" href="assets/css/search.css">
    <link rel="stylesheet" type="text/css" href="assets/css/eye3.css">

    <style>
      .error{
        color: red;
        font-style: italic;
      }
    </style>

  </head>

  <body id="page-top" style="background: url(assets/images/bg.jpg);  background-repeat: no-repeat; background-size: cover;">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

        <a class="navbar-brand mr-1" href="index.php">Cemetery System</a>
      
     <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" style="visibility: hidden;">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

     <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item no-arrow mx-1">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Login</a>
        </li>
         <li class="nav-item no-arrow mx-1">
          <a class="nav-link scroll" href="#table">
            Glosarry
          </a>
        </li>
        <li class="nav-item no-arrow mx-1">
          <a class="nav-link scroll" href="#contact">
            Contact Us
          </a>
        </li>
        <li class="nav-item no-arrow mx-1">
          <a class="nav-link scroll" href="#about">
            About Us
          </a>
        </li>
      </ul>

    </nav>

    <div id="wrapper">
     
      <div id="content-wrapper">

    <section class="search">
      <center>
         <?php echo display_error(); ?>
            <form style="margin-top: 120px; width: 50%; height: 60px;" id="searchbox" method="post">
              <div class="box">
              <div class="input-group">
                <input style="height: 50px" type="text" name="search" class="form-control box" placeholder="Enter Full Name To Search Location..." aria-label="Search" aria-describedby="basic-addon2" >
                <div class="input-group-append">
                  <button style="width: 50px" class="btn btn-primary" type="submit" name="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
              </div>
            </form>
          <p class="lead" style="margin-top: 20px;">
            <a href="#" class="btn btn-outline-secondary fw-bold bg-black" data-toggle="modal" data-target="#registerModal">Add Reservation</a>
          </p>
      </center>

  <?php 
      
    $con = new PDO("mysql:host=localhost;dbname=cemetery_system",'root','');

    if (isset($_POST["submit"])) {
      $str = $_POST["search"];
      $sth = $con->prepare("SELECT * FROM `deceased_details` WHERE full_name = '$str'");

      $sth->setFetchMode(PDO:: FETCH_OBJ);
      $sth -> execute();

      if($row = $sth->fetch())
      {
        ?>

     
        <center>
          <span>Name</span>
          <br>
          <h2><u><?php echo $row->full_name; ?></u></h2>
          <br>
          <h2><?php echo date('F j, Y',strtotime($row->date_of_birth)); ?> - <?php echo date('F j, Y',strtotime($row->date_of_death)); ?></h2>
          <br>
          <span>Located at</span>
          <h2>Block <u><?php echo $row->block;?></u> Number <u><?php echo $row->number;?></u></h2>
        </center>


    <?php 
      }
        
        else{
          echo "<center><h3 style=\"background: red; color: white; width: 300px; margin-top: 80px;\"> Name Does Not Exist! </h3></center>";
        }

    }

  ?>
           
    </section>

    <section class="search" id="table">
      <div class="container-fluid" style="background: transparent;">
      <div class="card mb-3" style="background: transparent;">
            <div class="card-header" style="background: transparent;">
              <i class="fas fa-book"></i>
              Funeral Glosarry</div>
            <div class="card-body" style="background: transparent;">
              <div class="table-responsive" style="background: transparent;">
                <?php
                                     
                  $query = "SELECT * FROM deceased_details";
                  $result = mysqli_query($db,$query);
                
                ?>  
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="background: transparent;">
                  <thead>
                    <tr>
                      <th>Full Name</th>
                      <th>Date of Birth</th>
                      <th>Date of Death</th>
                      <th>Date Buried</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Full Name</th>
                      <th>Date of Birth</th>
                      <th>Date of Death</th>
                      <th>Date Buried</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    if($result){
                      while($res = mysqli_fetch_array($result)) {     
                        echo "<tr>";
                          echo "<td>".$res['full_name']."</td>";
                          echo "<td>".date('F j, Y',strtotime($res['date_of_birth']))."</td>";
                          echo "<td>".date('F j, Y',strtotime($res['date_of_death']))."</td>";  
                          echo "<td>".date('F j, Y',strtotime($res['date_buried']))."</td>";   
                         echo "</tr>";                                   
                      }
                    }?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
      </div>
    </section>


     <section class="contact" id="contact">
           <!--  <div class="content" style="position: absolute; top: 20px;">
              <a style="font-size: 40px; color: #000">Contact Us</a>
              <p style="color: #000">Cemetery Mapping & Info System</p>
            </div> -->
            <div class="container" >
              <div class="contactInfo" >
                <div class="box" style="margin-bottom: 20px; position: absolute; bottom: 60px; left: 100px">
                  <div class="icon" style="border: solid 2px black;"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                  <div class="text">
                      <h3 style="color: #3498db">Address</h3>
                      <p style="color: #000">Tubigon, Bohol</p>
                  </div>
                </div>
                <div class="box" style="margin-bottom: 20px; position: absolute; bottom: 60px; left: 530px">
                  <div class="icon" style="border: solid 2px black;"><i class="fa fa-phone" aria-hidden="true"></i></div>
                  <div class="text">
                    <h3 style="color: #3498db">Phone</h3>
                    <p style="color: #000">+639182134522 / 02-500-0824</p>
                  </div>
                </div>
               <div class="box" style="margin-bottom: 20px; position: absolute; bottom: 60px; right: 100px">
                  <div class="icon" style="border: solid 2px black;"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                  <div class="text">
                    <h3 style="color: #3498db">Email</h3>
                    <p style="color: #000">cemeterysystem@gmail.com</p>
                  </div>
                </div>
              </div>
              <div class="contactForm" style="position: absolute; right: 400px; top: 0px;">
                <form class="" action="index.php" method="post" enctype="multipart/form-data">
                  <center><h1>Send Message</h1></center>
                  <div class="inputBox">
                    <input type="text" name="fullname" required="required" autocomplete="off">
                    <span>Full Name</span>
                  </div>
                  <div class="inputBox">
                    <input type="Email" name="email" required="required" autocomplete="off">
                    <span>Email</span>
                  </div>
                  <div class="inputBox">
                    <input type="number" name="contact_number" required="required" autocomplete="off">
                    <span>Contact Number</span>
                  </div>
                  <div class="inputBox">
                    <textarea required="required" name="message" autocomplete="off"></textarea>
                    <span>Type your Message...</span>
                  </div>
                  <div class="inputBox">
                    <input type="submit" value="Send" name="contact_btn" style="background-color: #3498db; margin-left: 170px; color: white;">
                  </div>
                </form>
              </div>
            </div>
        </section>

    <section class="contact">
        <div class="content" style="">
          <a style="font-size: 40px; color: #000;" id="about">About Us</a>
          <p style="color: #000">Cemetery Mapping & Info System</p>
        </div>
        <div class="container" style="position: absolute; top: 80px;" id="about">
        <img class="image" src="assets/images/logo.png" width="350px" style="position: absolute; right: 60px; top: 120px;">

          <div class="contactForm" style="position: absolute; left: 20px; top: 100px; width: 60%;">
            <a class="navbar-brand" id="title" href="#" style="font-size: 40px;">Cemetery System</a>
           <p style="color: #000; font-size: 20px; text-indent: 70px; text-align: justify; width: 300px">Is a system that locates the location of the deceased person within the cemetery. Create reservations and find available position and location for burying with ease.</p>
          </div>
        </div>
    </section>
        
    

        <!-- Sticky Footer -->
           <footer class="sticky-footer" style="min-width: 100%">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <a style="pointer-events: none;"><img src="assets/images/logo.png" width="50px"></a>
              <p style="color: #000">&copy; <script>document.write(new Date().getFullYear())</script> Cemetery System
              </p>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Login Modal-->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Login</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">

              <div class="text-center"><?php echo display_error(); ?></div>

          <form id="login" method="post" action="index.php">

            <div class="form-group validate">
              <div class="form-label-group">
                <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" autofocus="autofocus">
                <label for="inputEmail">Username</label>
              </div>
            </div>

            <div class="form-group validate">
              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
                <label for="inputPassword">Password</label>
              </div>
            </div>


            <button  class="btn btn-primary btn-block" type="submit" name="loginBtn">Login</button>
          </form>

          <div class="text-center">
         <!--  <span>Doesn't have an account?<a class="d-block" href="#" data-toggle="modal" data-target="#registerModal2" data-dismiss="modal" aria-label="Close">Signup</a></span> -->
          <span>Doesn't have an account?<a class="d-block" href="#" data-toggle="modal" data-target="#registerModal2">Signup</a></span>
          </div>
          </div>
        </div>
      </div>
    </div>

  <!-- Register Modal-->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">You need to register first!</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">

          <form id="register" method="post" action="index.php" enctype="multipart/form-data">

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="text" id="firstName" class="form-control" placeholder="First Name" autofocus="autofocus" name="fname"> 
                    <label for="firstName">Enter First Name</label>
                  </div>
                </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="text" id="middleName" class="form-control" placeholder="Middle Name" name="mname">
                    <label for="middleName">Enter Middle Name</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="text" id="lastName" class="form-control" placeholder="Last Name" autofocus="autofocus" name="lname"> 
                    <label for="lastName">Enter Last Name</label>
                  </div>
                </div>
                <div class="col-md-6 validate">
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
                    <input type="date" id="birthday" class="form-control" placeholder="Birthday" autofocus="autofocus" name="birthday"> 
                    <label for="birthday">Enter Birthday</label>
                  </div>
                </div>
                <div class="col-sm-6 validate">
                  <label for="input-type">Select Gender:</label>
                  <div id="input-type" class="row">
                    <div class="col-sm-6">
                      <label class="radio-inline" style="margin-left: 100px;">
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
                <input type="text" id="inputAddress" class="form-control" placeholder="Residential Address" name="residential_address">
                <label for="inputAddress">Residential address</label>
              </div>
            </div>

             <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="email" id="emailAddress" class="form-control" placeholder="Email Address" autofocus="autofocus" name="email_address"> 
                    <label for="emailAddress">Enter Email Address</label>
                  </div>
                </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="text" id="contactNumber" class="form-control" placeholder="Contact Number" name="contact_number">
                    <label for="contactNumber">Enter Contact Number</label>
                  </div>
                </div>
              </div>
            </div>

             <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                <div class="form-label-group">
                 <input style="height: 50px;" type="password" id="passWord" class="form-control" placeholder="Password" name="password">
                  <label for="passWord">Enter Password</label>
                  <div class="input-group-append">
                      <span><i class="fas fa-eye eye1" id="eye" onclick="toggle1()"></i></span>
                  </div>
                </div>
               </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="text" id="username" class="form-control" placeholder="Username" autofocus="autofocus" name="username"> 
                    <label for="username">Enter Username</label>
                  </div>
                </div>
              </div>
            </div>

             <div class="form-group" style="margin-bottom: 30px;">
              <div class="form-row">
                <div class="col-md-6 validate">
                   <div class="form-label-group">
                    <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                    <label for="confirm_password">Confirm Password</label>
                  <div class="input-group-append">
                     <span><i class="fas fa-eye eye2" id="eye2" onclick="toggle2()"></i></span>
                  </div>
                  </div>
                </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group text-center">
                    <img style="margin-top: 40px; border-radius: 50px; cursor: pointer;" width="150" src="assets/images/profile.png" onclick="triggerClick()" id="profileDisplay" />
                    <label id="profileLabel" for="profileImage" style="cursor: pointer;">Profile Picture</label>
                    <input type="file" name="photo" onchange="displayImage(this)" id="profileImage" style="display: none;">
                  </div>
                </div>
              </div>
            </div>

             <button class="btn btn-primary btn-block" type="submit" name="registerBtn">Register</button>

          </form>

          <div class="text-center">
          <span>Already had an account?<a class="d-block" href="#" data-toggle="modal" data-target="#loginModal" data-dismiss="modal" aria-label="Close">Sign in</a></span>
          </div>
            
          </div>
        </div>
      </div>
    </div>

    <!-- Register Modal 2-->
    <div class="modal fade" id="registerModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Register</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">

          <form id="register2" method="post" action="index.php" enctype="multipart/form-data">

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="text" id="firstName2" class="form-control" placeholder="First Name" autofocus="autofocus" name="fname2"> 
                    <label for="firstName2">Enter First Name</label>
                  </div>
                </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="text" id="middleName2" class="form-control" placeholder="Middle Name" name="mname2">
                    <label for="middleName2">Enter Middle Name</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="text" id="lastName2" class="form-control" placeholder="Last Name" autofocus="autofocus" name="lname2"> 
                    <label for="lastName2">Enter Last Name</label>
                  </div>
                </div>
                <div class="col-md-6 validate">
                    <select class="form-control" name="age2" id="age2" autofocus="autofocus" style="cursor: pointer;">
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
                    <input type="date" id="birthday2" class="form-control" placeholder="Birthday" autofocus="autofocus" name="birthday2"> 
                    <label for="birthday2">Enter Birthday</label>
                  </div>
                </div>
                <div class="col-sm-6 validate">
                  <label for="input-type">Select Gender:</label>
                  <div id="input-type" class="row">
                    <div class="col-sm-6">
                      <label class="radio-inline" style="margin-left: 100px;">
                        <input type="radio" name="gender2" value="Male"> Male
                      </label>
                    </div>
                    <div class="col-sm-6">
                      <label class="radio-inline">
                        <input type="radio" name="gender2" value="Female"> Female
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group validate">
              <div class="form-label-group">
                <input type="text" id="inputAddress2" class="form-control" placeholder="Residential Address" name="residential_address2">
                <label for="inputAddress2">Residential address</label>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="email" id="emailAddress2" class="form-control" placeholder="Email Address" autofocus="autofocus" name="email_address2"> 
                    <label for="emailAddress2">Enter Email Address</label>
                  </div>
                </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="text" id="contactNumber2" class="form-control" placeholder="Contact Number" name="contact_number2">
                    <label for="contactNumber2">Enter Contact Number</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6 validate">
                <div class="form-label-group">
                 <input style="height: 50px;" type="password" id="passWord2" class="form-control" placeholder="Password" name="password2">
                  <label for="passWord2">Enter Password</label>
                  <div class="input-group-append">
                      <span><i class="fas fa-eye eye1" id="regEye" onclick="toggleModal1()"></i></span>
                  </div>
                </div>
               </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group">
                    <input type="text" id="username2" class="form-control" placeholder="Username" autofocus="autofocus" name="username2"> 
                    <label for="username2">Enter Username</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group" style="margin-bottom: 30px;">
              <div class="form-row">
                <div class="col-md-6 validate">
                   <div class="form-label-group">
                    <input type="password" id="confirm_password2" class="form-control" placeholder="Confirm Password" name="confirm_password2">
                    <label for="confirm_password2">Confirm Password</label>
                  <div class="input-group-append">
                     <span><i class="fas fa-eye eye2" id="regEye2" onclick="toggleModal2()"></i></span>
                  </div>
                  </div>
                </div>
                <div class="col-md-6 validate">
                  <div class="form-label-group text-center">
                    <img style="margin-top: 40px; border-radius: 50px; cursor: pointer;" width="150" src="assets/images/profile.png" onclick="triggerClick2()" id="profileDisplay2" />
                    <label id="profileLabel2" for="profileImage2" style="cursor: pointer;">Profile Picture</label>
                    <input type="file" name="photo2" onchange="displayImage2(this)" id="profileImage2" style="display: none;">
                  </div>
                </div>
              </div>
            </div>


             <button class="btn btn-primary btn-block" type="submit" name="registerBtn2">Register</button>

            </form>

          <div class="text-center">
          <span>Already had an account?<a class="d-block" href="#" data-dismiss="modal">Sign in</a></span>
          </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>

    <!-- validators -->
    <script src="assets/vendor/jquery/jquery.validator.js"></script>
    <script src="assets/vendor/jquery/additional-methods.min.js"></script>
    <!-- !validators -->
    
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery/searchbox2.js"></script>
    <script src="assets/vendor/jquery/login2.js"></script>
    <script src="assets/vendor/jquery/register3.js"></script>
    <script src="assets/vendor/jquery/modal2.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>
    <script src="assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="assets/js/demo/datatables-demo.js"></script>
    <script src="assets/js/demo/chart-area-demo.js"></script>

    <script>
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();

                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>

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

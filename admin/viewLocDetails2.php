<?php 
  include('../functions/functions.php');

$loc_id = $_GET['loc_id'];

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

    <title>Cemetery System | Location Details</title>

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
                         <a href="allReservations.php" class="btn btn-sm btn-primary">Return</a>
                      </div>

                    <div class="login-form">
    <?php
        $query=mysqli_query($db,"SELECT * FROM reservations WHERE loc_id='".$loc_id."'")or die(mysqli_error());
          while($row=mysqli_fetch_array($query)){
    ?>

    <?php if ($row['status']=='pending') {?>

      <span style="color: blue">Status: <b><u>Pending</u></b></span>

        <form id="reservationForm" action="viewLocDetails.php" method="post">

            <center>
              <span><b>User Detail</b></span>
            </center>

            <div class="form-group" hidden="hidden">
                <label for="userID" class="control-label mb-1">User ID</label>
                <input id="userID" name="user_id" type="text" class="form-control" value="<?php echo $row['user_id'];?>" readonly>
            </div>

             <div class="form-group" hidden="hidden">
                <label for="locId" class="control-label mb-1">Location ID</label>
                <input id="locId" name="loc_id" type="text" class="form-control" value="<?php echo $loc_id; ?>" readonly>
            </div>

            <div class="form-group">
              <label for="userID" class="control-label mb-1">Reserved By</label>
              <input id="userID" name="reserved_by" type="text" class="form-control" value="<?php echo $row['reserved_by'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="residentialAddress" class="control-label mb-1">Residential Address</label>
                <input id="residentialAddress" name="residential_address" type="text" class="form-control" value="<?php echo $row['residential_address'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="contactNumber" class="control-label mb-1">Contact Number</label>
                 <input name="contact_number" id="contactNumber" type="text" class="form-control" value="<?php echo $row['contact_number'];?>" readonly="readonly">
            </div>

             <div class="form-group">
                <label for="inputNumber" class="control-label mb-1">Email Address</label>
                <input name="email_address" id="inputNumber" type="text" class="form-control" value="<?php echo $row['email_address'];?>" readonly="readonly">
            </div>
         
            <center>
              <span><b>Location</b></span>
            </center>

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

              <div class="form-group">
                <label for="inputNumber" class="control-label mb-1">Price</label>
                <input name="price" id="inputNumber" type="text" class="form-control" value="<?php echo $row['price'];?>" readonly="readonly">
            </div>

            <center>
              <span><b>Deceased Details</b></span>
            </center>
                          
            <div class="form-group">
                <label for="contactNumber" class="control-label mb-1">Deceased Name</label>
                 <input name="contact_number" id="contactNumber" type="text" class="form-control" value="<?php echo $row['fullname'];?>" readonly="readonly">
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group validate">
                  <label for="contactNumber" class="control-label mb-1">Age</label>
                 <input name="contact_number" id="contactNumber" type="text" class="form-control" value="<?php echo $row['age'];?>" readonly="readonly">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group validate">
                 <label for="contactNumber" class="control-label mb-1">Gender</label>
                 <input name="contact_number" id="contactNumber" type="text" class="form-control" value="<?php echo $row['gender'];?>" readonly="readonly">
                </div>
              </div>
             </div>

            <div class="row">
              <div class="col-6">
              <div class="form-group validate">
                <label for="inputBirth" class="control-label mb-1">Date of Birth</label>
                <input id="inputBirth" name="date_of_birth" type="text" class="form-control" value="<?php echo date('F j, Y',strtotime($row['date_of_birth']));?>" readonly>
              </div>
              </div>
              <div class="col-6">
              <div class="form-group validate">
                <label for="inputDeath" class="control-label mb-1">Date of Death</label>
                <input id="inputDeath" name="date_of_death" type="text" class="form-control" value="<?php echo date('F j, Y',strtotime($row['date_of_death']));?>" readonly>
              </div>
              </div>
             </div>

             <div class="form-group validate">
                <label for="inputBurial" class="control-label mb-1">Date of Burial</label>
                <input id="inputBurial" name="date_of_burial" type="text" class="form-control" value="<?php echo date('F j, Y',strtotime($row['date_of_burial']));?>" readonly>
            </div>

              <div>
                 <a class="btn btn-success btn-block" href="approveReservation2.php?reserve_id=<?php echo $row['reserve_id']; ?>&&loc_id=<?php echo $row['loc_id']; ?>" onClick="return confirm('Are you sure you want to Approve this reservation?' )"></i>Approve Reservation</a>
              </div>
               <div style="margin-top: 10px;">
                <a class="btn btn-danger btn-block" href="denyReservation2.php?reserve_id=<?php echo $row['reserve_id']; ?>&&loc_id=<?php echo $row['loc_id']; ?>" onClick="return confirm('Are you sure you want to Deny this reservation?' )"></i>Deny Reservation</a>
              </div>
               <div style="margin-top: 10px;">
                <a class="btn btn-block btn-info" href="sendUserMessage2.php?user_id=<?php echo $row['user_id']; ?>&&loc_id=<?php echo $row['loc_id']; ?>">Send Message</a>
              </div>
              <div style="margin-top: 10px;">
                <a class="btn btn-block btn-secondary" href="allReservations.php">Cancel</a>
              </div>
        </form>

    <?php }else if($row['status']=='approved'){ ?>

      <span style="color: #2ecc71">Status: <b><u>Approved</u></b></span>

        <form id="reservationForm" action="viewLocDetails2.php?reserve_id=<?php echo $row['reserve_id']; ?>&&loc_id=<?php echo $row['loc_id']; ?>" method="post">

            <center>
              <span><b>User Detail</b></span>
            </center>

            <div class="form-group" hidden>
                <label for="userID" class="control-label mb-1">User ID</label>
                <input id="userID" name="user_id" type="text" class="form-control" value="<?php echo $row['user_id'];?>" readonly>
            </div>

             <div class="form-group" hidden>
                <label for="locId" class="control-label mb-1">Location ID</label>
                <input id="locId" name="loc_id" type="text" class="form-control" value="<?php echo $loc_id; ?>" readonly>
            </div>

            <div class="form-group" hidden>
                <label for="resId" class="control-label mb-1">Reserve ID</label>
                <input id="resId" name="reserve_id" type="text" class="form-control" value="<?php echo $row['reserve_id']; ?>" readonly>
            </div>

            <div class="form-group">
              <label for="userID" class="control-label mb-1">Reserved By</label>
              <input id="userID" name="reserved_by" type="text" class="form-control" value="<?php echo $row['reserved_by'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="residentialAddress" class="control-label mb-1">Residential Address</label>
                <input id="residentialAddress" name="residential_address" type="text" class="form-control" value="<?php echo $row['residential_address'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="contactNumber" class="control-label mb-1">Contact Number</label>
                 <input name="contact_number" id="contactNumber" type="text" class="form-control" value="<?php echo $row['contact_number'];?>" readonly="readonly">
            </div>

             <div class="form-group">
                <label for="inputNumber" class="control-label mb-1">Email Address</label>
                <input name="email_address" id="inputNumber" type="text" class="form-control" value="<?php echo $row['email_address'];?>" readonly="readonly">
            </div>
         
            <center>
              <span><b>Location</b></span>
            </center>

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

              <div class="form-group">
                <label for="inputNumber" class="control-label mb-1">Price</label>
                <input name="price" id="inputNumber" type="text" class="form-control" value="<?php echo $row['price'];?>" readonly="readonly">
            </div>

            <center>
              <span><b>Deceased Details</b></span>
            </center>
                          
            <div class="form-group">
                <label for="contactNfdgfmber" class="control-label mb-1">Deceased Name</label>
                 <input name="full_name" id="contactNfdgfmber" type="text" class="form-control" value="<?php echo $row['fullname'];?>" readonly="readonly">
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group validate">
                  <label for="sdda" class="control-label mb-1">Age</label>
                 <input name="age" id="sdda" type="text" class="form-control" value="<?php echo $row['age'];?>" readonly="readonly">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group validate">
                 <label for="jjh" class="control-label mb-1">Gender</label>
                 <input name="gender" id="jjh" type="text" class="form-control" value="<?php echo $row['gender'];?>" readonly="readonly">
                </div>
              </div>
             </div>

            <div class="row">
              <div class="col-6">
              <div class="form-group validate">
                <label for="inputBirth" class="control-label mb-1">Date of Birth</label>
                <input id="inputBirth" name="" type="text" class="form-control" value="<?php echo date('F j, Y',strtotime($row['date_of_birth']));?>" readonly>
              </div>
              </div>
              <div class="col-6">
              <div class="form-group validate">
                <label for="inputDeath" class="control-label mb-1">Date of Death</label>
                <input id="inputDeath" name="" type="text" class="form-control" value="<?php echo date('F j, Y',strtotime($row['date_of_death']));?>" readonly>
              </div>
              </div>
             </div>

              <div class="row" hidden="">
              <div class="col-6">
              <div class="form-group validate">
                <label for="inputBirth" class="control-label mb-1">Date of Birth</label>
                <input id="inputBirth" name="date_of_birth" type="text" class="form-control" value="<?php echo $row['date_of_birth'];?>" readonly>
              </div>
              </div>
              <div class="col-6">
              <div class="form-group validate">
                <label for="inputDeath" class="control-label mb-1">Date of Death</label>
                <input id="inputDeath" name="date_of_death" type="text" class="form-control" value="<?php echo $row['date_of_death'];?>" readonly>
              </div>
              </div>
             </div>

             <div class="form-group validate">
                <label for="inputBurial" class="control-label mb-1">Date of Burial</label>
                <input id="inputBurial" name="date_of_burial" type="text" class="form-control" value="<?php echo date('F j, Y',strtotime($row['date_of_burial']));?>" readonly>
            </div>

             <div class="form-group validate">
                <label for="inputBurial" class="control-label mb-1">Date Approved</label>
                <input id="inputBurial" name="date_of_burial" type="text" class="form-control" value="<?php echo date('F j, Y',strtotime($row['date_approved']));?>" readonly>
            </div>

              <div>
                 <!--   <a class="btn btn-warning btn-block" href="occupyLocation.php?reserve_id=<?php echo $row['reserve_id']; ?>&&loc_id=<?php echo $row['loc_id']; ?>" onClick="return confirm('Are you sure you that this location is now occupied?' )"></i>Occupy Location</a>   -->
                  <button  class="btn btn-warning btn-block" type="submit" name="occupiedButton" onClick="return confirm('Are you sure that this location is now occupied?' )">Occupy Location</button>
              </div>
               <div style="margin-top: 10px;">
                <a class="btn btn-block btn-info" href="sendUserMessage2.php?user_id=<?php echo $row['user_id']; ?>&&loc_id=<?php echo $row['loc_id']; ?>">Send Message</a>
              </div>
              <div style="margin-top: 10px;">
                <a class="btn btn-block btn-secondary" href="allReservations.php">Cancel</a>
              </div>
        </form>

    <?php }else if($row['status']=='occupied'){ ?>

     <span style="color: black">Status: <b><u>Occupied</u></b></span>

        <form id="reservationForm" action="viewLocDetails2.php" method="post">

            <center>
              <span><b>User Detail</b></span>
            </center>

            <div class="form-group" hidden="hidden">
                <label for="userID" class="control-label mb-1">User ID</label>
                <input id="userID" name="user_id" type="text" class="form-control" value="<?php echo $row['user_id'];?>" readonly>
            </div>

             <div class="form-group" hidden="hidden">
                <label for="locId" class="control-label mb-1">Location ID</label>
                <input id="locId" name="loc_id" type="text" class="form-control" value="<?php echo $loc_id; ?>" readonly>
            </div>

            <div class="form-group">
              <label for="userID" class="control-label mb-1">Reserved By</label>
              <input id="userID" name="reserved_by" type="text" class="form-control" value="<?php echo $row['reserved_by'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="residentialAddress" class="control-label mb-1">Residential Address</label>
                <input id="residentialAddress" name="residential_address" type="text" class="form-control" value="<?php echo $row['residential_address'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="contactNumber" class="control-label mb-1">Contact Number</label>
                 <input name="contact_number" id="contactNumber" type="text" class="form-control" value="<?php echo $row['contact_number'];?>" readonly="readonly">
            </div>

             <div class="form-group">
                <label for="inputNumber" class="control-label mb-1">Email Address</label>
                <input name="email_address" id="inputNumber" type="text" class="form-control" value="<?php echo $row['email_address'];?>" readonly="readonly">
            </div>
         
            <center>
              <span><b>Location</b></span>
            </center>

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

              <div class="form-group">
                <label for="inputNumber" class="control-label mb-1">Price</label>
                <input name="price" id="inputNumber" type="text" class="form-control" value="<?php echo $row['price'];?>" readonly="readonly">
            </div>

            <center>
              <span><b>Deceased Details</b></span>
            </center>
                          
            <div class="form-group">
                <label for="contactNumber" class="control-label mb-1">Deceased Name</label>
                 <input name="contact_number" id="contactNumber" type="text" class="form-control" value="<?php echo $row['fullname'];?>" readonly="readonly">
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group validate">
                  <label for="contactNumber" class="control-label mb-1">Age</label>
                 <input name="contact_number" id="contactNumber" type="text" class="form-control" value="<?php echo $row['age'];?>" readonly="readonly">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group validate">
                 <label for="contactNumber" class="control-label mb-1">Gender</label>
                 <input name="contact_number" id="contactNumber" type="text" class="form-control" value="<?php echo $row['gender'];?>" readonly="readonly">
                </div>
              </div>
             </div>

            <div class="row">
              <div class="col-6">
              <div class="form-group validate">
                <label for="inputBirth" class="control-label mb-1">Date of Birth</label>
                <input id="inputBirth" name="date_of_birth" type="text" class="form-control" value="<?php echo date('F j, Y',strtotime($row['date_of_birth']));?>" readonly>
              </div>
              </div>
              <div class="col-6">
              <div class="form-group validate">
                <label for="inputDeath" class="control-label mb-1">Date of Death</label>
                <input id="inputDeath" name="date_of_death" type="text" class="form-control" value="<?php echo date('F j, Y',strtotime($row['date_of_death']));?>" readonly>
              </div>
              </div>
             </div>

             <div class="form-group validate">
                <label for="inputBurial" class="control-label mb-1">Date of Burial</label>
                <input id="inputBurial" name="date_of_burial" type="text" class="form-control" value="<?php echo date('F j, Y',strtotime($row['date_of_burial']));?>" readonly>
            </div>

             <div class="form-group validate">
                <label for="inputBurial" class="control-label mb-1">Date Occupied</label>
                <input id="inputBurial" name="date_of_burial" type="text" class="form-control" value="<?php echo date('F j, Y',strtotime($row['date_occupied']));?>" readonly>
            </div>

               <div style="margin-top: 10px;">
                <a class="btn btn-block btn-info" href="sendUserMessage2.php?user_id=<?php echo $row['user_id']; ?>&&loc_id=<?php echo $row['loc_id']; ?>">Send Message</a>
              </div>
              <div style="margin-top: 10px;">
                <a class="btn btn-block btn-secondary" href="allReservations.php">Cancel</a>
              </div>
        </form>

    <?php } else if ($row['status']=='denied'){ ?>

        <span style="color: white; background: red">Status: <b><u>Denied</u></b></span>

        <form id="reservationForm" action="viewLocDetails2.php" method="post">

            <center>
              <span><b>User Detail</b></span>
            </center>

            <div class="form-group" hidden="hidden">
                <label for="userID" class="control-label mb-1">User ID</label>
                <input id="userID" name="user_id" type="text" class="form-control" value="<?php echo $row['user_id'];?>" readonly>
            </div>

             <div class="form-group" hidden="hidden">
                <label for="locId" class="control-label mb-1">Location ID</label>
                <input id="locId" name="loc_id" type="text" class="form-control" value="<?php echo $loc_id; ?>" readonly>
            </div>

            <div class="form-group">
              <label for="userID" class="control-label mb-1">Reserved By</label>
              <input id="userID" name="reserved_by" type="text" class="form-control" value="<?php echo $row['reserved_by'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="residentialAddress" class="control-label mb-1">Residential Address</label>
                <input id="residentialAddress" name="residential_address" type="text" class="form-control" value="<?php echo $row['residential_address'];?>" readonly>
            </div>

            <div class="form-group">
                <label for="contactNumber" class="control-label mb-1">Contact Number</label>
                 <input name="contact_number" id="contactNumber" type="text" class="form-control" value="<?php echo $row['contact_number'];?>" readonly="readonly">
            </div>

             <div class="form-group">
                <label for="inputNumber" class="control-label mb-1">Email Address</label>
                <input name="email_address" id="inputNumber" type="text" class="form-control" value="<?php echo $row['email_address'];?>" readonly="readonly">
            </div>
         
            <center>
              <span><b>Location</b></span>
            </center>

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

              <div class="form-group">
                <label for="inputNumber" class="control-label mb-1">Price</label>
                <input name="price" id="inputNumber" type="text" class="form-control" value="<?php echo $row['price'];?>" readonly="readonly">
            </div>

            <center>
              <span><b>Deceased Details</b></span>
            </center>
                          
            <div class="form-group">
                <label for="contactNumber" class="control-label mb-1">Deceased Name</label>
                 <input name="contact_number" id="contactNumber" type="text" class="form-control" value="<?php echo $row['fullname'];?>" readonly="readonly">
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group validate">
                  <label for="contactNumber" class="control-label mb-1">Age</label>
                 <input name="contact_number" id="contactNumber" type="text" class="form-control" value="<?php echo $row['age'];?>" readonly="readonly">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group validate">
                 <label for="contactNumber" class="control-label mb-1">Gender</label>
                 <input name="contact_number" id="contactNumber" type="text" class="form-control" value="<?php echo $row['gender'];?>" readonly="readonly">
                </div>
              </div>
             </div>

            <div class="row">
              <div class="col-6">
              <div class="form-group validate">
                <label for="inputBirth" class="control-label mb-1">Date of Birth</label>
                <input id="inputBirth" name="date_of_birth" type="text" class="form-control" value="<?php echo date('F j, Y',strtotime($row['date_of_birth']));?>" readonly>
              </div>
              </div>
              <div class="col-6">
              <div class="form-group validate">
                <label for="inputDeath" class="control-label mb-1">Date of Death</label>
                <input id="inputDeath" name="date_of_death" type="text" class="form-control" value="<?php echo date('F j, Y',strtotime($row['date_of_death']));?>" readonly>
              </div>
              </div>
             </div>

             <div class="form-group validate">
                <label for="inputBurial" class="control-label mb-1">Date of Burial</label>
                <input id="inputBurial" name="date_of_burial" type="text" class="form-control" value="<?php echo date('F j, Y',strtotime($row['date_of_burial']));?>" readonly>
            </div>

               <div style="margin-top: 10px;">
                <a class="btn btn-block btn-info" href="sendUserMessage2.php?user_id=<?php echo $row['user_id']; ?>&&loc_id=<?php echo $row['loc_id']; ?>">Send Message</a>
              </div>
              <div style="margin-top: 10px;">
                <a class="btn btn-block btn-secondary" href="allReservations.php">Cancel</a>
              </div>
        </form>

    <?php } ?>

    <?php }?>


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

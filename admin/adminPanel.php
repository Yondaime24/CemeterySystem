<?php 
  include('../functions/functions.php');

    $sql2 = "SELECT sum(price) AS total FROM reservations WHERE status='occupied'";
  $stmt2 = $db->query($sql2);
  $row1 = $stmt2->fetch_assoc();


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

     <title>Cemetery System | Admin Dashboard</title>

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
    <link href="css/badge2.css" rel="stylesheet" media="all">
    <link href="css/spanbadge.css" rel="stylesheet" media="all">

    <style>
      .error{
        color: red;
        font-style: italic;
      }
      .icon2{
        font-size: 100px;
      }
    </style>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            <div class="logo" style="background: black;">
                <a href="adminPanel.php">
                     <h3 class="name text-white">Cemetery System</h3>
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2">
                    <div class="image img-cir img-120">
                        <?php if($_SESSION['user']['photo'] != ""): ?>
                            <img src="../assets/images/<?php echo $_SESSION['user']['photo']; ?>"/>
                        <?php else: ?>
                            <img src="../assets/images/profile.png"/>
                        <?php endif; ?>
                    </div>
                    <h4 class="name"><?php echo $_SESSION['user']['fname']; ?> <?php echo $_SESSION['user']['lname']; ?></h4>
                    <a href="#" style="pointer-events: none;"><span class="dot dot--green"></span> Online</a>
                    <h4>ADMIN</h4>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li class="active">
                            <a href="adminPanel.php">
                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-user-circle"></i>Users
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="addUser.php">
                                            <i class="fas fa-plus"></i>Add User</a>
                                    </li>
                                    <li>
                                        <a href="viewUser.php">
                                            <i class="fas fa-user"></i>View Users</a>
                                    </li>
                                </ul>
                        </li>
                        <li>
                            <a href="deceasedGlosarry.php">
                            <i class="fas fa-book"></i>Deceased Glosarry</a>
                        </li>
                        <li>
                            <a href="location.php">
                            <i class="fas fa-map-marker-alt"></i>Locations</a>
                        </li>
                        <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-table"></i>Reservations
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="allReservations.php">
                                        <i class="fas fa-table"></i>All Reservations</a>
                                </li>
                                <li>
                                    <a href="pendinReservations.php">
                                        <i class="fas fa-user"></i>Pending Reservations</a>
                                </li>
                                 <li>
                                    <a href="approvedReservations.php">
                                        <i class="fas fa-check"></i>Approved Reservations</a>
                                </li>
                                <li>
                                    <a href="deniedReservation.php">
                                        <i class="zmdi zmdi-block"></i>Denied Reservations</a>
                                </li>
                                 <li>
                                    <a href="occupiedReservations.php">
                                        <i class="fas fa-book"></i>Occupied Locations</a>
                                </li>
                            </ul>
                        </li>
                        <!-- <li>
                            <a href="deactivatedUser.php">
                            <i class="fas fa-exclamation-triangle"></i>Deactivated User</a>
                        </li> -->
                    </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop2" style="background: black">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="header-button2">
                                <div class="header-button-item js-item-menu">
                                    <?php
                                        $query = "SELECT * from `user_msg` where `status` = 'unread' order by `date_sent` DESC";
                                        if(count(fetchAll($query))>0){
                                    ?>
                                    <span class="badge"><?php echo count(fetchAll($query)); ?></span>
                                   <?php
                                        }
                                    ?>

                                     <i class="zmdi zmdi-email"></i>
                                    <div class="notifi-dropdown js-dropdown">

                                   
                                    <?php
                                        $query = "SELECT * from `user_msg` where `status` = 'unread' order by `date_sent` DESC";
                                        if(count(fetchAll($query))>0){
                                    ?>
                                        <div class="notifi__title">
                                            <p style="color: #2ecc71">You have <?php echo count(fetchAll($query)); ?> new Messages</p>
                                        </div>
                                   <?php
                                        }
                                    ?>

                                    <div class="scroll2">

                                    <?php 
                                        $query = "SELECT * from `user_msg` order by `date_sent` DESC";
                                            if(count(fetchAll($query))>0){
                                              foreach(fetchAll($query) as $i){
                                    ?>
                                      
                                        <?php if ($i['status']=='unread') { ?>

                                             <?php if ($i['type']=='reservation_msg') { ?>
                                        <a class="notifi__item" href="reservationMsg.php?msg_id=<?php echo $i['msg_id'] ?>">
                                            <div class="bg-c1 img-cir img-40">
                                                <i class="zmdi zmdi-email"></i>
                                            </div>
                                            <div class="content">
                                                <small style="color: black">From: <?php echo $i['message_from'] ?></small>
                                                    <p><b>You receive a reservation message</b></p>
                                                <small style="color: black;"><?php echo date('F j, Y / g:i a',strtotime($i['date_sent'])) ?></small>
                                            </div>
                                        </a>
                                             <?php  }else if ($i['type']=='msg') { ?>
                                        <a class="notifi__item" href="userMsg.php?msg_id=<?php echo $i['msg_id'] ?>&&user_id=<?php echo $i['user_id'] ?>">
                                            <div class="bg-c1 img-cir img-40">
                                                <i class="zmdi zmdi-email"></i>
                                            </div>
                                            <div class="content">
                                                <small style="color: black">From: <?php echo $i['message_from'] ?></small>
                                                    <p><b>You have a new message</b></p>
                                                <small style="color: black;"><?php echo date('F j, Y / g:i a',strtotime($i['date_sent'])) ?></small>
                                            </div>
                                        </a>
                                             <?php } ?>

                                        <?php  }else if ($i['status']=='read') { ?>

                                         <?php if ($i['type']=='reservation_msg') { ?>
                                        <a class="notifi__item" href="reservationMsg.php?msg_id=<?php echo $i['msg_id'] ?>">
                                            <div class="bg-c1 img-cir img-40" style="background: gray">
                                                <i class="zmdi zmdi-email-open"></i>
                                            </div>
                                            <div class="content">
                                                <small style="color: gray">From: <?php echo $i['message_from'] ?></small>
                                                    <p>You receive a reservation message</p>
                                                <small style="color: gray;"><?php echo date('F j, Y / g:i a',strtotime($i['date_sent'])) ?></small>
                                            </div>
                                        </a>
                                             <?php  }else if ($i['type']=='msg') { ?>
                                        <a class="notifi__item" href="userMsg.php?msg_id=<?php echo $i['msg_id'] ?>&&user_id=<?php echo $i['user_id'] ?>">
                                            <div class="bg-c1 img-cir img-40" style="background: gray">
                                                <i class="zmdi zmdi-email-open"></i>
                                            </div>
                                            <div class="content">
                                                <small style="color: gray">From: <?php echo $i['message_from'] ?></small>
                                                    <p>You have a new message</p>
                                                <small style="color: gray"><?php echo date('F j, Y / g:i a',strtotime($i['date_sent'])) ?></small>
                                            </div>
                                        </a>
                                             <?php } ?>

                                        <?php } ?>

                                      <?php 
                                          }
                                        }

                                        else{
                                          echo "<div class=\"notifi__title\">
                                                     <p style=\"color: red\">No Messages Yet</p>
                                                </div>";
                                        }

                                      ?>
                                       
                                    </div>
                                        <!--  <div class="notifi__footer">
                                            <a href="userMessage.php" style="color: #2ecc71">Send Message</a>
                                        </div> -->
                                    </div>
                                </div>
                               <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="adminProfile.php">
                                                <i class="zmdi zmdi-account"></i>My Profile</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="changePhoto.php">
                                                <i class="zmdi zmdi-edit"></i>Change Profile Picture</a>
                                            <a href="chageUserPass.php">
                                                <i class="zmdi zmdi-edit"></i>Change Username & Password</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="adminPanel.php?logout='1'">
                                                <i class="zmdi zmdi-power"></i>Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- BREADCRUMB-->                        
        <a href="" style="pointer-events: none;">
                <?php if (isset($_SESSION['success'])) : ?>
        <section class="au-breadcrumb m-t-75" style="text-align: center;">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="au-breadcrumb-content">
                            <div class="au-breadcrumb-left">
                   <div class="error success" >
                    <h3 style="color: black; margin-top: 100px;">
                      <?php 
                        echo $_SESSION['success']; 
                        unset($_SESSION['success']);
                      ?>
                      <?php  if (isset($_SESSION['user'])) : ?>
                      <strong><?php echo $_SESSION['user']['fname']; ?> <?php echo $_SESSION['user']['mname']; ?> <?php echo $_SESSION['user']['lname']; ?></strong>
                     <?php endif ?>!!!
                    </h3>
                    <div class="au-progress" style="margin-top: 20px;">
                            <div class="au-progress__bar">
                                <div class="au-progress__inner js-progressbar-simple" role="progressbar" data-transitiongoal="100">
                                <span class="au-progress__value js-value"></span>
                            </div>
                        </div>
                    </div>
                  </div>
                  </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php endif ?>            
                </a>                         
                    </section>
            <!-- END BREADCRUMB-->

            <!-- STATISTIC-->
            <section class="statistic">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-6 col-lg-3">
                                 <a href="viewUser.php">
                                <div class="statistic__item">
                                    <?php

                                        $query = "SELECT * from `users` where `user_type` = 'user'";
                                        if(count(fetchAll($query))>0){
                                    ?>

                                  <?php
                                  if(count(fetchAll($query))==1){
                                    ?>
                                   <div class="number" style="font-size: 20px;"><?php echo count(fetchAll($query)); ?> Member!</div>
                                  <?php
                                    }else{
                                  ?>
                                  <div class="number" style="font-size: 20px;"><?php echo count(fetchAll($query)); ?> Members!</div>
                                  </ul>
                                    <?php }
                                  ?>           

                                    <?php
                                        }else{
                                          echo "No Members Yet!";
                                        }
                                    ?>
                                    <div class="icon2">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                    <small><u>Click to view details</u></small>
                                </div>
                                </a>
                            </div>

                             <div class="col-md-6 col-lg-3">
                                 <a href="pendinReservations.php">
                                <div class="statistic__item">
                                    <?php

                                        $query = "SELECT * from `reservations` where `status` = 'pending'";
                                        if(count(fetchAll($query))>0){
                                    ?>

                                  <?php
                                  if(count(fetchAll($query))==1){
                                    ?>
                                    <center>
                                    <div class="number" style="font-size: 20px; background: red; color: white"><?php echo count(fetchAll($query)); ?></div>
                                   <div class="number" style="font-size: 20px;">Pending Reservation!</div>
                                   <small><b>To Review</b></small>
                                   </center>
                                  <?php
                                    }else{
                                  ?>
                                   <center>
                                    <div class="number" style="font-size: 20px; background: red; color: white"><?php echo count(fetchAll($query)); ?></div>
                                   <div class="number" style="font-size: 20px;">Pending Reservations!</div>
                                    <small><b>To Review</b></small>
                                   </center>
                                    <?php }
                                  ?>           

                                    <?php
                                        }else{
                                          echo "No Pending Reservations Yet!";
                                        }
                                    ?>
                                    <div class="icon2">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                    <small><u>Click to view details</u></small>
                                </div>
                                </a>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                 <a href="approvedReservations.php">
                                <div class="statistic__item">
                                    <?php

                                        $query = "SELECT * from `reservations` where `status` = 'approved'";
                                        if(count(fetchAll($query))>0){
                                    ?>

                                  <?php
                                  if(count(fetchAll($query))==1){
                                    ?>
                                    <center>
                                    <div class="number" style="font-size: 20px; background: red; color: white"><?php echo count(fetchAll($query)); ?></div>
                                   <div class="number" style="font-size: 20px;">Incoming Reservation!</div>
                                    <small><b>To Accept</b></small>
                                   </center>
                                  <?php
                                    }else{
                                  ?>
                                   <center>
                                    <div class="number" style="font-size: 20px; background: red; color: white"><?php echo count(fetchAll($query)); ?></div>
                                   <div class="number" style="font-size: 20px;">Incoming Reservations!</div> <small><b>To Accept</b></small>
                                   </center>
                                    <?php }
                                  ?>           

                                    <?php
                                        }else{
                                          echo "No Incoming Reservations Yet!";
                                        }
                                    ?>
                                    <div class="icon2">
                                        <i class="zmdi zmdi-check"></i>
                                    </div>
                                    <small><u>Click to view details</u></small>
                                </div>
                                </a>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                 <a href="occupiedReservations.php">
                                <div class="statistic__item">
                                    <?php

                                        $query = "SELECT * from `reservations` where `status` = 'occupied'";
                                        if(count(fetchAll($query))>0){
                                    ?>

                                  <?php
                                  if(count(fetchAll($query))==1){
                                    ?>
                                    <center>
                                    <div class="number" style="font-size: 20px; background: red; color: white"><?php echo count(fetchAll($query)); ?></div>
                                   <div class="number" style="font-size: 20px;">Occupied Location!</div>
                                   </center>
                                  <?php
                                    }else{
                                  ?>
                                   <center>
                                    <div class="number" style="font-size: 20px; background: red; color: white"><?php echo count(fetchAll($query)); ?></div>
                                   <div class="number" style="font-size: 20px;">Occupied Locations!</div>
                                   </center>
                                    <?php }
                                  ?>           

                                    <?php
                                        }else{
                                          echo "No Occupied Locations Yet!";
                                        }
                                    ?>
                                    <div class="icon2">
                                        <i class="zmdi zmdi-map"></i>
                                    </div>
                                    <small><u>Click to view details</u></small>
                                </div>
                                </a>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                 <a href="deniedReservation.php">
                                <div class="statistic__item">
                                    <?php

                                        $query = "SELECT * from `reservations` where `status` = 'denied'";
                                        if(count(fetchAll($query))>0){
                                    ?>

                                  <?php
                                  if(count(fetchAll($query))==1){
                                    ?>
                                    <center>
                                    <div class="number" style="font-size: 20px; background: red; color: white"><?php echo count(fetchAll($query)); ?></div>
                                   <div class="number" style="font-size: 20px;">Denied Reservation!</div>
                                   </center>
                                  <?php
                                    }else{
                                  ?>
                                   <center>
                                    <div class="number" style="font-size: 20px; background: red; color: white"><?php echo count(fetchAll($query)); ?></div>
                                   <div class="number" style="font-size: 20px;">Denied Reservations!</div>
                                   </center>
                                    <?php }
                                  ?>           

                                    <?php
                                        }else{
                                          echo "No Pending Reservations Yet!";
                                        }
                                    ?>
                                    <div class="icon2">
                                        <i class="zmdi zmdi-block"></i>
                                    </div>
                                    <small><u>Click to view details</u></small>
                                </div>
                                </a>
                            </div>

                           

                            <div class="col-md-6 col-lg-3">
                                 <a href="deceasedGlosarry.php">
                                <div class="statistic__item">
                                    <?php
                                        $query = "SELECT * from `deceased_details`";
                                        if(count(fetchAll($query))>0){
                                    ?>
                                     <h2 class="number" style="font-size: 20px;"><?php echo count(fetchAll($query)); ?> Deceased Buried</h2>
                                   <?php
                                        }else{
                                            echo "No Deceased Buried Yet!";
                                        }
                                    ?>
                                    <div class="icon2">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                    <small><u>Click to view details</u></small>
                                </div>
                                </a>
                            </div>

                              <div class="col-md-6 col-lg-3">
                                 <a href="occupiedReservations.php">
                                <div class="statistic__item">
                                    <?php
                                        $query = "SELECT * from `reservations` WHERE `status`='occupied'";
                                        if(count(fetchAll($query))>0){
                                    ?>
                                     <h2 class="number" style="font-size: 20px;">&#8369;<?php echo $row1["total"]; ?> Total Earnings</h2>
                                   <?php
                                        }else{
                                            echo "No Total Earnings Yet!";
                                        }
                                    ?>
                                    <div class="icon2">
                                        <i class="zmdi zmdi-money-box"></i>
                                    </div>
                                    <small><u>Click to view details</u></small>
                                </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->
            <!-- END PAGE CONTAINER-->
        </div>
            <footer class="sticky-footer" style="height: 20px;">
              <div class="container my-auto">
                <div class="copyright text-center my-auto">
                  <p style="margin-left: 300px;">Copyright © 2021 Cemetery System. All rights reserved.</p>
                </div>
              </div>
            </footer>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
     <!-- validators -->
    <script src="../assets/vendor/jquery/jquery.validator.js"></script>
    <script src="../assets/vendor/jquery/additional-methods.min.js"></script>
    <!-- !validators -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/jquery/searchbox2.js"></script>
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

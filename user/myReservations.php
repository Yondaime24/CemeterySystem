<?php 
  include('../functions/functions.php');

  $sql2 = "SELECT sum(price) AS total FROM reservations WHERE user_id ='".$_SESSION['user']['user_id']."'";
  $stmt2 = $db->query($sql2);
  $row1 = $stmt2->fetch_assoc();

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

     <title>Cemetery System | My Reservations</title>

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
    </style>

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            <div class="logo" style="background: black;">
                <a href="userHome.php">
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
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="userHome.php">
                            <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="deceasedGlosarry.php">
                            <i class="fas fa-book"></i>Deceased Glosarry</a>
                        </li>
                         <li>
                            <a href="addReservation.php">
                            <i class="far fa-plus-square"></i>Add Reservation</a>
                        </li>
                        <li class="active">
                            <a href="myReservations.php">
                            <i class="fas fa-table"></i>My Reservations</a>
                        </li>
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
                                        $query = "SELECT * from `admin_message` where `status` = 'unread' && `user_id`='".$_SESSION['user']['user_id']."' order by `date_sent` DESC";
                                        if(count(fetchAll($query))>0){
                                    ?>
                                    <span class="badge"><?php echo count(fetchAll($query)); ?></span>
                                   <?php
                                        }
                                    ?>

                                     <i class="zmdi zmdi-email"></i>
                                    <div class="notifi-dropdown js-dropdown">

                                   
                                    <?php
                                        $query = "SELECT * from `admin_message` where `status` = 'unread' && `user_id`='".$_SESSION['user']['user_id']."' order by `date_sent` DESC";
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
                                        $query = "SELECT * from `admin_message` where `user_id`='".$_SESSION['user']['user_id']."' order by `date_sent` DESC";
                                            if(count(fetchAll($query))>0){
                                              foreach(fetchAll($query) as $i){
                                    ?>
                                      
                                        <?php if ($i['status']=='unread') { ?>

                                             <?php if ($i['type']=='reservation_msg') { ?>
                                        <a class="notifi__item" href="reservationMsg.php?adminmsg_id=<?php echo $i['adminmsg_id'] ?>&&reserve_id=<?php echo $i['reserve_id'] ?>">
                                            <div class="bg-c1 img-cir img-40">
                                                <i class="zmdi zmdi-email"></i>
                                            </div>
                                            <div class="content">
                                                <small style="color: black">From Admin: <?php echo $i['admin_name'] ?></small>
                                                    <p><b>You receive a reservation reply</b></p>
                                                <small style="color: black;"><?php echo date('F j, Y / g:i a',strtotime($i['date_sent'])) ?></small>
                                            </div>
                                        </a>
                                             <?php  }else if ($i['type']=='msg') { ?>
                                        <a class="notifi__item" href="adminMsg.php?adminmsg_id=<?php echo $i['adminmsg_id'] ?>">
                                            <div class="bg-c1 img-cir img-40">
                                                <i class="zmdi zmdi-email"></i>
                                            </div>
                                            <div class="content">
                                                <small style="color: black">From Admin: <?php echo $i['admin_name'] ?></small>
                                                    <p><b>You have a new message</b></p>
                                                <small style="color: black;"><?php echo date('F j, Y / g:i a',strtotime($i['date_sent'])) ?></small>
                                            </div>
                                        </a>
                                             <?php } ?>

                                        <?php  }else if ($i['status']=='read') { ?>

                                         <?php if ($i['type']=='reservation_msg') { ?>
                                        <a class="notifi__item" href="reservationMsg.php?adminmsg_id=<?php echo $i['adminmsg_id'] ?>&&reserve_id=<?php echo $i['reserve_id'] ?>">
                                            <div class="bg-c1 img-cir img-40" style="background: gray">
                                                <i class="zmdi zmdi-email-open"></i>
                                            </div>
                                            <div class="content">
                                                <small style="color: gray">From: <?php echo $i['admin_name'] ?></small>
                                                    <p>You receive a reservation message</p>
                                                <small style="color: gray;"><?php echo date('F j, Y / g:i a',strtotime($i['date_sent'])) ?></small>
                                            </div>
                                        </a>
                                             <?php  }else if ($i['type']=='msg') { ?>
                                        <a class="notifi__item" href="userMsg.php?adminmsg_id=<?php echo $i['adminmsg_id'] ?>">
                                            <div class="bg-c1 img-cir img-40" style="background: gray">
                                                <i class="zmdi zmdi-email-open"></i>
                                            </div>
                                            <div class="content">
                                                <small style="color: gray">From: <?php echo $i['admin_name'] ?></small>
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
                                         <div class="notifi__footer">
                                            <a href="userMessage.php" style="color: #2ecc71">Send Message</a>
                                        </div>
                                    </div>
                                </div>
                               <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="myProfile.php">
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
                                            <a href="userHome.php?logout='1'">
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

           

            <!-- STATISTIC-->
        <section class="statistic" style="margin-top: 25px;">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                <h3 class="title-5">my reservations</h3>
                    <div class="table-responsive">
                <?php

                    $user_id = $_SESSION['user']['user_id'];        
                    $query = "SELECT * FROM reservations WHERE user_id='$user_id' ORDER BY date_reserved ASC";
                    $result = mysqli_query($db,$query);
                        
                ?>  
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>deceased name</th>
                                    <th>date of death</th>
                                    <th>date of burial</th>
                                    <th>location</th>
                                    <th>price</th>
                                    <th>date</th>
                                    <th>status</th>
                                    <th>options</th>
                                </tr>
                            </thead>
                             <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                      <th>&#8369;<?php echo $row1["total"]; ?></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr class="tr-shadow">
                            <?php
                            if($result){
                              while($res = mysqli_fetch_array($result)) {     
                                echo "<tr>";
                                  echo "<td>".$res['fullname']."</td>";
                                  echo "<td>".date('F j, Y',strtotime($res['date_of_death']))."</td>"; 
                                  echo "<td>".date('F j, Y',strtotime($res['date_of_burial']))."</td>";
                                  echo "<td>Block ".$res['block']." Number ".$res['number']."</td>";
                                  echo "<td>&#8369;".$res['price']."</td>";

                                if ($res['status']=='pending') {
                                   echo "<td><span style=\"background: blue; color: white\">Reserved On:</span> ".date('F j, Y',strtotime($res['date_reserved']))."</td>"; 
                                }else if ($res['status']=='denied') {
                                    echo "<td><span style=\"background: red; color: white\">Denied On:</span> ".date('F j, Y',strtotime($res['date_denied']))."</td>"; 
                                }else if ($res['status']=='approved') {
                                     echo "<td><span style=\"background: #2ecc71; color: white\">Approved On:</span> ".date('F j, Y',strtotime($res['date_approved']))."</td>"; 
                                }else if ($res['status']=='occupied'){
                                    echo "<td><span style=\"background: black; color: white\">Occupied On:</span> ".date('F j, Y',strtotime($res['date_occupied']))."</td>"; 
                                }

                                $occupied = 'occupied';

                                if ($res['status']=='pending') {
                                   echo "<td style=\"color: blue;\">".$res['status']."</td>";
                                }else if ($res['status']=='denied') {
                                   echo "<td style=\"color: red;\">".$res['status']."</td>";
                                }else if ($res['status']=='approved') {
                                   echo "<td style=\"color: #2ecc71;\">".$res['status']."</td>";
                                }else if ($res['status']=='occupied'){
                                   echo "<td style=\"color: black;\">".$occupied."</td>";
                                }   


                                if ($res['status']=='pending') {

                                echo "
                                <td>
                                    <div class=\"table-data-feature\">
                                       <a href=\"viewReservation.php?reserve_id=$res[reserve_id]&&loc_id=$res[loc_id]&&user_id=$res[user_id]\" class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"View Details\" style=\"background: orange;\"><i style=\"color: white;\" class=\"zmdi zmdi-eye\"></i></a>
                                        <a class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit Deceased Details\" href=\"editReservation.php?reserve_id=$res[reserve_id]&&loc_id=$res[loc_id]\" style=\"background: blue;\"><i style=\"color: white;\" class=\"zmdi zmdi-edit\"></i></a>
                                        <a class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Cancel\" href=\"cancelReservation.php?reserve_id=$res[reserve_id]&&loc_id=$res[loc_id]\" style=\"background: red;\" onClick=\"return confirm('Are you sure you want to cancel this reservation?' )\"><i style=\"color: white;\" class=\"zmdi zmdi-block-alt\"></i></a>
                                        <a class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Send Message\" href=\"sendMessage.php?reserve_id=$res[reserve_id]&&user_id=$res[user_id]\" style=\"background: #2ecc71;\"><i style=\"color: white;\" class=\"zmdi zmdi-mail-send\"></i></a>
                                    </div>
                                </td>
                                ";

                                }else if ($res['status']=='denied') {

                                echo "
                                <td>
                                    <div class=\"table-data-feature\">
                                       <a href=\"viewReservation.php?reserve_id=$res[reserve_id]&&loc_id=$res[loc_id]&&user_id=$res[user_id]\" class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"View Details\" style=\"background: orange;\"><i style=\"color: white;\" class=\"zmdi zmdi-eye\"></i></a>
                                        <a class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\" href=\"deleteReservation.php?reserve_id=$res[reserve_id]\" style=\"background: red;\"><i style=\"color: white;\" class=\"zmdi zmdi-delete\" onClick=\"return confirm('Are you sure you want to delete this reservation?' )\"></i></a>
                                         <a class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Send Message\" href=\"sendMessage.php?reserve_id=$res[reserve_id]&&user_id=$res[user_id]\" style=\"background: #2ecc71;\"><i style=\"color: white;\" class=\"zmdi zmdi-mail-send\"></i></a>
                                    </div>
                                </td>
                                ";  

                                }else if ($res['status']=='approved') {

                                 echo "
                                <td>
                                    <div class=\"table-data-feature\">
                                       <a href=\"viewReservation.php?reserve_id=$res[reserve_id]&&loc_id=$res[loc_id]&&user_id=$res[user_id]\" class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"View Details\" style=\"background: orange;\"><i style=\"color: white;\" class=\"zmdi zmdi-eye\"></i></a>
                                         <a class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Send Message\" href=\"sendMessage.php?reserve_id=$res[reserve_id]&&user_id=$res[user_id]\" style=\"background: #2ecc71;\"><i style=\"color: white;\" class=\"zmdi zmdi-mail-send\"></i></a>
                                    </div>
                                </td>
                                ";

                                }else if ($res['status']=='occupied') {

                                    echo "
                                <td>
                                    <div class=\"table-data-feature\">
                                        <a href=\"viewReservation.php?reserve_id=$res[reserve_id]&&loc_id=$res[loc_id]&&user_id=$res[user_id]\" class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"View Details\" style=\"background: orange;\"><i style=\"color: white;\" class=\"zmdi zmdi-eye\"></i></a>
                                        <a class=\"item\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Send Message\" href=\"sendMessage.php?reserve_id=$res[reserve_id]&&user_id=$res[user_id]\" style=\"background: #2ecc71;\"><i style=\"color: white;\" class=\"zmdi zmdi-mail-send\"></i></a>
                                    </div>
                                </td>
                                ";

                                }

                                    echo "<tr class=\"spacer\"></tr>
                                          <tr class=\"tr-shadow\"></tr>";
                                 echo "</tr>";                                   
                              }
                            }?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
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

    <!-- modal medium -->
        <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediumModalLabel">Reservation Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Confirm</button>
                        </div>
                    </div>
                </div>
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

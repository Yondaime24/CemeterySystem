<?php
    
    include("../functions/functions.php");

    $reserve_id = $_GET['reserve_id'];
    $loc_id = $_GET['loc_id'];

    $todayDate2 = new DateTime();
    $due_date = $todayDate2->format('Y-m-d H:i:s');

     $query1 ="UPDATE `location` SET `status` = 'approved' WHERE `loc_id` = $loc_id;";
     performQuery($query1);

     $query2 ="UPDATE `reservations` SET `status` = 'approved' WHERE `reserve_id` = $reserve_id;";
     performQuery($query2);

     $query3 ="UPDATE `reservations` SET `date_approved` = '$due_date' WHERE `reserve_id` = $reserve_id;";
     performQuery($query3);
  

     echo "<script>alert('Reservation has been approved successfully!')</script>";
     echo "<script>window.open('allReservations.php?loc_id=$loc_id','_self')</script>";

   
     mysqli_close($db);


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
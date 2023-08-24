<?php
    
    include("../functions/functions.php");

    $reserve_id = $_GET['reserve_id'];
    $loc_id = $_GET['loc_id'];

    $query2 = "DELETE FROM `reservations` WHERE `reserve_id` = $reserve_id;";

    $query="UPDATE `location` SET `status`='available' WHERE loc_id='$loc_id'";
    $query_run = mysqli_query($db, $query);

    if ($query_run && mysqli_query($db, $query2)) {

       echo "<script>alert('Reservation data has been canceled successfully!')</script>";
       echo "<script>window.open('myReservations.php','_self')</script>";

     }else{

      echo "<script>alert('Failed')</script>".mysqli_error($db);

     }

        mysqli_close($db);


if (!isLoggedIn()) {
  header('location: ../index.php');
}
    
?>
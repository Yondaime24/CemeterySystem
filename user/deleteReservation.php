<?php
    
    include("../functions/functions.php");

    $reserve_id = $_GET['reserve_id'];

    $query = "DELETE FROM `reservations` WHERE `reserve_id` = $reserve_id;";

     if (mysqli_query($db, $query)) {

        echo "<script>alert('Reservation data has been deleted successfully!')</script>";
        echo "<script>window.open('myReservations.php','_self')</script>";
            
        }else{

        echo "<script>alert('Failed')</script>".mysqli_error($db);

        }

        mysqli_close($db);


if (!isLoggedIn()) {
  header('location: ../index.php');
}
    
?>
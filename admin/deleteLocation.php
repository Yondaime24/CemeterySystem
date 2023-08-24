<?php
    
    include("../functions/functions.php");

    $loc_id = $_GET['loc_id'];

    $query = "DELETE FROM `location` WHERE `loc_id` = $loc_id;";

     if (mysqli_query($db, $query)) {

        echo "<script>alert('Location data has been deleted successfully!')</script>";
        echo "<script>window.open('location.php','_self')</script>";
            
        }else{

        echo "<script>alert('Failed')</script>".mysqli_error($db);

        }

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
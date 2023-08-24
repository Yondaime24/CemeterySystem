<?php
    
    include("../functions/functions.php");

    $deceased_id = $_GET['deceased_id'];

    $query = "DELETE FROM `deceased_details` WHERE `deceased_id` = $deceased_id;";

     if (mysqli_query($db, $query)) {

        echo "<script>alert('Deceased data has been deleted successfully!')</script>";
        echo "<script>window.open('deceasedGlosarry.php','_self')</script>";
            
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
<?php 
    require_once "../../db/connecttion.php";
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $reservation_id = $_GET['r_id'];

        $stm = $PDO -> prepare("DELETE FROM tbl_reservations WHERE reservation_id = ?");
        $stm -> bindValue( 1 , $reservation_id);
        
        if( $stm -> execute() ){
            echo "<script> alert('Reservation was removed successfully.') </script>";

            header("location: reservations.php");
        }
        else {
            echo $stm->error_log;
        }
    }
?>
<?php
    require_once "../../db/connecttion.php";
    session_start();

    if( ! isset($_SESSION['user']) ){
        header("location:index.php");
    }

    $user = $_SESSION['user'];
    $sid = $user['sid'];

    if( $user['account_type'] == "Student" ){
        $col = "lrn";
        $table = "tbl_students";
        $_SESSION['account_type'] = "Student";
    }
    else if( $user['account_type'] == "Personnel"){
        $_SESSION['account_type'] = "Personnel";
        $col = "employee_id";
        $table = "tbl_personnels";
    }

    $stm = $PDO -> prepare( "SELECT * FROM $table WHERE $col = $sid" );
    $stm -> execute();

    $user = $stm -> fetch(PDO::FETCH_ASSOC);


    if($_SESSION['account_type'] == "Student" && ( $user['phone'] == '' || $user['grade_section'] == "" || $user['adviser'] == '' ) ){
        $_SESSION['profile_warning'] = "Good day " .$user['name']  . ", you need to complete your profile information in order to use this website. Please complete your informations below.";
        header("location: profile.php");
    }

    if($_SESSION['account_type'] == "Personnel" && ( $user['phone'] == '' || $user['designation'] == "" ) ){
        $_SESSION['profile_warning'] = "Good day " .$user['name']  . ", you need to complete your profile information in order to use this website. Please complete your informations below.";
        header("location: profile.php");
    }


    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $book_id = $_GET['book_id'];

    }
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $book_id  = $_POST['book_id'];

        //check if has pending reservation
        $stm = $PDO -> prepare(" SELECT * FROM tbl_reservations WHERE borrower_sid = ? AND book_id = ? AND status IN ('Pending' , 'Approved')");
        $stm -> bindValue( 1 , $sid);
        $stm -> bindValue( 2 , $book_id);

        $stm -> execute();

        if ($stm -> rowCount() > 0){
            $_SESSION['reservation_error'] = "You already have a pending reservation for this item"; 
        }

        

        else {
            $stm = $PDO -> prepare(" INSERT INTO tbl_reservations (borrower_sid , book_id , status ) VALUES ( ? , ? , ? )");
            $stm -> bindValue( 1 , $sid);
            $stm -> bindValue( 2 , $book_id);
            $stm -> bindValue( 3 , "Pending");
            
            if( $stm -> execute() ){
                $_SESSION['reservation_status'] = "Reservation request was created";
                header("location:reservations.php");
            }
            else {
                $_SESSION['reservation_status'] = "Failed";
            }    
        }
    }

?>
<?php 
    //check the pending and approved reservation of the user
    $stm = $PDO -> prepare(" SELECT * FROM tbl_reservations WHERE borrower_sid = ? AND status IN ('Pending','Approved')");
    $stm -> bindValue( 1 , $sid);

    $stm -> execute();

    $pending_reservations = $stm -> rowCount();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMATHS | Library</title>
    <link rel="stylesheet" href="./css/main.css">
    <?php require_once "../../cdn.php" ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />   
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
  

    <style>
        .container-wave {
        position: relative;
        background: #2c3e50;
        height: auto;
        }

        .wave {
        position: absolute;
        height: 100px;
        width: 100%;
        background: #2c3e50;
        bottom: 0;
        overflow: hidden;
        }

        .wave::before, .wave::after {
        content: "";
        display: block;
        position: absolute;
        border-radius: 100% 50%;
        }

        .wave::before {
        width: 55%;
        height: 109%;
        background-color: #fff;
        right: -1.5%;
        top: 60%;
        }
        .wave::after {
                width: 100%;
                height: 80%;
                background-color: #2c3e50;
                left: -1.5%;
                top: 35%;
            }   


        @media (max-width:700px ){
            .wave::after {
                width: 100%;
                height: 80%;
                background-color: #2c3e50;
                left: -1.5%;
                top: 35%;
            }   
        }

  
        /* 
        .dataTables_filter input {
            padding: .375rem .75rem !important;
            font-size: 1rem;
            position: relative;
            font-weight: 400;
            line-height: 1.5 ;
            width: 300px !important;
            border-radius: 4px;    
            text-align: left !important;
            background: white;
        } */
 
    </style>
</head>
<body>
        <?php require_once "./components/nav.php" ?>    
        <section class="container-wave"  style="display:flex ; align-items:flex-end">
            <div class="container" style="display:flex ; align-items:flex-end">

                <h2 class="h1 py-2" style="color:white; z-index:20">Create Reservation</h2>
            </div>
            <div class="wave" style="display:flex; align-items:flex-end">
            </div>  
        </section>

        <?php 
            $stm = $PDO -> prepare(" SELECT * FROM tbl_items WHERE id = $book_id ");
            $stm -> execute();

            $res = $stm -> fetch(PDO::FETCH_ASSOC);

        ?>
        
        <div class="container">        
        <?php if(isset ( $_SESSION['reservation_error'])):  ?>
                            <div class=" text-danger p-1 text-center">
                            <i class="fa-solid fa-triangle-exclamation"></i> <?php echo  $_SESSION['reservation_error'] ?>
                            </div>
                        <?php 
                            unset( $_SESSION['reservation_error']);
                            endif ?>
            <form action="" method="POST" class="shadow mt-2">

                <input type="hidden" name="book_id" value="<?php echo $book_id ?>">

                <div class="shadow p-1">
                    <h1 class="p-2 fs-5 bg-success text-white">Reservation Details </h1>
                 
                    <div class="shadow p-4">
                        <p class="text-white px-2" style="background-color: #2c3e50;">Book Information</p>
                        <div class="border p-2">

                            <p class="fs-4">Title: <?php echo $res['title']  ?></p>
                            <?php if( $res['edition'] != 'none') :?>
                                <p class="fs-6"> <?php echo $res['edition'] . ' ' . $res['editionNum'] ?></p>
                            <?php endif ?>
                            <?php if($res['isbn']): ?>
                                <p class="fs-6">ISBN: <?php echo $res['isbn'] ?></p>
                                <?php endif?>
                                <p class="fs-6">Author: <?php echo $res['author'] ?></p>
                                <p class="fs-6">Publisher: <?php echo $res['publisher'] ?></p>
                                <p class="fs-6">Publication Year: <?php echo $res['date'] ?></p>
                                <p class="fs-6">Genre: <?php echo $res['genre'] ?></p>
                        </div>

                   
                        <p class="text-white px-2"  style="background-color: #2c3e50;">Your Information</p>
                        <div class="border p-2">

                            <p class="fs-4">Name : <?php echo $user['name']  ?></p>
                            <p class="fs-6">Grade and Section: <?php echo $user['grade_section']?></p>
                            <p class="fs-6">Adviser:  <?php echo $user['adviser'] ?></p>
                        </div>  
                
                        <button type="submit"   class="<?php if($pending_reservations >= 3) echo "disabled" ?> btn btn-outline-success mt-2">Reserve</button>
                        <?php 
                            if($pending_reservations >= 3){
                                echo '<p class="text-danger"><i class="fa-solid fa-triangle-exclamation"></i> You have reached the maximum number of reservations! </p>';
                            }
                        ?>
                    </div>
                        
                </div>

            </form>
        </div>

</body>

</html>
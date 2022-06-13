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

                <h2 class="h1 py-2" style="color:white; z-index:20">Borrow</h2>
            </div>
            <div class="wave" style="display:flex; align-items:flex-end">
            </div>  
        </section>

        <?php 
            $stm = $PDO -> prepare("SELECT * FROM tbl_borrow
                                    INNER JOIN tbl_items
                                    ON tbl_borrow.book_id = tbl_items.id
                                    WHERE borrower_sid = ? AND status IN ('Borrow' , 'Overdue')");
            $stm -> bindValue( 1 , $sid);
            $stm -> execute();
            $res = $stm -> fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="container">

            <div class="row  mt-2">

                <?php foreach($res as $i): ?>
                    <div class="card px-0 text-center col-md-5 me-4 mt-4">
                        <div class="card-header" >   <b>Status : <span class="<?php if( $i['status'] == "Borrow") {  echo "badge bg-success";  } else {  echo "badge bg-danger"; } ?> " > <?php echo $i['status'] ?> </span> </b></div>
                        <div class="card-body">
                            <h5 class="card-title"> <?php echo $i['title'] ?> </h5>
                            <p class="card-text fst-italic">by <?php echo $i['author'] ?></p>
                        </div>
 

                        <!-- format date 1 day ahead to get expiration date -->
                        <?php 
                            if ($i['status'] == "Borrow" || $i['status'] == "Overdue"){

                                $datetime = new DateTime($i['due_date']);
                                $due_date_formatted = new DateTime($i['borrow_date']);
                                 ?>
                                <p>Borrowed Date: <?php echo $due_date_formatted -> format("M d Y H:i A") ?></p>
                                <div class="<?php if($i['status'] == "Borrow") {echo "bg-success p-1";} else { echo "bg-danger p-1";} ?>">
                                    <span class="text-white">Must return on <?php  echo $datetime->format('M d Y H:i A'); ?>  </span>
                                </div>
                               <?php } ?>

                        
                    </div>
                
                <?php endforeach; ?>
                <?php if($stm -> rowCount() == 0 ): ?>
                    <p class="text-center"> -- No reservations --</p>
                <?php endif; ?>
            </div>
        </div>

</body>

</html>
<?php

    require_once "../../db/connecttion.php";
    session_start();
    date_default_timezone_set('Asia/Manila');
    // $client = $_SESSION['client'] ?? null;

    // if ( !isset($client) )
    // {
    //     header("location:login.php");
    // }


    if($_SERVER['REQUEST_METHOD'] == "GET" ){
        $book_id = $_GET['book_id'];
        $borrower_sid = $_GET['borrower_sid'];
        $reservation_id = $_GET['reservation_id'] ?? null;

        $stm = $PDO -> prepare("SELECT * FROM tbl_pending_account WHERE sid = ?");
        $stm -> bindValue( 1, $borrower_sid);
        $stm -> execute();

        $borrowerAccount = $stm -> fetch(PDO::FETCH_ASSOC);

        $borrowerAccountType = $borrowerAccount['account_type'];

        if($borrowerAccountType == "Student")
            $table = "tbl_students WHERE lrn";
        else 
            $table = "tbl_personnels WHERE employee_id";

        $stm = $PDO -> prepare("SELECT * FROM $table =  ?");
        $stm -> bindValue( 1, $borrower_sid);
        $stm -> execute();
        $borrower = $stm -> fetch(PDO::FETCH_ASSOC);

        $stm = $PDO -> prepare("SELECT * FROM tbl_items WHERE id = ?");
        $stm -> bindValue( 1 , $book_id);
        $stm -> execute();
        $item = $stm -> fetch(PDO::FETCH_ASSOC);
        
    }

    //post new borrow to tbl_borrow
    if($_SERVER['REQUEST_METHOD'] == "POST" ){
        $borrower_sid = $_POST['borrower_sid'];
        $book_id = $_POST['book_id'];
        $reservation_id = $_POST['reservation_id'];

        $days = $_POST['days'];
        $borrow_date = $_POST['borrow_date'];
        
        $due_date_object = new DateTime($borrow_date);
        $due_date_object -> add( new DateInterval("P".$days."D"));

        $due_date = $due_date_object -> format("Y-m-d H:i:s");
        $accession_id = $_POST['accession_id'];



        $stm = $PDO -> prepare("INSERT INTO tbl_borrow 
                                (borrower_sid , book_id , days , borrow_date , due_date , accession_id , status)
                                VALUES ( ? , ? , ? ,? , ? , ? , ?) ");
        $stm -> bindValue( 1 , $borrower_sid );
        $stm -> bindValue( 2 , $book_id );
        $stm -> bindValue( 3 , $days );
        $stm -> bindValue( 4 , $borrow_date );
        $stm -> bindValue( 5 , $due_date );
        $stm -> bindValue( 6 , $accession_id );
        $stm -> bindValue( 7 , "Borrow" );

        if($stm -> execute()){
            
            //change request to completed
            $stm = $PDO -> prepare("UPDATE tbl_reservations SET status = 'Completed' WHERE reservation_id  = $reservation_id");
            $stm -> execute();
            echo "<script> alert('New item was lended succesfully') </script> ";
            header("location:activeReservations.php");

            //update available books
            $stm = $PDO -> prepare("UPDATE tbl_items SET available = available -1  WHERE id  = $book_id");
            $stm -> execute();
            echo "<script> alert('New item was lended succesfully') </script> ";
            header("location:activeReservations.php");
        }


    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Library</title>

    <?php require_once "../../cdn.php" ?>

    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/nav.css">
    <link rel="stylesheet" href="../../css/library.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />   
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
  
            <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
            <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
            <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>             -->
</head>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
                </div>
            </div>
        </div>
<body>
            <!-- Modal -->
  
    <header>
        <?php require_once "./components/header.php" ?>
    </header>
    
    <div class="d-flex nav-content-wrapper">
        <nav id="main-nav" >
            <?php require_once "./components/nav.php" ?>
        </nav>
        
        <!-- Button trigger modal -->
     




        <div class="dashboard d-block">
            <h2 class="h2">Borrow</h2>

            <form action="" method="POST">
                <div>
                <input type="hidden" name="borrower_sid" value="<?php echo $borrower_sid ?>">
                <input type="hidden" name="book_id" value="<?php echo $book_id ?>">
                <div class="shadow p-4">
                        <p class="text-white px-2" style="background-color: #2c3e50;">Book Information</p>
                        <div class="border p-2">

                            <p class="fs-4">Title: <?php echo $item['title']  ?></p>
                            <?php if( $item['edition'] != 'none') :?>
                                <p class="fs-6"> <?php echo $item['edition'] . ' ' . $item['editionNum'] ?></p>
                            <?php endif ?>
                            <?php if($item['isbn']): ?>
                                <p class="fs-6">ISBN: <?php echo $item['isbn'] ?></p>
                                <?php endif?>   
                                <p class="fs-6">Author: <?php echo $item['author'] ?></p>
                                <p class="fs-6">Call Number: <?php echo $item['call_number'] ?></p>
                                <p class="fs-6">Publisher: <?php echo $item['publisher'] ?></p>
                                <p class="fs-6">Publication Year: <?php echo $item['date'] ?></p>
                                <p class="fs-6">Genre: <?php echo $item['genre'] ?></p>
                        </div>

                   
                        <p class="text-white px-2"  style="background-color: #2c3e50;">Borrower Information</p>
                        <?php if($borrowerAccountType == "Student"): ?>
                            <div class="border p-2">

                                <p class="fs-4">Name : <?php echo $borrower['name']  ?></p>
                                <p class="fs-6">Grade and Section: <?php echo $borrower['grade_section']?></p>
                                <p class="fs-6">Adviser:  <?php echo $borrower['adviser'] ?></p>
                            </div> 
                        <?php else: ?>
                            <div class="border p-2">
                                <p class="fs-4">Name : <?php echo $borrower['name']  ?></p>
                                <p class="fs-6">Job Title: <?php echo $borrower['designation']?></p>
                            </div> 
                        <?php endif; ?>
                        <p class="text-white px-2"  style="background-color: #2c3e50;">Details</p>
                        <div class="border p-2">
                            <label for="label">Borrow Date:</label>
                            <input type="datetime" class="form-control" readonly value="<?php $date = new DateTime();  echo $date -> format("M d Y H:i:s"); ?>">
                            <input required type="text" name="accession_id" placeholder="Enter accession number..." class="form-control mt-2">
                            <div class="col-md-2">
                                <input type="number" min="1" max="3" name="days" required class="form-control mt-2" placeholder="Enter days"> 
                            </div>

                            <input type="hidden" name="borrow_date" class="form-control mt-2"   value="<?php $date = new DateTime(); echo $date -> format("Y-m-d H:i:s"); ?>">
                            <input type="hidden" name="reservation_id" class="form-control mt-2"   value="<?php echo $reservation_id?>">
                        </div>  
                
                        <button type="submit"   class = " btn btn-outline-success mt-2">Confirm</button>
                      
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $( "#nav-toggler" ).click(function() {
            $( "#main-nav" ).slideToggle( "fast" );
        });


   
        $(document).ready( function(){
            //navigation active class
            $(" #nav-item-borrow ").addClass( "active")
          

            
            
        } );
    
    </script>


</body>
</html>
<?php 
    require_once "./db/connecttion.php";
    session_start();
    $user  = $_SESSION['user'] ?? null;


    // =======  ADMIN ACTIONS ==========//
    // GETINFO CATALOG
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "getInfo"){

        
        $id = (int) $_POST['id'] ?? null;   
        $stm = $PDO->prepare( "SELECT * FROM tbl_items WHERE id = $id");

        $stm->execute();

        $res =  $stm->fetch(PDO::FETCH_ASSOC);
        
        var_dump($res);

        echo ' <div class="div-info" id="div-info">
        <div class="shadow" style="display:flex; justify-content:center; align-items:center; position: absolute; height:100vh; width:100vw; background-color:rgba(0,0,0,0.5); top:0">
            <div class="catalog-info" style="background-color:white; position:relative ;">    
                <div style="position:absolute; top:0; left:0; display:flex; width:100%; justify-content:space-between; background-color: #6C6A61;">
                    <span style="padding: 0 1rem; color: white">Catalog Information </span>
                    <span onclick="clearHtml(`div-info`)" ><i style="padding: 4px; color:white" class="fa-solid fa-xmark"></i></span>
                </div>
                <br>
                <h1 class="h2" style="color: var(--maroon); font-family: Roboto Slab ">'. $res['title'] .'</h1>   
                <span style="font-style:italic; margin-top:12px">'. $res['category'] .'</span>';
                
                if( $res['edition'] != "none" )
                echo '<span style="padding:0 4px; font-style:italic;"><b> ' . $res['edition'] . ' ' . $res['editionNum'] . '</b></span>';         
                
                if( $res['isbn'])
                    echo '<p style=" font-style:italic;">ISBN:<b> '. $res['isbn'] .'</b></p>';         
        echo '<p style="font-style:italic;">Author/s: <b>' . $res['author'] . '</b></p>';

        if($res['date'] != 0){
            echo '<p style="font-style:italic;">Published on <b>'.  $res['date'] . '</b></p>';
        }

        
        if($res['call_number'] != ''){
            echo '<p style="font-style:italic; ">Call Number: <b> ' .  $res['call_number'] . '</b></p>';
        }

        
        
        if ($res['description']  != null){

            echo '<p style="margin-top:1rem ; font-style:italic;">Description</p>';
            echo '<p style="padding: 0 1rem; font-style:italic;">' . $res['description'] .'</p>';
        }

        echo '<a style="color:white" class="btn btn-primary mt-2" href = "editCatalog.php?id='.$id.'"> Edit Info </a>';

        echo '</div>';
        echo '</div> </div>';
    }


    // DELETE CATALOG INFO
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "deleteInfo"){

        
        $id = (int) $_POST['id'] ?? null;   
        $stm = $PDO->prepare( "SELECT * FROM tbl_items WHERE id = $id");

        $stm->execute();

        $res =  $stm->fetch(PDO::FETCH_ASSOC);
        
        var_dump($res);

        echo ' <div class="div-info" id="div-info">
        <div class="shadow" style="display:flex; justify-content:center; align-items:center; position: absolute; height:100vh; width:100vw; background-color:rgba(0,0,0,0.5); top:0">
            <div class="catalog-info" style="background-color:white; position:relative ;">    
                <div style="position:absolute; top:0; left:0; display:flex; width:100%; justify-content:space-between; background-color: orange;">
                    <span style="padding: 0 1rem; color: white">Catalog Deletion </span>
                    <span onclick="clearHtml(`div-info`)" ><i style="padding: 4px; color:white" class="fa-solid fa-xmark"></i></span>
                </div>
                <br>

                <h1 class="h2">Are you sure you want to delete this catalog?</h1>
                <h1 style="color: var(--maroon); font-weight:bold;  font-family: Roboto Slab ">'. $res['title'] .'</h1>   
                <span style="font-style:italic; margin-top:12px">'. $res['category'] .'</span>';
                
                if( $res['edition'] != "none" )
                echo '<span style="padding:0 4px; font-style:italic;">' . $res['edition'] . ' ' . $res['editionNum'] . '</span>';         
                
                if( $res['isbn'])
                    echo '<p style=" font-style:italic;">ISBN:'. $res['isbn'] .'</p>';         
        echo '<p style="font-style:italic;">Author/s: ' . $res['author'] . '</p>';

        if($res['date'] != 0){
            echo '<p style="font-style:italic;">Published on ' .  $res['date'] . '</p>';
        }
        
        
        if ($res['description']  != null){

            echo '<p style="margin-top:1rem ; font-style:italic;">Description</p>';
            echo '<p class="mb-4" style="padding: 0 1rem; font-style:italic;">' . $res['description'] .'</p>';
        }


  
        echo '<button onclick="deleteCatalog(`'. $id .'`)"  class="btn btn-danger"> Delete </button>
        <button onclick="clearHtml(`div-info`)" class="btn btn-outline-yellow">Cancel</button></div>';
        echo '</div> </div>';
    }

    //DELETE CATALOG
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "deleteCatalog"){

        $id = (int) $_POST['id'];

        $stm = $PDO->prepare("DELETE FROM tbl_items WHERE id = $id");
        $stm->execute();
        echo "Succesfully Deleted";
    }

    //APPROVED ACCOUNT
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "approveAccount"){
        $id = $_POST['id'];
        
        $stm = $PDO -> prepare( "UPDATE tbl_pending_account SET isActivated = 1  WHERE id = $id" );
        $stm ->execute();

        $stm = $PDO -> prepare( "SELECT * FROM tbl_pending_account WHERE id = $id" );
        $stm ->execute();

        $res = $stm -> fetch(PDO::FETCH_ASSOC);
        $name = $res['name'];
        $sid = $res['sid'];
        $email = $res['email'];
        $account_type = $res['account_type'];
        $password = $res['password'];

        if($account_type == "Student")
            $table_name = "tbl_students (lrn, name , email)";
        else if($account_type == "Personnel")
            $table_name = "tbl_personnels ( employee_id, name , email)";


        $stm = $PDO -> prepare( "INSERT INTO $table_name  VALUES (? , ? , ? ) ");
        $stm -> bindValue( 1 , $sid);
        $stm -> bindValue( 2 , $name);
        $stm -> bindValue( 3 , $email);
        $stm ->execute();

        echo "Account was succesfully activated";
        
    }

    //REJECT ACCOUNT
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "rejectAccount"){
        $id = (int) $_POST['id'];
        
        $stm = $PDO -> prepare( "DELETE FROM tbl_pending_account WHERE id = $id" );
        $stm -> execute();
        echo $id;
    }

    //CREATE NEW USER IN SYSTEM
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "btn-createUser"){
        $sid = $_POST['sid'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $account_type = $_POST['accountType'];
        $psw =  $_POST['password'];

        $stm = $PDO -> prepare("SELECT * from tbl_pending_account WHERE sid = '$sid'");
        $stm->execute();

        if( $stm->rowCount() == 0 )
        {
            $stm = $PDO -> prepare( "INSERT INTO tbl_pending_account (sid, name, email, password, isActivated, account_type) VALUES (?,?,?,?,?,?)");
            $stm -> bindValue( 1 , $sid );
            $stm -> bindValue( 2 , $name );
            $stm -> bindValue( 3 , $email );
            $stm -> bindValue( 4 , md5( $psw ) );
            $stm -> bindValue( 5 , 1 );
            $stm -> bindValue( 6 , $account_type );

            if( $stm->execute()){
                if($account_type == "Student")
                    $table_name = "tbl_students (lrn, name , email)";
                else if($account_type == "Personnel")
                    $table_name = "tbl_personnels ( employee_id, name , email)";
            
        
                $stm = $PDO -> prepare( "INSERT INTO $table_name  VALUES (? , ? , ? ) ");
                $stm -> bindValue( 1 , $sid);
                $stm -> bindValue( 2 , $name);
                $stm -> bindValue( 3 , $email);
                

                if ($stm ->execute()){
                    echo '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">
                    Account was created successfully
                    </div>';
                }
    
            }
        }

        else
        {
            echo '<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                Account is already existing
                </div>';
        }
    }

    //APPROVE RESERVATION
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "approveReservation"){
        $reservation_id = $_POST['reservation_id'];


        // set status to approved
        $stm = $PDO -> prepare("UPDATE tbl_reservations SET status = 'Approved' WHERE reservation_id = $reservation_id");

        if($stm -> execute())
            echo "Added new reservation";        

        
        // $stm = $PDO -> prepare("SELECT * FROM tbl_reservations WHERE reservation_id = $reservation_id");
        // $stm -> execute();

        // $res = $stm -> fetch(PDO::FETCH_ASSOC);

        // $book_id = $res['book_id'];
        // echo $book_id;
        // $stm = $PDO -> prepare( " UPDATE tbl_items SET available = available - 1 WHERE id = $book_id" );
        
        // echo $stm -> execute()
    }

    //RETURN A BOOK
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "returnBook"){
        $borrow_id = $_POST['borrow_id'];
        $stm = $PDO -> prepare("UPDATE tbl_borrow SET status = 'Returned' WHERE borrow_id = $borrow_id");
        $stm -> execute();

        $stm = $PDO -> prepare("SELECT * FROM tbl_borrow  WHERE borrow_id = $borrow_id");
        $stm -> execute();

        $res =  $stm-> fetch(PDO::FETCH_ASSOC);

        $book_id = $res['book_id'];

        //back to the availble item
        $stm = $PDO -> prepare( "UPDATE tbl_items SET available = available + 1 WHERE id = $book_id");
        if($stm -> execute())
            echo "Item has returned";

        
    }

    // ACCEPT ALL SELECTED ACCOUNS
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "accept_selected_account"){

        $selected_acccounts = $_POST['selectedAccount'];
        
        foreach($selected_acccounts as $i){
            $id = $i;

            $stm = $PDO -> prepare( "UPDATE tbl_pending_account SET isActivated = 1  WHERE id = $id" );
            $stm ->execute();
    
            $stm = $PDO -> prepare( "SELECT * FROM tbl_pending_account WHERE id = $id" );
            $stm ->execute();
    
            $res = $stm -> fetch(PDO::FETCH_ASSOC);
            $name = $res['name'];
            $sid = $res['sid'];
            $email = $res['email'];
            $account_type = $res['account_type'];
            $password = $res['password'];
    
            if($account_type == "Student")
                $table_name = "tbl_students (lrn, name , email)";
            else if($account_type == "Personnel")
                $table_name = "tbl_personnels ( employee_id, name , email)";
    
    
            $stm = $PDO -> prepare( "INSERT INTO $table_name  VALUES (? , ? , ? ) ");
            $stm -> bindValue( 1 , $sid);
            $stm -> bindValue( 2 , $name);
            $stm -> bindValue( 3 , $email);
            $stm ->execute();
    
        }
        echo "Account was succesfully activated";
        
    }

    // REJECT ALL SELECTED ACCOUNTS    
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "reject_selected_accounts"){
        $selected_acccounts = $_POST['selectedAccount'];
        
        foreach($selected_acccounts as $i){
            $id = (int) $i;
        
            $stm = $PDO -> prepare( "DELETE FROM tbl_pending_account WHERE id = $id" );
            $stm -> execute();
        }
        echo "Selected accounts was succesfully declined";
    }

    // BORROWING ACCOUNT SEARCH
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "borrowSearchAccount"){
        $sid = $_POST['sid'];
        $account_type = $_POST['accountType'];

        if($account_type == "Student")
            $table = "tbl_students WHERE lrn";
        else
            $table = "tbl_personnels WHERE employee_id";

        $stm = $PDO -> prepare(" SELECT * FROM $table  = '$sid' ");
        $stm -> execute();
        if( $stm -> rowCount()){
            $_SESSION['borrower_status'] = true;

            $borrower = $stm -> fetch(PDO::FETCH_ASSOC);

            if( $account_type == "Student" ){
                echo '<p class = "text-white text-center bg-success" >Borrower Information  </p>';
                echo "<p> <b> Name: </b> ". $borrower['name'] . "   </p> ";
                echo "<p> <b> Grade and Section: </b>".  $borrower['grade_section'] . "   </p> ";
                echo "<p> <b> Adviser: </b>".  $borrower['adviser'] . "   </p> ";
            }
            else {
                echo '<p class = "text-white text-center bg-success" >Borrower Information  </p>';

                echo "<p> <b> Name: </b> ". $borrower['name'] . "   </p> ";
                echo "<p> <b> Job Description: </b>".  $borrower['designation'] . "   </p> ";
            }
        } else {
            echo '<p class="text-danger"> Invalid account </p>';
            $_SESSION['borrower_status'] = false;
        }
    }

    
   // BORROWING CATALOG SEARCH
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "findCatalog") {
        $catalog_number =  $_POST['catalog_number'];

        $stm = $PDO -> prepare(" SELECT * FROM tbl_items WHERE id = ?");
        $stm -> bindValue( 1, $catalog_number);
        $stm -> execute();

        if ($stm -> rowCount()){
            $item = $stm -> fetch(PDO::FETCH_ASSOC);

            $reserved = $PDO -> prepare(" SELECT * FROM tbl_reservations WHERE reservation_id = $catalog_number AND status IN ('Pending','Approved') ");
            $reserved -> execute();

            if($item['available'] - $reserved -> rowCount()){
                $status = '<pan class="badge bg-success">Available </span>';
                $_SESSION['catalog_status'] = true;
            }
            else{
                $_SESSION['catalog_status'] = false;
                $status = '<pan class="badge bg-success">Not Available </span>';
            }


            echo '<p class = "text-white text-center bg-success" >Item Information  </p>';
            echo "<p> <b> Tilte: </b> ". $item['title'] . "   </p> ";
            echo "<p> <b> Year </b>".  $item['date'] . "   </p> ";
            echo "<p> <b> Author/s: </b>".  $item['author'] . "   </p> ";
            echo "<p> <b> Available: </b>".  $item['available'] . "   </p> ";
            echo "<p> <b> Reserved: </b>".  $reserved -> rowCount() . "   </p> ";
            echo "<p> <b> Status: </b>".  $status. "   </p> ";
        }
        else {
            $_SESSION['catalog_status'] = false;
            echo "<p class='text-danger'>Invalid catalog number</p>" ;
        }
    }



    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "addBorrow") {
        if($_SESSION['borrower_status'] &&  $_SESSION['catalog_status']){
            echo "<script> window.location.assign('sda.php') </script>";
            echo "Adas";
        }
        else {
        }
    }
    
    
    // ============ USER ACTIONS ============= //
    //SIGN UP
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "btn-signup"){
        $sid = $_POST['sid'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $account_type = $_POST['accountType'];
        $psw =  $_POST['password'];

        $image = $_FILES['imgid'];

        $imgName =  date("Ymd") . $image['name'];
        $imageTemp   = $image['tmp_name'];
      
        //create a path destination 
        // FORMAT: image/uploads/<vkey folder>/image.jpg
        $path =  "/images/ids/";
      
        //save and upload file
        move_uploaded_file($imageTemp, __DIR__.$path.'/'.$imgName);

        $stm = $PDO -> prepare("SELECT * from tbl_pending_account WHERE sid = '$sid'");
        $stm->execute();

        if( $stm->rowCount() == 0 )
        {
            $stm = $PDO -> prepare( "INSERT INTO tbl_pending_account (sid, name, email, password,account_type , imgid) VALUES (?,?,?,?,?,?)");
            $stm -> bindValue( 1 , $sid );
            $stm -> bindValue( 2 , $name );
            $stm -> bindValue( 3 , $email );
            $stm -> bindValue( 4 , md5( $psw ) );
            $stm -> bindValue( 5 , $account_type);
            $stm -> bindValue( 6 , $path . '/' . $imgName );

            if( $stm->execute()){
                echo '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">
                Account created succesfully, admin will review your details.
            </div>';
            }
        }
        else
        {
            echo '<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                LRN is already registered.
            </div>';
        }
    }

    // LOGIN
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "login"){
        
        $lrn = $_POST['lrn'];
        $password = md5( $_POST['password'] );

        $stm = $PDO -> prepare( "SELECT * FROM tbl_pending_account WHERE (sid = ?  OR email = ? ) AND password = ?" );
        $stm -> bindValue( 1 , $lrn );
        $stm -> bindValue( 2 , $lrn );
        $stm -> bindValue( 3 , $password );

        $stm -> execute();

        if( $stm -> rowCount() == 1){
            $res = $stm -> fetch(PDO::FETCH_ASSOC);

            if( $res['isActivated'] == 1 ){
                $_SESSION['user'] = $res;
                $_SESSION['user_id'] = $res['id'];

                echo "Login Successfully";
            } 
            else{
                echo "Your account is not yet activated";
            }
        } else {
            echo "Invalid LRN or assword";
        }
    }

    //USER SEARCH
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "user-search" ){

        $keyword = $_POST['keyword'];
        $stm = $PDO ->prepare( "SELECT * FROM  tbl_items WHERE title LIKE '%$keyword%' OR author LIKE '%$keyword%' OR genre LIKE '%$keyword%' ");
        $stm -> execute();

        $res = $stm -> fetchAll(PDO::FETCH_ASSOC);
        if( count($res) > 0 ) {
            foreach ($res as $i){
                echo '<div class="col-12 mt-4">
                        <div class="price-card ">
                            <h2>' . $i['title']. '</h2>
                            <p class="fst-italic">' . $i['category'];  if( $i['edition']  != 'none' ) echo $i['edition'] . ' ' . $i['editionNum'] . '</p>
                            <p>Status:'; if($i['available'] > 0){ echo '<span class="badge rounded-pill bg-success">Available</span>'; } else { echo '<span class="badge rounded-pill bg-danger">Not Available</span>';} echo '</p>
                            <ul class="pricing-offers mt-2">
                                <li><i class="fa-solid fa-feather-pointed me-2"></i>Author:. '. $i['author'] . '</li>
                                <li><i class="fa-brands fa-leanpub me-2"></i>Publisher: ' . $i['publisher'] . ' </li>
                                <li><i class="fa-solid fa-calendar-day me-2"></i>Publication Year: ' .  $i['date'] . ' </li>
                                <li><i class="fa-solid fa-signature me-2"></i>Genre: ' . $i['genre'] . ' </li>
                                <li><i class="fa-solid fa-tag me-2"></i>Call Number: ' . $i['call_number'] . ' </li>
                                <li><i class="fa-solid fa-hashtag me-2"></i>Catalog Number: '. $i['id'] .' </li>
                                <li>
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne'. $i['id'] .'" >
                                            Description
                                        </button>
                                        </h2>
                                        <div id="collapseOne' . $i['id'] .'" class="accordion-collapse collapsed collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            '.$i['description'] .'
                                        </div>
                                        </div>
                                    </div>
                                </div>      
                                </li>
                            </ul>

                            <a href="./reserve.php?book_id= '.$i['id'].'" class="btn btn-primary btn-mid mx-2 '; if($i['available'] == 0) echo "disabled"; echo '"  >Request</a>
                            <a onclick="bookmark(`'. $i['id'] . '`)" class="btn btn-primary btn-mid "  ><i class="fa-solid fa-bookmark me-1"></i>Add to Bookmark</a>
                        </div>
                    </div>';
            }
        }
    }

    //USER ADDBOOKMARK
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "bookmark" ){
        $item_id = (int) $_POST['id'];
        $user_id = (int) $user['id'];

        $stm = $PDO -> prepare( "SELECT * FROM tbl_bookmarks WHERE item_id = $item_id AND user_id = $user_id" );
        $stm -> execute();

        //check if bookmarked already
        if ( $stm -> rowCount() == 0 )
            {
                //add to bookmark
                $stm = $PDO -> prepare( "INSERT INTO tbl_bookmarks(item_id , user_id ) VALUES ($item_id ,  $user_id)");
                $stm -> execute();

                echo "Successfully saved to your bookmarks.";
            }
        else 
            {
                echo "This book is already in your bookmarks";
            }
    }

    //USER REMOVE BOOKMARK
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "removeBookmark" ){
        $user_id = (int) $user['id'];
        $item_id = (int) $_POST['id'];
        
        $stm = $PDO -> prepare( " DELETE FROM tbl_bookmarks WHERE user_id = $user_id AND item_id = $item_id" );
        
        if ($stm -> execute()){
            echo "Bookmark has been removed succesfully";
        }
    }

    // ============ EVENTS ACTIONS ============= //

    // ADMIN
    //expiration of active reservations
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "check_reservation_date" ){
        $stm = $PDO -> prepare( "SELECT * FROM tbl_reservations WHERE status = 'Approved' AND ADDDATE( reservation_date , INTERVAL 1 DAY) < CURRENT_TIMESTAMP" );
        $stm -> execute();
        
        $res = $stm -> fetchAll(PDO::FETCH_ASSOC);
        
        foreach($res as $i){
            $stm = $PDO -> prepare("UPDATE tbl_reservations SET status = 'Expired' WHERE reservation_id = ?");
            $stm -> bindValue(1 , $i['reservation_id']);
            
            echo $stm -> execute();
        }
        
        echo "working";
        
    }
    
    //borrowed overdue
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "check_reservation_date" ){
        $stm = $PDO -> prepare( "SELECT * FROM tbl_borrow WHERE status = 'Borrow' AND due_date < CURRENT_TIMESTAMP" );
        $stm -> execute();
        
        $res = $stm -> fetchAll(PDO::FETCH_ASSOC);
        
        foreach($res as $i){
            $stm = $PDO -> prepare("UPDATE tbl_borrow SET status = 'Overdue' WHERE borrow_id = ?");
            $stm -> bindValue(1 , $i['borrow_id']);
            
            echo $stm -> execute();
        }
        
        echo "overdue";
    }
    
    //check pending accounts
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "check_pending_account" ){
        $stm = $PDO -> prepare( "SELECT * FROM tbl_pending_account WHERE isActivated = 0" );
        $stm -> execute();
        $nPendingAccount = $stm->rowCount();
        
        if( $stm -> rowCount() > 0 )
        echo ' <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        ' . $stm->rowCount() . '
        </span>';
    }
    
    
    //check pending accounts
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "check_pending_reservations" ){
        $stm = $PDO -> prepare( "SELECT * FROM tbl_reservations WHERE status = 'Pending'" );
        $stm -> execute();
        
        if($stm->rowCount()){
            echo ' <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            ' . $stm->rowCount() . '
            </span>';
        }
    }

    // USER

    //count user reervation 
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "user_reservation_notifcation_count" ){
        $sid = $user['sid'];
        $stm  = $PDO -> prepare("SELECT * FROM tbl_reservations WHERE status = 'Approved' AND borrower_sid = $sid");
        $stm -> execute();

        if( $stm -> rowCount() )
            echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    '.$stm -> rowCount() .'    
                  </span>';
    }

    //count user borrowed
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "user_borrow_notifcation_count" ){
        $sid = $user['sid'];
        $stm  = $PDO -> prepare("SELECT * FROM tbl_borrow WHERE status IN('Borrow', 'Overdue' ) AND borrower_sid = $sid");
        $stm -> execute();

        if( $stm -> rowCount() )
            echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    '.$stm -> rowCount() .'    
                  </span>';
    }



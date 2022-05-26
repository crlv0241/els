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
                <div style="position:absolute; top:0; left:0; display:flex; width:100%; justify-content:space-between; background-color: var(--maroon);">
                    <span style="padding: 0 1rem; color: white">Catalog Information </span>
                    <span onclick="clearHtml(`div-info`)" ><i style="padding: 4px; color:white" class="fa-solid fa-xmark"></i></span>
                </div>
                <br>
                <h1 class="h2" style="color: var(--maroon); font-family: Roboto Slab ">'. $res['title'] .'</h1>   
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
        $lrn = $_POST['lrn'];
        
        $stm = $PDO -> prepare( "UPDATE tbl_pending_account SET isActivated = 1  WHERE sid = '$lrn'" );
        $stm ->execute();

        $stm = $PDO -> prepare( "SELECT * FROM tbl_pending_account WHERE sid = '$lrn'" );
        $stm ->execute();

        $res = $stm -> fetch(PDO::FETCH_ASSOC);
        $name = $res['name'];
        $lrn = $res['sid'];
        $email = $res['email'];
        $password = $res['password'];

        $stm = $PDO -> prepare( "INSERT INTO tbl_accounts(lrn, name , email, password)  VALUE (? , ? , ? , ?) ");
        $stm -> bindValue( 1 , $lrn);
        $stm -> bindValue( 2 , $name);
        $stm -> bindValue( 3 , $email);
        $stm -> bindValue( 4 , $password);
        $stm ->execute();

        echo "Account was succesfully activated";
        
    }


    // ============ USER ACTIONS ============= //
    //SIGN UP
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "btn-signup"){
        $sid = $_POST['sid'];
        $name = $_POST['name'];
        $email = $_POST['email'];
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
            $stm = $PDO -> prepare( "INSERT INTO tbl_pending_account (sid, name, email, password, imgid) VALUES (?,?,?,?,?)");
            $stm -> bindValue( 1 , $sid );
            $stm -> bindValue( 2 , $name );
            $stm -> bindValue( 3 , $email );
            $stm -> bindValue( 4 , md5( $psw ) );
            $stm -> bindValue( 5 , $path . '/' . $imgName );

            if( $stm->execute()){
                echo "1";
            }
        }

        else
        {
            echo "2";
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

                echo "Login Successfully";
                
            } 
            else{
                echo "Your account is not yet activated";
            }
        } else {
            echo "Invalid LRN or assword";
        }
    }

    //CREATE NEW USER IN SYSTEM
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "btn-createUser"){
        $sid = $_POST['sid'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $psw =  $_POST['password'];

        $stm = $PDO -> prepare("SELECT * from tbl_accounts WHERE lrn = '$sid'");
        $stm->execute();

        if( $stm->rowCount() == 0 )
        {
            $stm = $PDO -> prepare( "INSERT INTO tbl_accounts (lrn, name, email, password) VALUES (?,?,?,?)");
            $stm -> bindValue( 1 , $sid );
            $stm -> bindValue( 2 , $name );
            $stm -> bindValue( 3 , $email );
            $stm -> bindValue( 4 , md5( $psw ) );

            if( $stm->execute()){
                echo '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">
                Account was created successfully
                </div>';
            }
        }

        else
        {
            echo '<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                Account is already existing
                </div>';
        }
    }


    //USER SEARCH
    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "user-search" ){
        $keyword = $_POST['keyword'];
        $stm = $PDO ->prepare( "SELECT * FROM  tbl_items WHERE title LIKE '%$keyword%' OR author LIKE '%$keyword%' OR genre LIKE '%$keyword%' ");
        $stm -> execute();

        $res = $stm -> fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($res);
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
<?php 
    require_once "./db/connecttion.php";



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

    if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['action'] == "deleteCatalog"){

        $id = (int) $_POST['id'];

        $stm = $PDO->prepare("DELETE FROM tbl_items WHERE id = $id");
        $stm->execute();
        echo "Succesfully Deleted";
    }

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
            $stm -> bindValue( 4 , md5($psw) );
            $stm -> bindValue( 5 , $path . '/' . $imgName );

            if( $stm->execute()){
                echo "Account created successfully, please wait for the admin for activation";
            }
        }

        else
        {
            echo "Account is already existing";
        }


    }



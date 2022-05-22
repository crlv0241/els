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
                
        echo '<p style="font-style:italic;">Author/s: ' . $res['author'] . '</p>';

        if($res['date'] != 0){
            echo '<p style="font-style:italic;">Published on ' .  $res['date'] . '</p>';
        }
        
        
        if ($res['description']  != null){

            echo '<p style="margin-top:1rem ; font-style:italic;">Description</p>';
            echo '<p style="padding: 0 1rem; font-style:italic;">' . $res['description'] .'</p>';
        }

        echo '<a style="color:white" class="btn btn-primary" href = "editCatalog.php?id='.$id.'"> Edit Info </a>';

        echo '</div>';
        echo '</div> </div>';
    }
<?php
    // session_start();

    // $client = $_SESSION['client'] ?? null;

    // if ( !isset($client) )
    // {
    //     header("location:login.php");
    // }

    require_once "../../db/connecttion.php";

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
<body>
<script>
// /* To Disable Inspect Element */
// $(document).bind("contextmenu",function(e) {
//  e.preventDefault();
// });

// $(document).keydown(function(e){
//     if(e.which === 123){
//        return false;
//     }
// });

// document.onkeydown = function(e) {
// if(event.keyCode == 123) {
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'F'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
// return false;
// }
// }
</script>
    <header>
        <?php require_once "./components/header.php" ?>
    </header>
    
    <div class="d-flex nav-content-wrapper">
        <nav id="main-nav" >
            <?php require_once "./components/nav.php" ?>
        </nav>
        
        <div class="dashboard">
		
            <section class="books-table" style="height:calc(100vh - 140px)">
                <h1 style="background-color: var(--second); font-weight:bold; padding:.5rem;text-align:center; color:black">Active Accounts</h1>
                    <a href="addAccount.php" class="btn btn-outline-success my-2" style="border:none"> <i class="fa-solid fa-user-plus"></i> Add Account</a>
                    <table id="employee_data" class="mt-3 border table  table-hover employee_data" >
					<thead >
						<tr>
						<th  class="border" scope="col">LRN</th>
						<th  class="border" scope="col">Full Name</th>
						<th  class="border" scope="col">Email</th>
						</tr>
					</thead>
					<tbody>

                    <!-- GET THE BOOKS  -->
                    <?php 
                        $stm = $PDO -> prepare("SELECT * FROM tbl_pending_account WHERE isActivated = 1");
                        $stm -> execute();
                        while( $row = $stm->fetch(PDO::FETCH_ASSOC)) :
                    ?>
                        <tr>
                            <td   class="border"><?php echo $row['sid'] ?></td>
                            <td   class="border"><?php echo $row['name'] ?></td>
                            <td   class="border"><?php echo $row['email'] ?></td>
                        </tr>
                    <?php endwhile; ?>
					</tbody>
				</table>
			</section>
        </div>
    </div>
   

    <!-- SAMPLE POP UP INFO -->
    <div class="div-info" id="div-info">
        <!-- <div class="shadow" style="display:flex; justify-content:center; align-items:center; position: absolute; height:100vh; width:100vw; background-color:rgba(0,0,0,0.5); top:0">
            <div class="catalog-info" style="background-color:white; position:relative ;">    
                <div style="position:absolute; top:0; left:0; display:flex; width:100%; justify-content:space-between; background-color: var(--maroon);">
                    <span style="padding: 0 1rem; color: white">Catalog Information </span>
                    <span onclick="clearHtml('div-info')" ><i style="padding: 4px; color:white" class="fa-solid fa-xmark"></i></span>
                </div>
                <br>
                <h1 class="h2" style="color: var(--maroon); font-family: Roboto Slab, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif ">Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet..</h1>   
                <p style="font-style:italic; margin-top:12px">Category</p>
                <p>Volume 1</p>
                <p>Author/s:  </p>
                <p>Published on 2021</p>
                <p style="margin-top:1rem ;">Description</p>
                <p style="padding: 0 1rem;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore temporibus delectus ut neque voluptatem, similique at minus molestias eligendi explicabo! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi quo hic architecto ipsam tempore facere modi, ducimus sunt praesentium voluptatibus.</p>
            </div>
        </div> -->
        <!-- <div class="shadow" style="display:flex; justify-content:center; align-items:center; position: absolute; height:100vh; width:100vw; background-color:rgba(0,0,0,0.5); top:0">
            <div class="catalog-info" style="background-color:white; position:relative ;">    
                <div style="position:absolute; top:0; left:0; display:flex; width:100%; justify-content:space-between; background-color: orange;">
                    <span style="padding: 0 1rem; color: white"> Catalog Deletion </span>
                    <span onclick="clearHtml('div-info')" ><i style="padding: 4px; color:white" class="fa-solid fa-xmark"></i></span>
                </div>
                <br>
                
                <h1 class="h2">Are you sure you want to delete this catalog?</h1>
                <h1 class="bold" style="color: var(--maroon); font-family: Roboto Slab, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif ">Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet..</h1>   
                <p style="font-style:italic; margin-top:12px">Category</p>
                <p>Volume 1</p>
                <p>Author/s:  </p>
                <p>Published on 2021</p>
                <p style="margin-top:1rem ;">Description</p>
                <p style="padding: 0 1rem;" class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore temporibus delectus ut neque voluptatem, similique at minus molestias eligendi explicabo! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quasi quo hic architecto ipsam tempore facere modi, ducimus sunt praesentium voluptatibus.</p>
                <button class="btn btn-danger">Delete</button>
                <button class="btn btn-outline-yellow">Cancel</button>
            </div>
        </div> -->
    </div>

    <script>

        function clearHtml(classname){
            $('#'+classname + ' .shadow').fadeOut("fast");
        }

        //get info
        $(".info").each(function() {
            $(this).click(function(){
                let id = this.dataset.id;
                $.ajax({
                    dataType: "html",
                    method: "POST",
                    url:"../../actions.php",
                    data: {
                        action:"getInfo",
                        id: id,
                    },
                    success: function(data){
                        document.getElementById("div-info").innerHTML = data;
                    },
                });
             }) 
        });   
        
        
        //get deletion warning message
        $(".deleteCatalog").each(function() {
            $(this).click(function(){
                let id = this.dataset.id;
                $.ajax({
                    dataType: "html",
                    method: "POST",
                    url:"../../actions.php",
                    data: {
                        action:"deleteInfo",
                        id: id,
                    },
                    success: function(data){
                        document.getElementById("div-info").innerHTML = data;
                    },
                });
             }) 
        });


        function deleteCatalog(id){
            //get deletion warning message
                console.log("asd");
                $.ajax({
                    dataType: "text",
                    method: "POST",
                    url:"../../actions.php",
                    data: {
                        action:"deleteCatalog",
                        id: id,
                    },
                    success: function(data){
                        console.log(data);
                        $('.shadow').fadeOut("fast");
                        window.location.reload();
                    },
                });
        }
        

        // function getInfo( id ){
        //     console.log(id);
        //     $.ajax({
        //         dataType: "text",
        //         method: "POST",
        //         url:"../../actions.php",
        //         data: {
        //             action:getInfo,
        //             id:id,
        //         },
        //         success: function(data){
        //             console.log(data);
        //         },
        //         error: function(status){
        //             console.log(status);
        //         }
        //     });
        // }
    </script>

    <script>
        $( "#nav-toggler" ).click(function() {
            $( "#main-nav" ).slideToggle( "fast" );
        });
    </script>

	<script>  
		$(document).ready(function(){  
			$('#employee_data').DataTable({
                responsive:true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder:"Search a account ...",
                }
            });
            
            $('div.dataTables_length select').removeClass("input-sm");

            $(" #nav-item-approved ").addClass( "active")
            $(" #nav-item-approved ").click(function (e){
                e.preventDefault();
            } );
            

		});  

	</script>  
</body>
</html>
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
    <title>Admin | EARIST LIBRARY</title>

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
    <header>
        <?php require_once "./components/header.php" ?>
    </header>
    
    <div class="d-flex nav-content-wrapper">
        <nav id="main-nav" >
            <?php require_once "./components/nav.php" ?>
        </nav>
        
        <div class="dashboard">
            
            <section class="filter">
			
                <h4 class="h4">Filter</h4>
            </section>
			
			

            <section class="books-table" style="height:calc(100vh - 140px)">
                    <h1 style="background-color: var(--maroon); padding:.5rem;text-align:center; color:white">Catalogs</h1>
                    <table id="employee_data" class="mt-3 border table  table-hover employee_data" >
					<thead>
						<tr>
						<th  class="border" scope="col">Title</th>
						<th  class="border" scope="col">Authors</th>
						<th  class="border" scope="col">Genre</th>
						<th  class="border" scope="col">QTY</th>
						<th  class="border" scope="col">Available</th>
						<th  class="border" scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>

                    <!-- GET THE BOOKS  -->
                    <?php 
                        $stm = $PDO -> prepare("SELECT * FROM tbl_items");
                        $stm -> execute();
                        while( $row = $stm->fetch(PDO::FETCH_ASSOC)) :
                    ?>
                        <tr>
                            <td   class="border"><?php echo $row['title'] ?></td>
                            <td   class="border"><?php echo $row['author'] ?></td>
                            <td   class="border"><?php echo $row['genre'] ?></td>
                            <td   class="border"><?php echo $row['quantity'] ?></td>
                            <td   class="border"><?php echo $row['quantity'] ?></td>
                            <td  class="border">
                                <div class="actions" style="display: flex; justify-content:space-between;">
                                    <i data-id="<?php echo $row['id'] ?>" class="info fa-regular fa-circle-question"></i>
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    <i class="fa-regular fa-trash-can"></i>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                     
					</tbody>
				</table>

			</section>
        </div>
    </div>
   
    <div class="div-info">
        <!-- <div class="shadow" style="display:flex; justify-content:center; align-items:center; position: absolute; height:100vh; width:100vw; background-color:rgba(0,0,0,0.5); top:0">
            <div class="catalog-info" style="background-color:white ;">
                <h1>sample title</h1>
                <table>
                    <tr>
                        <th>Author</th>
                        <td>Names C Name</td>
                    </tr>
                </table>
            </div>
        </div> -->
    </div>

    <script>

        $(".info").each(function() {
            $(this).click(function(){
                let id = this.dataset.id;
                $.ajax({
                    dataType: "text",
                    method: "POST",
                    url:"../../actions.php",
                    data: {
                        action:"getInfo",
                        id:id,
                    },
                    success: function(data){
                        console.log(data);
                    },
                });
             }) 
        });                   

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
                "lengthMenu": [
                    [10,25,505,-1],
                    [10,25,50, "All"]
                 ],
                 "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ 5 ] }, 
                ],
                responsive:true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder:"Search a title ...",
                }
            });
            
            $('div.dataTables_length select').removeClass("input-sm");

            $(" #nav-item-library ").addClass( "active")
            $(" #nav-item-library ").click(function (e){
                e.preventDefault();
            } );
            

		});  


        // $('div.dataTables_length select').ready(function(){
        //     $('div.dataTables_length select').addClass("Asdsa");
        // });
	</script>  
</body>
</html>
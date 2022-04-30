<?php
    session_start();

    $client = $_SESSION['client'] ?? null;

    if ( !isset($client) )
    {
        header("location:login.php");
    }


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
				<h2 class="h2 text-center">EARIST LIBRARY</h2>
				<table id="employee_data" class="table admin-library-table" >
					<thead>
						<tr>
						<th scope="col">ID</th>
						<th style="display:block;width: 200px;" scope="col">Title</th>
						<th scope="col">Stock</th>
						<th scope="col">Lended</th>
						<th scope="col">Status</th>
						</tr>
					</thead>
					<tbody>

				
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, aperiam!</td>
                            <td>0</td>
                            <td>1</td>
                            <td>Available</td>
                        </tr>
				
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, aperiam!</td>
                            <td>0</td>
                            <td>1</td>
                            <td>Available</td>
                        </tr>
				
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, aperiam!</td>
                            <td>0</td>
                            <td>1</td>
                            <td>Available</td>
                        </tr>
				
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, aperiam!</td>
                            <td>0</td>
                            <td>1</td>
                            <td>Available</td>
                        </tr>
				
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, aperiam!</td>
                            <td>0</td>
                            <td>1</td>
                            <td>Available</td>
                        </tr>
				
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, aperiam!</td>
                            <td>0</td>
                            <td>1</td>
                            <td>Available</td>
                        </tr>
				
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, aperiam!</td>
                            <td>0</td>
                            <td>1</td>
                            <td>Available</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, aperiam!</td>
                            <td>0</td>
                            <td>1</td>
                            <td>Available</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, aperiam!</td>
                            <td>0</td>
                            <td>1</td>
                            <td>Available</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, aperiam!</td>
                            <td>0</td>
                            <td>1</td>
                            <td>Available</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, aperiam!</td>
                            <td>0</td>
                            <td>4</td>
                            <td>Available</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, aperiam!</td>
                            <td>0</td>
                            <td>1</td>
                            <td>Available</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, aperiam!</td>
                            <td>0</td>
                            <td>1</td>
                            <td>Available</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, aperiam!</td>
                            <td>0</td>
                            <td>1</td>
                            <td>Available</td>
                        </tr>
						
					</tbody>
				</table>

			</section>
        </div>
    </div>

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
                responsive:true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder:"Search a tiitle",
                }
            });
            
            $('div.dataTables_length select').removeClass("input-sm");
		});  


        // $('div.dataTables_length select').ready(function(){
        //     $('div.dataTables_length select').addClass("Asdsa");
        // });
	</script>  
</body>
</html>
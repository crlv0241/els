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
    <header>
        <?php require_once "./components/header.php" ?>
    </header>
    
    <div class="d-flex nav-content-wrapper">
        <nav id="main-nav" >
            <?php require_once "./components/nav.php" ?>
        </nav>
        
        <div class="dashboard">
		
            <section class="books-table" style="height:calc(100vh - 140px)">
                    <h1 style="background-color: var(--maroon); padding:.5rem;text-align:center; color:white">Pending Accounts</h1>
                    <table id="employee_data" class="mt-3 border table  table-hover employee_data" >
					<thead >
						<tr>
                            <th  class="border" scope="col">LRN</th>
                            <th  class="border" scope="col">Name</th>
                            <th  class="border" scope="col">Email</th>
                            <th  class="border" scope="col">Image Proof</th>
                            <th  class="border" scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>

                    <!-- GET THE BOOKS  -->
                    <?php 
                        $stm = $PDO -> prepare("SELECT * FROM tbl_pending_account WHERE isActivated = 0");
                        $stm -> execute();
                        while( $row = $stm->fetch(PDO::FETCH_ASSOC)) :
                    ?>
                        <tr>
                            <td   class="border"><?php echo $row['sid'] ?>      </td>
                            <td   class="border"><?php echo $row['name'] ?>     </td>
                            <td   class="border"><?php echo $row['email'] ?>    </td>
                            <td   class="border"> <img style="cursor:zoom-in" width="100" class="fullscreen" onClick="zoomin(`../../<?php echo $row['imgid'] ?>`)" src="../../<?php echo $row['imgid'] ?>" alt="">   </td>
                            <td   class="border" style="width: 100px;" >
                                <div style="display: flex ; height:100%; justify-content:space-around; gap:1rem; align-items:center">
                                    <button class="btn btn-outline-success" onclick="approveAccount(`<?php echo $row['sid']?>`)" ><i class="fa-solid fa-user-check"></i></i> Activate </button>
                                    <button class="btn btn-outline-danger" > <i class="fa-solid fa-user-xmark"></i> Decline </button>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>

                </tbody>
            </table>
            
                <?php if($stm->rowCount() == 0 ): ?>
                    <p class="text-center">
                        No account requests
                    </p>
                <?php endif; ?>
			</section>
        </div>
    </div>

    <div id="img-prev">
       
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
        function approveAccount(lrn){
            $.ajax({
                method: "POST",
                url: "../../actions.php",
                data: {
                    action: "approveAccount",
                    lrn : lrn,
                },

                success: function(response){
                    console.log( response );

                    alert(response);

                    window.location.reload();
                }
            });
        }
    </script>

    <script>
        function zoomin(src){
            document.getElementById("img-prev").innerHTML = `
            <div onclick="zoomout()" style="display:flex; justify-content:center; align-items:center; position:fixed; top:0; left:0; background: rgba(0,0,0,0.5); height:100vh; width: 100vw">
            <div style="width:80%; height:70vh; display:flex; justify-content:center; align-items:center;">
                <img style=" height:100%"  src="${src}" alt="">
            </div>
        </div>
            `;
        }

        function zoomout(){
            document.getElementById("img-prev").innerHTML = ``;
        }
    </script>

	<script>  
		$(document).ready(function(){  
            
            $('div.dataTables_length select').removeClass("input-sm");

            $(" #nav-item-pending ").addClass( "active")
            $(" #nav-item-pending ").click(function (e){
                e.preventDefault();
            });
		});  


        // $('div.dataTables_length select').ready(function(){
        //     $('div.dataTables_length select').addClass("Asdsa");
        // });
	</script>  
</body>
</html>
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
    <script>
        let rejectId;
    </script>
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
                    <div class="row">

                        <!-- GET ACTIVE RESERVATIONS COUNT -->
                        
                        <?php 
                            $activeReservation = $PDO -> prepare( "SELECT * FROM tbl_borrow WHERE status = 'Overdue' " );
                            $activeReservation -> execute();
                            
                        ?>
                        <h1  style="cursor:pointer; background-color: var(--second); padding:.5rem;text-align:center; color:black">Borrow</h1>

                        <h1 class="col-6" style="cursor:pointer; background-color: gray; padding:.5rem;text-align:center; color:white">  <a class="text-white" href="./borrow.php"> Borrowed </a></h1>
                        <h1 class="col-6" style="background-color: var(--maroon); padding:.5rem;text-align:center; color:white"> <a class="text-white" href="./overdueBorrow.php"> Overdue [<?php echo $activeReservation -> rowCount(); ?>] </a></h1>

                    </div>
                    <table id="employee_data" class="mt-3 border table  table-hover employee_data" >
					<thead >
						<tr>
                            <th  class="border" scope="col">Transaction ID</th>
                            <th  class="border" scope="col">Name</th>
                            <th  class="border" scope="col">Item</th>
                            <th  class="border" scope="col">Days</th>
                            <th  class="border" scope="col">Borrowed Date</th>
                            <th  class="border" scope="col">Due Date</th>
                            <th  class="border" scope="col">Accession</th>
                            <th  class="border" scope="col">Action</th>
						</tr>
					</thead>
					<tbody>

                    <!-- GET THE BOOKS  -->
                    <?php 
                        $stm = $PDO -> prepare("SELECT * FROM tbl_borrow
                                                 INNER JOIN tbl_pending_account
                                                 ON tbl_borrow.borrower_sid = tbl_pending_account.sid
                                                 INNER JOIN tbl_items
                                                 ON tbl_borrow.book_id = tbl_items.id
                                                 WHERE status = 'Overdue'");
                        $stm -> execute();
                        while( $row = $stm->fetch(PDO::FETCH_ASSOC)) :
                    ?>
                        <tr id="tr<?php echo $row['id'] ?>">
                            <td   class="border"><?php echo $row['borrow_id'] ?> </td>
                            <td   class="border"><?php echo $row['name'] ?>     </td>
                            <td   class="border"><?php echo $row['title'] ?>     </td>
                            <td   class="border"><?php echo $row['days'] ?>     </td>
                            <td   class="border"><?php $d = new DateTime($row['borrow_date']); echo  $d -> format("M d-Y h:i A") ?>   </td>
                            <td   class="border"><?php  $d = new DateTime($row['due_date']); echo  $d -> format("M d-Y h:i A") ?>   </td>
                            <td   class="border"><?php echo $row['accession_id'] ?>   </td>
                            <!-- //count the reserved active reservations -->
               
                            <td   class="border" style="width: 100px;" >
                                <div style="display: flex ; height:100%; justify-content:space-around; gap:1rem; align-items:center">
                                    <button class="btn btn-outline-success" onclick="returnBook(`<?php echo $row['borrow_id']?>`)" > Returned </button>
                                    <!-- <button class="btn btn-outline-danger" onclick="rejectId = <?php echo $row['id'] ?>" data-bs-toggle = "modal" data-bs-target = "#rejectModal"  >  Decline </button> -->
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>

                </tbody>
            </table>
            
                <?php if($stm->rowCount() == 0 ): ?>
                    <p class="text-center">
                        No reservation requests
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

    <!-- MODAL REJECT ACCOUNT -->
    <div class="modal fade" id="rejectModal" data-bs-backdrop="static">
        <div class="modal-dialog">
                <div class="modal-content" style="margin-left:0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Decline account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label">Reason  of declination</label>
                        <input type="text" name="reason"  id="reason" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="btn-reject"    data-bs-dismiss="modal" class="btn btn-danger">Reject Account</button>
                    </div>
                </div>
        </div>
    </div>

    
    <!-- RETURN BOOK -->
    <script>
        function returnBook(borrow_id){
            $.ajax({
                method:"POST",
                dataType: "text",
                data:{
                    action:"returnBook",
                    borrow_id: borrow_id
                },
                url: "../../actions.php",
                success: function(response){
                    alert(response);
                    window.location.reload();
                }
            });
        }
    </script>

    <!-- REJECT ACCOUNT -->
    <script>
        let rejectModal = document.getElementById('btn-reject');
        
        // <!-- LISTENER ON MODAL  -->
        rejectModal.addEventListener('click',function(){
            console.log(rejectId);
            $.ajax({
                method: "POST",
                url: "../../actions.php",
                dataType: "text",
                data: {
                    action: "rejectAccount",
                    id : rejectId,
                },

                success: function(response){
                    window.location.reload();
                }
            });
        })
    </script>

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

    <!-- ARPPOVED ACCOUNT -->
    <script>
        function approveReservation(reservation_id){
            console.log(reservation_id);
            $.ajax({
                method: "POST",
                url: "../../actions.php",
                data: {
                    action: "approveReservation",
                    reservation_id : reservation_id,
                },

                success: function(response){
                    console.log( response );

                    alert(response);

                    window.location.reload();
                }
            });
        }
    </script>



    <!-- ZOOM IN ON IMAGE -->
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


    <!-- NAV -->
	<script>  
		$(document).ready(function(){  
            
            $('div.dataTables_length select').removeClass("input-sm");

            $(" #nav-item-borrow").addClass( "active")
        
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
                    searchPlaceholder:"Search name",
                }
            });
		});  

	</script> 
</body>
</html>
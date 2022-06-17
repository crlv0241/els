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
  
    <link rel="stylesheet" href="../../css/jquery.passwordRequirements.css">

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
            <div class="col-lg-7 ">
                <h2 class="h2">New Borrow</h2>
                <form class="form-control shadow" id="formBorrow" method="POST" >
                    <h2>User Information</h2>
                    <div id="div-info"></div>
                    <select required class="form-control" name="accountType" id="accountType">
                        <option value="">-- Select account type</option>
                        <option value="Student">Student</option>
                        <option value="Personnel">Teacher / Personnel</option>
                    </select>

                    <div id="form-inputs">
                    </div>
                    <div class="p-2" id="borrower_info">
                        
                    </div>
                    <div class="p-2" id="item_info">
                        
                    </div>
                    <input class="form-control mt-2" type="hidden" name="action" value="addBorrow">

                    <input class="btn btn-primary mt-4" id="btn_borrow_submit" style="background-color: green ;" type="submit"  value="Borrow" />
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL  ADD NEW BORROW -->
    <div class="modal fade" id="addBorrowModal" data-bs-backdrop="static">
        <div class="modal-dialog">
                <div class="modal-content" style="margin-left:0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Confirm Transaction</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label">Select the confirm button to proceed. </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="btn-reject"    data-bs-dismiss="modal" class="btn btn-success">Confirm</button>
                    </div>
                </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../../js/jquery.passwordRequirements.min.js"></script>
    <script>
        function clearHtml(classname){
            $('#'+classname + ' .shadow').fadeOut("fast");
        }
    </script>

    <!-- toggle placeholder account type -->
    <script>
        document.getElementById("accountType").addEventListener('change', function(){
            document.getElementById("borrower_info").innerHTML =  ``;
            document.getElementById("item_info").innerHTML =  ``;
            if(this.value == "Student"){
                document.getElementById("form-inputs").innerHTML = `
                        <input onkeyup="findAccount(this , 'Student' )" id="student_sid" class="form-control mt-2" type="text" name="sid" placeholder="Learner Reference Number" required />
                        <input  onkeyup="findCatalog(this)" required type="number" name="catalog_number" placeholder="Catalog Number" class="form-control mt-2">

                `;
            }
            else if(this.value == "Personnel" ){
                document.getElementById("form-inputs").innerHTML = `
                        <input  onkeyup="findAccount(this , 'Employee' )" id="employee_sid" class="form-control mt-2" type="text" name="sid" placeholder="Employee Number" required />
                        <input onkeyup="findCatalog(this)" required type="number" name="catalog_number" placeholder="Catalog Number" class="form-control mt-2">
                `;
            }
            else {
                document.getElementById("form-inputs").innerHTML = ``;
            }
        })
    </script>


    <script>
        $( "#nav-toggler" ).click(function() {
            $( "#main-nav" ).slideToggle( "fast" );
        });
    </script>

    <!--Search Account   -->
    <script>
        function findAccount(input, accounType){
            let sid = input.value;

            if(!sid)
                return;

            let AT = accounType;
            console.log(sid)
            $.ajax({
                method: "POST",
                url: "../../actions.php",
                dataType : "html",
                data: {
                    action : "borrowSearchAccount",
                    sid : sid,
                    accountType: AT
                },
                success : function ( response ){
                    document.getElementById("borrower_info").innerHTML = response;
                    
                }
            });
        }
    </script>

    <!-- Find catallog -->
    <script>
        function findCatalog(input){
            let catalog_number =  input.value;
            $.ajax({
                url: "../../actions.php",
                method : "POST",
                dataType : "html",
                data: {
                    action: "findCatalog",
                    catalog_number : catalog_number
                } ,
                success: function(response){
                    document.getElementById("item_info").innerHTML = response;

                }
            });
        }
    </script>

    <script>
        $("#formBorrow").submit( function(e){
            
            e.preventDefault();
          
            $.ajax({
                url: "../../actions.php",
                method: "POST",
                data: $(this).serialize(),
                dataType: "html",
                success: function (data){
                    document.getElementById("div-info").innerHTML = data;
                    $('#addBorrowModal').modal("show");
                }
            });
        });
    </script>

    <!-- disabled the submit until the form is valid -->
    <script>
        document.getElementById("formBorrow").onchange = function(){
        
            let item_info = document.getElementById("item_info").innerHTML ==  '<p class="text-danger">Invalid catalog number</p>' ;
            let borrower_info = document.getElementById("borrower_info").innerHTML ==  '<p class="text-danger"> Invalid account </p>';

            if(item_info || borrower_info){
                document.getElementById("btn_borrow_submit").disabled = true;
            } else {
                document.getElementById("btn_borrow_submit").disabled = false;
        }

        }
    </script>  

</body>
</html>
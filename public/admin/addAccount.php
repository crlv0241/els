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
                <h2 class="h2">Add new user</h2>
                <form class="form-control shadow" id="signup" method="POST" >
                    <h2>User Information</h2>
                    <div id="div-info"></div>
                    
                    <input class="form-control mt-2" type="hidden" name="action" value="btn-createUser">
                    <input class="form-control mt-2" type="text" name="sid" placeholder="Learner Reference Number" required />
                    <input class="form-control mt-2" type="text" name="name" placeholder="Full Name" required/>
                    <input class="form-control mt-2" type="email" name="email" placeholder="Email" required/>
                    <input type="password" class="pr-password form-control mt-2" name="password" placeholder="Temporary password" required/>

                    <input class="btn btn-primary mt-4" style="background-color: var(--maroon) ;" type="submit"  value="Add account" />
                </form>
                
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

    <script>
        $( "#nav-toggler" ).click(function() {
            $( "#main-nav" ).slideToggle( "fast" );
        });
    </script>

    <script>
        $(document).ready(function (){
            $(".pr-password").passwordRequirements({
                numCharacters: 8,
                useLowercase: true,
                useUppercase: true,
                useNumbers: true,
                useSpecial: true,
            });
        });
    </script>


    <script>
        $("#signup").submit( function(e){
            e.preventDefault();

            $.ajax({
                url: "../../actions.php",
                method: "POST",
                data: $(this).serialize(),
                dataType: "html",
                success: function (data){
                    console.log(data);
                        document.getElementById("div-info").innerHTML = data;
                }
            });
        });

    </script>

</body>
</html>
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
        
        <div class="dashboard d-block">
            <h2 class="h2">Add Item</h2>
            <form class="" style="max-width:920px ;">
                <div class="row g-4">
                    <div class="col-lg-5">
                        <label >Title</label>
                        <input type="text" class="form-control"  required>
                    </div>
                    <div class="col-lg-4">
                        <label>Publisher</label>
                        <input type="text" class="form-control" placeholder="">
                    </div>
                    
                    <div class="col-lg-3">
                        <label >Published Date</label>
                        <input type="date" class="form-control" id="inputPassword2" placeholder="" required>
                    </div>
                </div>

                <div class="row g-4 mt-1">
                    <div class="col-4">
                        <select class="form-select" required>
                            <option selected>Category</option>
                            <option value="1">Book</option>
                            <option value="2">Journal</option>
                            <option value="3">Reference Work</option>
                        </select>
                    </div>
                </div>


                
                <div class="row g-4 mt-1">
                        <label style="padding:12px 4px 12px 12px" class="col-auto">Number of Author/s</label>
                        <div class="col-1" style="width: 100px;">
                            <input id="author_count" min=1  max="10" type="number" class="form-control" required>
                        </div>
                        
                </div>

                <div class="col-lg-7"  id="author-input-container">
                </div>
                
                <div class="row">
-
                    <div class="col-lg-3 mt-1">
                        <select class="form-select col-6" aria-label="Default select example" style="border: none; ">
                            <option selected>Editions</option>
                            <option value="1">Volume</option>
                            <option value="2">Chapter</option>
                            <option value="3">Series</option>
                        </select>
                    </div>
                    <div class="col-1">
                        <input class="form-control" type="number">
                    </div>
                </div>
                <input class="button button-primary" type="submit" value="Submit">    
            </form>
        </div>
    </div>

    <script>
        $( "#nav-toggler" ).click(function() {
            $( "#main-nav" ).slideToggle( "fast" );
        });

        $(document).ready( function(){
            $(" #nav-item-addItem ").addClass( "active")
            $(" #nav-item-addItem ").click(function (e){
                e.preventDefault();
            } )    

            
            //produce n of inputs for n of authors
            $( "#author_count" ).change( function(){
                document.getElementById("author-input-container").innerHTML = ""
                let author_count = document.getElementById("author_count").value;

                if(author_count > 10){
                    document.getElementById("author_count").value = 10;
                    author_count = 10;
                }
                else if( author_count < 1){
                    document.getElementById("author_count").value = 1;
                    author_count = 1

               }


                for( let i = 0 ;i < author_count; i++){
                    document.getElementById("author-input-container").innerHTML += `
                    <div>
                        <label >Author ${i+1}</label>
                        <input type="text" class="form-control" required>
                    </div>
                    `
                }
            } )

            
        } );
        



        // function getBookDetails() {
        // // Query the book database by ISBN code.
        // let isbn =  '9781451648546'; // Steve Jobs book

        //     var url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' + isbn;

        //     let v = fetch(url).then(response =>  response.json()))
        //     console.log(v);


     

        //     //   if (results.totalItems) {
        //     //     // There'll be only 1 book per ISBN
        //     //     var book = results.items[0];

        //     //     var title = book['volumeInfo']['title'];
        //     //     var subtitle = book['volumeInfo']['subtitle'];
        //     //     var authors = book['volumeInfo']['authors'];
        //     //     var printType = book['volumeInfo']['printType'];
        //     //     var pageCount = book['volumeInfo']['pageCount'];
        //     //     var publisher = book['volumeInfo']['publisher'];
        //     //     var publishedDate = book['volumeInfo']['publishedDate'];
        //     //     var webReaderLink = book['accessInfo']['webReaderLink'];

        //     //     // For debugging
        //     //     console.log(book);

        //     }

    </script>


</body>
</html>
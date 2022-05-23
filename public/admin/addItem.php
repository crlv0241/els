<?php

    require_once "../../db/connecttion.php";
    session_start();

    // $client = $_SESSION['client'] ?? null;

    // if ( !isset($client) )
    // {
    //     header("location:login.php");
    // }


    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['addItem'])){
        $category      = $_POST['category'] ?? null;
        $isbn          = $_POST['isbn'] ?? null;
        $title         = $_POST['title'] ?? null;
        $publisher     = $_POST['publisher'] ?? null;
        $date          = (int) $_POST['date'] ?? null;
        $genre         = $_POST['genre'] ?? null;
        $edition       = $_POST['edition'] ?? "none";
        $edition_n     = $_POST['edition-number'] ?? 0;
        $quantity      = $_POST['quantity'] ?? null;
        $authorCount  = $_POST['authorCount'] ?? null;
        $author        = "";
        $description   = $_POST['description'] ?? null;
        $img           = $_POST['img'] ?? null;

        $temp = [];
        for($i = 1; $i <= $authorCount; $i++)
        {   
            $temp[] = $_POST["author$i"];
        }

        $author = implode("," , $temp);

        $columns = "category, isbn, title, publisher, date, genre, edition, editionNum,	quantity, authorCount,author, description, img";

        //CHECK IF ALREADY EXISTING
        $stm = $PDO -> prepare("SELECT * FROM tbl_items WHERE (category = ? && title = ? && publisher = ? && date = ? && edition = ? && editionNum = ? && author = ?)");
        $stm -> bindValue(1, $category);
        $stm -> bindValue(2, $title);
        $stm -> bindValue(3, $publisher);
        $stm -> bindValue(4, $date);
        $stm -> bindValue(5, $edition);
        $stm -> bindValue(6, $edition_n);
        $stm -> bindValue(7, $author);


        $stm -> execute();


        if( $stm -> rowCount() > 0){
            $error = "Action Failed: The book is already exist";
        } else {

            
            //INSERT INTO TABLE
            $stm = $PDO -> prepare("INSERT INTO tbl_items($columns) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stm -> bindValue(1, $category);
            $stm -> bindValue(2, $isbn);
            $stm -> bindValue(3, $title);
            $stm -> bindValue(4, $publisher);
            $stm -> bindValue(5, $date);
            $stm -> bindValue(6, $genre);
            $stm -> bindValue(7, $edition);
            $stm -> bindValue(8, $edition_n);
            $stm -> bindValue(9, $quantity);
            $stm -> bindValue(10, $authorCount);
            $stm -> bindValue(11, $author);
            $stm -> bindValue(12, $description);
            $stm -> bindValue(13, $img);
            
            $stm -> execute();
        }
    }

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
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
                </div>
            </div>
        </div>
<body>
            <!-- Modal -->
  
    <header>
        <?php require_once "./components/header.php" ?>
    </header>
    
    <div class="d-flex nav-content-wrapper">
        <nav id="main-nav" >
            <?php require_once "./components/nav.php" ?>
        </nav>
        
        <!-- Button trigger modal -->
     




        <div class="dashboard d-block">
            <h2 class="h2">Add Item</h2>

            <!-- Button trigger modal -->
            <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Launch demo modal
            </button> -->

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div style="z-index: 1000;" class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>

            <?php if( isset( $error ) ): ?>
            <div class="col-m-7 alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Action Failed!</strong> The book is already exists.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <form class="" style="max-width:920px ;" method="POST">

                <div class="row">
                    <div class="col-md-4">
                        <label for="Select a category">Select a category</label>
                        <select onchange="" name="category" id="select-category" class="form-select" required>
                            <option value="">-- Select a Category</option>
                            <option value="Book">Book</option>
                            <option value="Journal">Journal</option>
                            <option value="Reference Work">Reference Work</option>
                        </select>
                    </div>

                    <div id="div-isbn" class="col-md-6 ">
                    </div>
                </div>

                <div class="row g-4 mt-1">
                    <div class="col-lg-5">
                        <label >Title</label>
                        <input id="title" name="title" type="text" class="form-control" placeholder="Enter title"  required>
                    </div>
                    <div class="col-lg-4">
                        <label>Publisher</label>          
                        <input name="publisher" placeholder="Enter publisher" id="publisher" type="text" class="form-control" placeholder="" required>
                    </div>
                    
                    <!-- GETTING YEARS -->
                    <?php $years = range(1900, strftime("%Y", time())); ?>

                    <div class="col-lg-3">
                        <label >Publication Date</label>
                        <select id="date" name="date" class="form-control" required>
                            <option>Select Year</option>
                                <?php foreach($years as $year) : ?>
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                </div>
        
                <div class="row g-4 mt-1">
                   


                    <div class="col-md-4">
                        <label for="">Genre</label>
                        <input id="genre" name="genre" type="text" class="form-control" required>
                    </div>

                    <div class="col-md-4 " >
                        <select name="edition" id="select-edition" class="form-select col-2 p-0" style="border: none; max-width:120px; cursor:pointer ">
                            <option value="none" >No editions</option>
                            <option value="Edition">Edition</option>
                            <option value="Volume">Volume</option>
                            <option value="Chapter">Chapter</option>
                            <option value="Series">Series</option>
                        </select>
                        <div id="div-number-input">
                        </div>
                    </div>
                </div>

 
                <div class="row mt-2 g-2">

                <label style="padding:12px 4px 12px 4px" class="col-auto">Quantity</label>
                    <div class="col-1" style="width: 100px;">
                        <input name="quantity" id="" min=1  type="number" class="form-control" required>
                    </div>
                </div>    
                
                <div class="row g-4 mt-1">
                    <label style="padding:12px 4px 12px 12px" class="col-auto">Number of Author/s</label>
                    <div class="col-1" style="width: 100px;">
                        <input name="authorCount" id="author_count" min=1  max="10" type="number" class="form-control" required>
                    </div>
                        
                </div>

                <div class="row"  id="author-input-container">
                </div>
                
                <div>
                    <label for="">Description</label>
                    <textarea id="description" name="description" class="textarea mt-1" name="" id="" cols="30" rows="5"></textarea>
                </div>
                
                <div class="col-12">
                    <input name="addItem" class="btn btn-primary mt-1 col-12" type="submit" value="Add Item">    
                </div>

            </form>
        </div>
    </div>

    <script>
        $( "#nav-toggler" ).click(function() {
            $( "#main-nav" ).slideToggle( "fast" );
        });


   
        $(document).ready( function(){
            //navigation active class
            $(" #nav-item-addItem ").addClass( "active")
            $(" #nav-item-addItem ").click(function (e){
                e.preventDefault();
            } )    

            //add number input based on selected edition
            $("#select-edition").on('change' ,function(){
                let edition  = document.getElementById("select-edition").value;
                if(edition != "none" )
                    document.getElementById("div-number-input").innerHTML = `<input class="form-control" min=1 placeholder="${edition} #" name="edition-number" type="number" required>`;
                else
                    document.getElementById("div-number-input").innerHTML = `` ;
            });

            

            //ISBN SHOW UP
            $("#select-category").change(function(){
                let category = document.getElementById("select-category").value;
                if(category == "Book")
                    {
                    document.getElementById("div-isbn").innerHTML = `
                        <label for="">Internation Standard Book Number (ISBN)</label>
                        <input name="isbn" id="isbn" onchange = "getBookDetails('isbn')" type="number" class="form-control" placeholder="Enter ISBN...">`;
                    }
                else 
                    {
                        document.getElementById("div-isbn").innerHTML = ``;
                    }
            });


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
                    <div class="col-lg-6">
                        <label >Author ${i+1}</label>
                        <input name="author${i+1}" placeholder="Enter full name..." type="text" class="form-control" required>
                    </div>
                    `
                }
            } )

            
        } );
        



        function getBookDetails(input_id) {
            // Query the book database by ISBN code.
            // let isbn =  '9781451648546'; // Steve Jobs book
            let isbn =   document.getElementById(input_id).value; // Steve Jobs book

            if(isbn != ''){
                var url = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' + isbn;
                
                let results = fetch(url).then(response => response.json()).then( result => {
                    if (result.totalItems) {
                        // There'll be only 1 book per ISBN
                        var book = result.items[0];
                        console.log(result);
                        document.getElementById("title").value = book['volumeInfo']['title'] ?? '';
                        document.getElementById("publisher").value = book['volumeInfo']['publisher'] ?? '';
                        document.getElementById("date").value = book['volumeInfo']['publishedDate'];
                        document.getElementById("genre").value = book['volumeInfo']['categories'][0];
                        document.getElementById("author_count").value = book['volumeInfo']['authors'].length;
                        document.getElementById("description").value = book['volumeInfo']['description'] ?? '';
                        
                        document.getElementById("author-input-container").innerHTML = "";

                        for( let i = 0 ;i < book['volumeInfo']['authors'].length; i++){
                            document.getElementById("author-input-container").innerHTML += `
                            <div class="col-lg-6">
                                <label >Author ${i+1}</label>
                                <input name="author${i+1}" value="${book['volumeInfo']['authors'][i]}" placeholder="Enter full name..." type="text" class="form-control" required>
                            </div>
                            `
                        }

                        // For debugging
                        console.log(book);
                        
                        return
                    }        
                } );
            }
            document.getElementById("title").value = ""
            document.getElementById("publisher").value = ""
            document.getElementById("date").value = ""
            document.getElementById("genre").value = "";
            document.getElementById("author_count").value = "";
            document.getElementById("author-input-container").innerHTML += ``;
            document.getElementById("description").value = "";
           
            // console.log(results);
            }
    </script>


</body>
</html>
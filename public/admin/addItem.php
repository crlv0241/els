<?php
    // session_start();

    // $client = $_SESSION['client'] ?? null;

    // if ( !isset($client) )
    // {
    //     header("location:login.php");
    // }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | EARIST LIBRARY</title>

    
<style>

.image_area {
  position: relative;
}

img {
      display: block;
      max-width: 100%;
}

.preview {
      overflow: hidden;
      width: 160px; 
      height: 160px;
      margin: 10px;
      border: 1px solid red;
}

.modal-lg{
      max-width: 1000px !important;
}

.overlay {
  position: absolute;
  bottom: 10px;
  left: 0;
  right: 0;
  background-color: rgba(255, 255, 255, 0.5);
  overflow: hidden;
  height: 0;
  transition: .5s ease;
  width: 100%;
}

.image_area:hover .overlay {
  height: 50%;
  cursor: pointer;
}

.text {
  color: #333;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}

</style>
   
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>        
		<link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
		<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
		<script src="https://unpkg.com/dropzone"></script>
		<script src="https://unpkg.com/cropperjs"></script>

    <?php require_once "../../cdn.php" ?>

    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/nav.css">
    <link rel="stylesheet" href="../../css/library.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />   
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/BossBele/cropzee@latest/dist/cropzee.js" defer></script>
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

                <div class="row">
                    <div class="col-md-4">
                        <label for="Select a category">Select a category</label>
                        <select id="select-category" class="form-select" required>
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
                    <!--TITLE-->
                    <div class="col-lg-5">
                        <label >Title</label>
                        <input type="text" class="form-control"  required>
                    </div>

                    <!-- PUBLISHER -->
                    <div class="col-lg-4">
                        <label>Publisher</label>2          
                        <input type="text" class="form-control" placeholder="" required>
                    </div>
                    
                    <!-- PUBLICATIONN DATE -->
                    <div class="col-lg-3">
                        <label >Published Date</label>
                        <input type="date" class="form-control" id="inputPassword2" placeholder="" required>
                    </div>
                </div>
                
                <div class="row g-4 mt-1">
                    <!-- GENRE -->
                    <div class="col-md-4">
                        <label for="">Genre</label>
                        <input type="text" class="form-control" required>
                    </div>
                    
                    <!-- QUANTITY -->
                    <div class="col-md-2">
                        <label  class="">Quantity</label>
                        <div class="col-1" style="width: 100px;">
                          <input id="" min=1  type="number" class="form-control" required>
                        </div>
                    </div>

                    <!-- EDITION -->
                    <div class="col-md-4 " >
                        <select id="select-edition" class="form-select col-2 p-0" style="border: none; max-width:120px; cursor:pointer ">
                            <option  value="none" >No editions</option>
                            <option value="Volume">Volume</option>
                            <option value="Chapter">Chapter</option>
                            <option value="Series">Series</option>
                        </select>
                        <div id="div-number-input">
                        </div>
                    </div>
                </div>


             
                
                <div class="row g-4 mt-2">
                    <label style="padding:12px 4px 12px 12px" class="col-auto">Number of Author/s</label>
                    <div class="col-1" style="width: 100px;">
                        <input id="author_count" min=1  max="10" type="number" class="form-control" required>
                    </div>
                </div>

                <div class="row"  id="author-input-container">
                </div>
                
                <div class="mb-3 col-sm-4">
                    <label for="formFile" >Image</label>
                    <input class="form-control image" name="image"   type="file" accept="image/*"  id="upload_image">
                </div>

                <div>
                    <label for="">Description</label>
                    <textarea class="textarea mt-1" name="" id="" cols="30" rows="5"></textarea>
                </div>
                
                <div class="col-12">
                    <input class="btn btn-primary mt-1 col-12" type="submit" value="Submit">    
                </div>
            </form>

            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title">Crop Image Before Upload</h5>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">×</span>
			        		</button>
			      		</div>
			      		<div class="modal-body">
			        		<div class="img-container">
			            		<div class="row">
			                		<div class="col-md-8">
			                    		<img src="" id="sample_image" />
			                		</div>
			                		<div class="col-md-4">
			                    		<div class="preview"></div>
			                		</div>
			            		</div>
			        		</div>
			      		</div>
			      		<div class="modal-footer">
			      			<button type="button" id="crop" class="btn btn-primary">Crop</button>
			        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			      		</div>
			    	</div>
			  	</div>
			</div>	
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
                if(edition == "Volume" )
                    document.getElementById("div-number-input").innerHTML = `<input class="form-control" min=1 placeholder="${edition} #" name="edition-number" type="number" required>`;
                else if(edition == "Chapter")
                    document.getElementById("div-number-input").innerHTML = `<input class="form-control"  min=1 placeholder="${edition} #" name="edition-number" type="number" required>` ;
                else if(edition == "Series")
                    document.getElementById("div-number-input").innerHTML = `<input class="form-control"  min=1 placeholder="${edition} #" name="edition-number" type="number" required>` ;
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
                        <input type="text" class="form-control" placeholder="Enter ISBN...">`;
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
                        <input placeholder="Enter full name..." type="text" class="form-control" required>
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

    <!-- CROPPERJS -->

    
<script>

$(document).ready(function(){

	var $modal = $('#modal');

	var image = document.getElementById('sample_image');

	var cropper;

	$('#upload_image').change(function(event){
		var files = event.target.files;

		var done = function(url){
			image.src = url;
			$modal.modal('show');
		};

		if(files && files.length > 0)
		{
			reader = new FileReader();
			reader.onload = function(event)
			{
				done(reader.result);
			};
			reader.readAsDataURL(files[0]);
		}
	});

	$modal.on('shown.bs.modal', function() {
		cropper = new Cropper(image, {
			aspectRatio: 1,
			viewMode: 3,
			preview:'.preview'
		});
	}).on('hidden.bs.modal', function(){
		cropper.destroy();
   		cropper = null;
	});

	$('#crop').click(function(){
		canvas = cropper.getCroppedCanvas({
			width:400,
			height:400
		});

		canvas.toBlob(function(blob){
			url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;
				$.ajax({
					url:'upload.php',
					method:'POST',
					data:{image:base64data},
					success:function(data)
					{
						$modal.modal('hide');
						$('#uploaded_image').attr('src', data);
					}
				});
			};
		});
	});
	
});
</script>
</body>
</html>
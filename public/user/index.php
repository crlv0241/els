<?php
  session_start();
  if( isset($_SESSION['user']) ){
    header("location:catalogs.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/login.css">

    <!-- JQUERY CDN -->
    
    <link rel="stylesheet" href="../../css/jquery.passwordRequirements.css" />
    
 
</head>
<body>
  
    <section>
      <div class="container">
        <div class="user signinBx">
          <div class="imgBx"><img  src="https://images.pexels.com/photos/590493/pexels-photo-590493.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" /></div>
          <div class="formBx">
            <form id="login">
            <div style="display: flex; justify-content:center; ">
                <img width="100px" src="../../images/system/logo.png" alt="">
            </div>
              <h2>Sign In</h2>
              <div id="login-message">
              </div>
              <input type="hidden" name="action" value="login">
              <input type="text" name="lrn" placeholder="LRN or Email" required />
              <input type="password" name="password" placeholder="Password" required/>
              <input type="submit" name="" value="Login" />
              <p class="signup">
                Don't have an account ?
                <a href="#" onclick="toggleForm();">Sign Up.</a>
              </p>
            </form>
          </div>
        </div>
        <div class="user signupBx">
          <div class="formBx">

            <form id="signup" method="POST"  enctype="multipart/form-data" autocomplete="off">
              <h2>Create an account</h2>
              <div id="div-info" ></div>

              <select required id="accountType" name="accountType" class="form-control">
                <option value=""> -- Select Account Type</option>
                <option value="Student"> Student</option>
                <option value="Personnel"> School Personnel</option>
              </select>
              
              <div id="form-inputs" >

              </div>
              <p class="signup">
                  Already have an account ?
                  <a href="#" onclick="toggleForm();">Sign in.</a>
                </p>
            </form>
          </div>
          <div class="imgBx"><img src="https://images.pexels.com/photos/46274/pexels-photo-46274.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="" /></div>
        </div>
      </div>
    </section>

    <script>  
    let accountType  =  document.getElementById('accountType');
    accountType.onchange = function (){
      if(this.value  == "Student"){
        document.getElementById("form-inputs").innerHTML = `<input type="hidden" name="action" value="btn-signup">
                <input type="text" name="sid" placeholder="Learner Reference Number" required />
                <input type="text" name="name" placeholder="Full Name" required/>
                <input type="email" autofill="false" name="email" placeholder="Email" required/>
                <input type="password" class="pr-password" name="password" placeholder="Create Password" required/>
                <div class="mb-3">
                    School ID
                    <input class="form-control" name="imgid" accept="image/*"  type="file" id="formFile" required>
                </div>

                <input type="submit"  value="Sign Up" />
               `;
      } 
      else if (this.value == "Personnel"){
        document.getElementById("form-inputs").innerHTML = `<input type="hidden" name="action" value="btn-signup">
                <input type="text" name="sid" placeholder="Employee Number" required />
                <input type="text" name="name" placeholder="Full Name" required/>
                <input type="email" name="email" placeholder="Email" required/>
                <input type="password" class="pr-password" name="password" placeholder="Create Password" required/>
                <div class="mb-3">
                    School ID
                    <input class="form-control" name="imgid" accept="image/*"  type="file" id="formFile" required>
                </div>

                <input type="submit"  value="Sign Up" />
               `;
      }
      else {
        document.getElementById("form-inputs").innerHTML = ``;
      }
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../../js/jquery.passwordRequirements.min.js"></script>
    <script>
        const toggleForm = () => {
            const container = document.querySelector('.container');
            container.classList.toggle('active');
        };

        $("#signup").submit( function(e){
            e.preventDefault();

            let form = $("#signup")[0];
            let formData = new FormData(form);

            console.log(formData);

            $.ajax({
                url: "../../actions.php",
                method: "POST",
                data: formData,
                enctype: 'multipart/form-data',
                processData: false,  // Important!
                contentType: false,
                cache: false,
                dataType: "html",
                success: function (data){
                    
                    document.getElementById("div-info").innerHTML = data; 
                    document.getElementById("signup").reset();

                }
            });
        });



        $("#login").submit( function(e){
          e.preventDefault();

          $.ajax({
            method:"POST",
            url: "../../actions.php",
            data: $(this).serialize(),
            dataType: "text",
            success: function(response){
              console.log(response);
            
              if(response == "Login Successfully"){
                        document.getElementById("login-message").innerHTML = `
                        <div class="alert text-center alert-success alert-dismissible fade show" role="alert">
                            ${response}
                        </div>
                        `;

                        window.location.assign("catalogs.php");
                    } else {
                        document.getElementById("login-message").innerHTML = `
                        <div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                            ${response}
                        </div>
                        `;

                    }
            }

          });

        });
    </script>

    <script>
        $(document).ready(function (){
            $(".pr-password").passwordRequirements({
                numCharacters: 8,
                useLowercase: true,
                useUppercase: true,
                useNumbers: true,
                useSpecial: true
            });
        });
    </script>
  </body>
</html>
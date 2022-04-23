<?php
    require_once "../../db/connecttion.php";
    $error = null;

    //ADMIN LOGIN
    if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['login'] == "Login") 
    {   
        $id = (int)$_POST['id'] ?? null;
        $password = $_POST['password'] ?? null;

        $stm = $PDO->prepare("SELECT * FROM admin WHERE id = ? AND password =  ?");
        $stm->bindParam(1,$id);
        $stm->bindParam(2,$password);
        $stm->execute();

        if ($stm->rowCount() != 0 )
        {            
            session_start();
            $_SESSION['client'] = $stm -> fetch(PDO::FETCH_ASSOC);
            header("location:dashboard.php");
        }
        else 
        {
            $error = "Invalid Credentials";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&display=swap');
    </style>
    <!-- BOOTSTRAP -->
    <!-- CSS/JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Login - EARIST LIBRARY SYSTEM</title>
    <link rel="stylesheet" href="../../css/main.css">
    <style>
        .login-logo-wrapper {
            background-image: url("../../images/system/bgLogin.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-logo-wrapper img {
            min-width: 50%;
        }

        .row,
        col {
            padding: 0;
            margin: 0;
        }

        .loginForm {
            padding: 1rem;
            margin: 4rem auto;
            width: 80%;

        }


        @media screen and (max-width:780px) {
            .login-logo-wrapper {
                min-height: 80px;
                width: 100vw;
                flex-basis: 100vw;
                background-color: var(--maroon);
            }

            .login-logo-wrapper img {
                min-width: 75px;
                max-width: 75px;
            }

            .fs-64 {
                font-size: 48px;
            }

            .fs-37 {
                font-size: 24px;
            }

            .large-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col login-logo-wrapper">
            <img src="../../images/system/logo.png">
        </div>
        <div class="col">
            <form autocomplete="off" class="loginForm" action="" method="POST">
                <h1 class="bold fs-64 pb-4 mb-4">Login</h1>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger" ">
                        <?php echo $error ?>
                    </div>
                <?php endif; ?>

                <div class="mt-4 pt-4 mb-3">
                    <label for="formGroupExampleInput" class="form-label fs-37">ID Number</label>
                    <input type="text" class="form-control fs-37" name="id" id="adminId" placeholder="Enter ID number..." required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label fs-37 ">Password</label>
                    <input type="password" class="form-control fs-37" name="password" id="adminPassword" placeholder="Enter your password..." required>
                </div>

                <div style="display: flex; justify-content:center">
                    <input name="login" class="fc-white fs-37 bg-maroon large-btn" type="submit" value="Login" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>
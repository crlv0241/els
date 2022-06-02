<?php
    require_once "../../db/connecttion.php";

    session_start();
    if( ! isset($_SESSION['user']) ){
        header("location:index.php");
    }

    $user = $_SESSION['user'];
    $sid = $user['sid'];

    if( $user['account_type'] == "Student" ){
        $col = "lrn";
        $table = "tbl_students";
        $_SESSION['account_type'] = "Student";
    }
    else if( $user['account_type'] == "Personnel"){
        $_SESSION['account_type'] = "Personnel";
        $col = "employee_id";
        $table = "tbl_personnels";
    }


    
    $stm = $PDO -> prepare( "SELECT * FROM $table WHERE $col = $sid" );
    $stm -> execute();

    $user = $stm -> fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMATHS | Library</title>
    <link rel="stylesheet" href="./css/main.css">
    <?php require_once "../../cdn.php" ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />   
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
  

    <style>
        .container-wave {
        position: relative;
        background: #2c3e50;
        height: auto;
        }

        .wave {
        position: absolute;
        height: 100px;
        width: 100%;
        background: #2c3e50;
        bottom: 0;
        overflow: hidden;
        }

        .wave::before, .wave::after {
        content: "";
        display: block;
        position: absolute;
        border-radius: 100% 50%;
        }

        .wave::before {
        width: 55%;
        height: 109%;
        background-color: #fff;
        right: -1.5%;
        top: 60%;
        }
        .wave::after {
                width: 100%;
                height: 80%;
                background-color: #2c3e50;
                left: -1.5%;
                top: 35%;
            }   


        @media (max-width:700px ){
            .wave::after {
                width: 100%;
                height: 80%;
                background-color: #2c3e50;
                left: -1.5%;
                top: 35%;
            }   
        }

  
        /* 
        .dataTables_filter input {
            padding: .375rem .75rem !important;
            font-size: 1rem;
            position: relative;
            font-weight: 400;
            line-height: 1.5 ;
            width: 300px !important;
            border-radius: 4px;    
            text-align: left !important;
            background: white;
        } */

        #employee_data_paginate{
            max-width: 300px;
        }
        thead{display:none;}

        #employee_data_info{ display:none;}
        #employee_data_filter{
            margin-top: 2rem;
        }
        #employee_data_length{
            display: none;
        }

        #employee_data tr{
            width: 250px !important;
            display: block;
        }

        #employee_data tr td{
            display: block;
        }

        #employee_data{
            display: flex !important;
            max-width: 300px;
        }

        #employee_data_wrapper{
            max-width: 300px;
        }


        .section-title {
            position: relative;
        }
        .section-title h2 {
            color: #1d2025;
            position: relative;
            margin: 0;
            font-size: 24px;
        }
        @media (min-width: 768px) {
            .section-title h2 {
                font-size: 28px;
            }
        }
        @media (min-width: 992px) {
            .section-title h2 {
                font-size: 34px;
            }
        }
        .section-title.title-ex1 h2 {
            padding-bottom: 20px;
        }
        @media (min-width: 768px) {
            .section-title.title-ex1 h2 {
                padding-bottom: 30px;
            }
        }
        @media (min-width: 992px) {
            .section-title.title-ex1 h2 {
                padding-bottom: 40px;
            }
        }
        .section-title.title-ex1 h2:before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 12px;
            width: 110px;
            height: 1px;
            background-color: #d6dbe2;
        }
        @media (min-width: 768px) {
            .section-title.title-ex1 h2:before {
                bottom: 17px;
            }
        }
        @media (min-width: 992px) {
            .section-title.title-ex1 h2:before {
                bottom: 25px;
            }
        }
        .section-title.title-ex1 h2:after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 12px;
            width: 40px;
            height: 1px;
            background-color: #0cc652;
        }
        @media (min-width: 768px) {
            .section-title.title-ex1 h2:after {
                bottom: 17px;
            }
        }
        @media (min-width: 992px) {
            .section-title.title-ex1 h2:after {
                bottom: 25px;
            }
        }
        .section-title.title-ex1.text-center h2:before {
            left: 50%;
            transform: translateX(-50%);
        }
        .section-title.title-ex1.text-center h2:after {
            left: 50%;
            transform: translateX(-50%);
        }
        .section-title.title-ex1.text-right h2:before {
            left: auto;
            right: 0;
        }
        .section-title.title-ex1.text-right h2:after {
            left: auto;
            right: 0;
        }
        .section-title.title-ex1 p {
            font-family: "Montserrat", sans-serif;
            color: #8b8e93;
            font-size: 14px;
            font-weight: 300;
        }


        .price-card {
            background: #f5f5f6;
            padding: 40px 35px;
            position: relative;
            border-radius: 2px;
            overflow: hidden;
        }
        .price-card:before {
            position: absolute;
            content: "";
            bottom: 0;
            left: 0;
            width: 88px;
            height: 88px;
            background-size: cover;
            opacity: 0.2;
            border-radius: 8px;
            transform: rotate(45deg);
        }
        .price-card:after {
            position: absolute;
            content: "";
            top: 0;
            right: 20px;
            width: 40px;
            height: 100px;
            opacity: 0.2;
            background-size: cover;

            background-image: url("https://www.kindpng.com/picc/m/54-546989_bookmark-background-png-transparent-bookmark-clipart-png-png.png");
            

        }
        .price-card h2 {
            font-size: 26px;
            font-weight: 600;
        }
        .price-card .btn {
            font-size: 11px;
            border-radius: 100px;
            padding: 0 25px;
            border: 0;
            color: #fff;
            float: right;
        }
        .price-card .btn.btn-primary {
            border: 0 !important;
        }
        .price-card.featured {
            background: #fff;
            border: 1px solid #ebebeb;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        /* .price-card .btn:hover {
            background: #0cc652;
            border-color: #0cc652;
        } */
        p.price span {
            display: inline-block;
            padding: 45px 15px 50px;
            padding-right: 0;
            font-size: 50px;
            font-weight: 600;
            color: #0cc652;
            position: relative;
        }
        p.price span:before {
            position: absolute;
            content: "$";
            font-size: 16px;
            top: 25px;
            font-weight: 300;
            left: 0;
        }
        .pricing-offers {
            padding: 0 0 10px;
        }
        .pricing-offers li {
            padding: 0 0 16px;
            line-height: 18px;
        }
        ul li {
            list-style-type: none;
        }
        .btn.btn-mid {
            height: 40px;
            line-height: 40px;
            padding: 0 20px;
        }


        .accordion-button{
            height: 40px;
        }

        *:focus,  *:active{
            box-shadow: none !important;
        }

        .accordion-button:not(.collapsed){
            background-color: var(--primary);
            color: white;
        }

    </style>
</head>
<body>
        <?php require_once "./components/nav.php" ?>    
        <section class="container-wave"  style="display:flex ; align-items:flex-end">
            <div class="container" style="display:flex ; align-items:flex-end">
                <h2 class="h1 py-2" style="color:white; z-index:20"><i class="fa-solid fa-user-pen me-3"></i>Profile</h2>
            </div>
            <div class="wave" style="display:flex; align-items:flex-end">
            </div>  
        </section>

     

        <div class="container">
        <!-- <div class="col-lg-6">
            <div class="input-group mt-3 ">
                <input id="input-search" type="text" class="form-control" placeholder="Search title, author, genre" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2"> <i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div> -->
        
        <div class="container-xl px-4 mt-4">
                <?php if ( isset($_SESSION['profile_warning']) ): ?>
                <div style="color:white; background-color:#FAC213; padding: .2rem;border-radius:4px; text-align:center" >
                <i class="fa-solid fa-triangle-exclamation"></i> <?php echo $_SESSION['profile_warning'] ?>
                </div>
                <?php endif; ?>
                <hr class="mt-0 mb-4">
                <div class="row">
                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Profile Picture</div>
                            <div class="card-body text-center">
                                <!-- Profile picture image-->
                                <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                <!-- Profile picture help block-->
                                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                <!-- Profile picture upload button-->
                                <button class="btn btn-primary" type="button">Upload new image</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-4">
                            <div class="card-header">Account Details</div>
                            <div class="card-body">
                                <form>
                                    <!-- Form Group (LRN)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputUsername">Learner Reference Number:</label>
                                        <input class="form-control"  type="text" placeholder="Enter your username" value="<?php echo $user['lrn'] ?>"  readonly>
                                    </div>
                                    <!-- Form Row-->
                                        <!-- Form Group (first name)-->
                                    <div class="col-md-12">
                                        <label class="small mb-1" >Full name</label>
                                        <input class="form-control"  type="text" placeholder="Enter your first name" value="<?php echo $user['name'] ?>" readonly>
                                    </div>
                                
                                    <!-- Form Group (email address)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" >Email address</label>
                                        <input class="form-control" name="email" type="email" placeholder="Enter your email address" value="<?php echo $user['email']?>">
                                    </div>

                                    <!-- Form Row        -->
                                    <div class="row gx-3 mb-3">
                                        <!-- Form Group (Grade And Section)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" >Grade and Section</label>
                                            <input class="form-control" name="grade_section" type="text" placeholder="Ex: Grade 9 Aristotle" value="<?php echo $user['grade_section'] ?>" required >
                                        </div>
                                        <!-- Form Group (Phone)-->
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputPhone">Phone number</label>
                                            <input class="form-control" id="inputPhone" type="tel" placeholder="Ex: 09123456778" value="<?php echo $user['phone'] ?>" >
                                        </div>
                                    </div>
                         
                                
                                    <!-- Save changes button-->
                                    <button class="btn btn-primary" type="button">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>




 
</body>

</html>